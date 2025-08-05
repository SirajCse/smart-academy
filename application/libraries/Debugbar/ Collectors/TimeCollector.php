<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/Debugbar/Collectors/BaseCollector.php';

class TimeCollector extends BaseCollector {
    protected $start_time;
    protected $end_time;
    protected $memory_usage;

    public function __construct($CI) {
        parent::__construct($CI);
        $this->start_time = microtime(true);
        $this->memory_usage = memory_get_usage();
    }

    public function getName() {
        return 'time';
    }

    public function collect() {
        $this->end_time = microtime(true);

        return array(
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'duration' => $this->end_time - $this->start_time,
            'memory_usage' => $this->formatBytes(memory_get_usage()),
            'peak_memory' => $this->formatBytes(memory_get_peak_usage())
        );
    }

    public function getWidgets() {
        return array(
            "time" => array(
                "icon" => "clock-o",
                "tooltip" => "Request Duration",
                "map" => "time.duration",
                "default" => 0
            ),
            "memory" => array(
                "icon" => "memory",
                "tooltip" => "Memory Usage",
                "map" => "time.memory_usage",
                "default" => "0B"
            )
        );
    }

    public function getTabContent() {
        $data = $this->collect();
        return $this->CI->load->view('debugbar/collectors/time', $data, true);
    }
}