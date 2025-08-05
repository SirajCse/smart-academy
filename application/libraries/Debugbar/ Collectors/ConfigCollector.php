<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/Debugbar/Collectors/BaseCollector.php';

class ConfigCollector extends BaseCollector {
    protected $configs = array();

    public function getName() {
        return 'config';
    }

    public function collect() {
        $configs = array();

        // Get all loaded config files
        $loaded = $this->CI->config->is_loaded;

        foreach ($loaded as $file => $name) {
            $configs[$name] = $this->CI->config->item($name);
        }

        // Add CodeIgniter constants
        $configs['constants'] = array(
            'BASEPATH' => BASEPATH,
            'APPPATH' => APPPATH,
            'FCPATH' => FCPATH,
            'ENVIRONMENT' => ENVIRONMENT
        );

        return array(
            'configs' => $configs,
            'loaded_files' => array_keys($loaded)
        );
    }

    public function getWidgets() {
        return array(
            "config" => array(
                "icon" => "cog",
                "tooltip" => "Configuration",
                "map" => "config.loaded_files",
                "default" => "[]"
            )
        );
    }

    public function getTabContent() {
        $data = $this->collect();
        return $this->CI->load->view('debugbar/collectors/config', $data, true);
    }
}