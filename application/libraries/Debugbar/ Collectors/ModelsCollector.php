<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/Debugbar/Collectors/BaseCollector.php';

class ModelsCollector extends BaseCollector {
    protected $models = array();

    public function getName() {
        return 'models';
    }

    public function addModel($model) {
        $this->models[] = array(
            'name' => get_class($model),
            'methods' => get_class_methods($model)
        );
    }

    public function collect() {
        return array(
            'models' => $this->models,
            'count' => count($this->models)
        );
    }

    public function getWidgets() {
        return array(
            "models" => array(
                "icon" => "cube",
                "tooltip" => "Loaded Models",
                "map" => "models.count",
                "default" => 0
            )
        );
    }

    public function getTabContent() {
        $data = $this->collect();
        return $this->CI->load->view('debugbar/collectors/models', $data, true);
    }
}