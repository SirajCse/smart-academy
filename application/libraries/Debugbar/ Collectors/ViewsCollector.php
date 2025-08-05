<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/Debugbar/Collectors/BaseCollector.php';

class ViewsCollector extends BaseCollector {
    protected $views = array();

    public function getName() {
        return 'views';
    }

    public function addView($view, $data = array()) {
        $this->views[] = array(
            'name' => $view,
            'data' => $data,
            'time' => microtime(true)
        );
    }

    public function collect() {
        return array(
            'views' => $this->views,
            'count' => count($this->views)
        );
    }

    public function getWidgets() {
        return array(
            "views" => array(
                "icon" => "file",
                "tooltip" => "Loaded Views",
                "map" => "views.count",
                "default" => 0
            )
        );
    }

    public function getTabContent() {
        $data = $this->collect();
        return $this->CI->load->view('debugbar/collectors/views', $data, true);
    }
}