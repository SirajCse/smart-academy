<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Debugbar_hook {
    protected $CI;
    protected $debugbar;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('Debugbar/Debugbar');
        $this->debugbar = $this->CI->debugbar;
    }

    public function post_controller_constructor() {
        if ($this->debugbar->isEnabled()) {
            $this->debugbar->boot();
        }
    }

    public function post_controller() {
        if (!$this->debugbar->isEnabled()) {
            return;
        }

        if ($this->CI->input->is_ajax_request() && $this->debugbar->getOption('ajax')) {
            $this->handleAjaxResponse();
        } else {
            $this->injectDebugbar();
        }
    }

    protected function injectDebugbar() {
        $output = $this->CI->output->get_output();
        $debugbarContent = $this->debugbar->render();

        if (strpos($output, '</body>') !== false) {
            $output = str_replace('</body>', $debugbarContent . '</body>', $output);
        } else {
            $output .= $debugbarContent;
        }

        $this->CI->output->set_output($output);
    }

    protected function handleAjaxResponse() {
        $debugData = $this->debugbar->getData();
        $this->CI->output->set_header('X-Debug-Data: ' . json_encode($debugData));
    }
}