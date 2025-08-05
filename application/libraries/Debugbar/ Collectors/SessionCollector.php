<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/Debugbar/Collectors/BaseCollector.php';

class SessionCollector extends BaseCollector {
    public function getName() {
        return 'session';
    }

    public function collect() {
        return array(
            'session_data' => $this->CI->session->all_userdata(),
            'flashdata' => $this->CI->session->flashdata(),
            'tempdata' => $this->CI->session->tempdata()
        );
    }

    public function getWidgets() {
        return array(
            "session" => array(
                "icon" => "user",
                "tooltip" => "Session Data",
                "map" => "session.session_data",
                "default" => "[]"
            )
        );
    }

    public function getTabContent() {
        $data = $this->collect();
        return $this->CI->load->view('debugbar/collectors/session', $data, true);
    }
}