<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdaReachApiService
{
    protected $CI;
    protected $baseUrl;
    protected $apiKey;
    protected $timeout = 10; // seconds

    public function __construct()
    {
        $this->CI =& get_instance();

        // Load database for logging
        $this->CI->load->database();

        // Load the custom config file
        $this->CI->load->config('adareach');

        // Load config variables
        $this->baseUrl = rtrim($this->CI->config->item('adareach_service_url'), '/');
        $this->apiKey  = $this->CI->config->item('adareach_service_api_key');
        $this->timeout = $this->CI->config->item('adareach_timeout') ?? 10;

        $this->CI->load->helper('url');
    }


    /**
     * Send SMS via AdaReach API
     *
     * @param string|array $receivers  11-digit phone number or array of numbers
     * @param string $content           SMS content (max 1224 chars)
     * @param bool $skipLog             Whether to skip API-side logging
     * @return array
     */
    public function sendMessage($receivers, $content, $skipLog = true)
    {
        $logData = [
            'receivers' => is_array($receivers) ? implode(',', $receivers) : $receivers,
            'content'   => $content,
            'status'    => 'PENDING',
            'provider'  => 'AdaReach',
        ];

        try {
            // Initialize cURL
            $ch = curl_init();
            $url = $this->baseUrl . '/api/ada-reach-sms';
            $postData = [
                'receivers' => $receivers,
                'content'   => $content,
                'skipLog'   => $skipLog,
            ];

            curl_setopt_array($ch, [
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT        => $this->timeout,
                CURLOPT_HTTPHEADER     => [
                    'X-API-KEY: ' . $this->apiKey,
                    'Content-Type: application/json'
                ],
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => json_encode($postData),
            ]);

            $response = curl_exec($ch);
            $error    = curl_error($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($error) {
                throw new Exception('cURL Error: ' . $error);
            }

            $data = json_decode($response, true);

            // Check API response
            if (isset($data['status']) && $data['status'] === 'SUCCESS') {
                $logData['status']   = 'SUCCESS';
                $logData['msg_cost'] = $data['msgCost'] ?? null;
                $logData['msg_count'] = $data['msgCount'] ?? null;
                $logData['error_code'] = $data['errorCode'] ?? null;
            } else {
                $logData['status'] = 'FAILED';
                $logData['error_code'] = $data['errorCode'] ?? $httpCode;
            }

            // Insert log into database
            $this->CI->db->insert('sms_logs', $logData);

            return $data;

        } catch (Exception $e) {
            // Log exception
            $logData['status']     = 'FAILED';
            $logData['error_code'] = 500;

            log_message('error', 'AdaReach SMS API Error: ' . $e->getMessage());

            $this->CI->db->insert('sms_logs', $logData);

            return [
                'status' => 'FAILED',
                'error'  => $e->getMessage(),
            ];
        }
    }
}
