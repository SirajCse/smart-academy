<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/Debugbar/Collectors/BaseCollector.php';

class LogsCollector extends BaseCollector {
    protected $logs = array();

    public function getName() {
        return 'logs';
    }

    public function addMessage($message, $type = 'info') {
        $this->logs[] = array(
            'message' => $message,
            'type' => $type,
            'time' => microtime(true)
        );
    }

    public function collect() {
        return array(
            'logs' => $this->logs,
            'count' => count($this->logs)
        );
    }

    public function getWidgets() {
        return array(
            "logs" => array(
                "icon" => "list-alt",
                "widget" => "PhpDebugBar.Widgets.MessagesWidget",
                "map" => "logs.logs",
                "default" => "[]"
            ),
            "logs:badge" => array(
                "map" => "logs.count",
                "default" => 0
            )
        );
    }

    public function getTabContent() {
        $data = $this->collect();
        return $this->CI->load->view('debugbar/collectors/logs', $data, true);
    }
}