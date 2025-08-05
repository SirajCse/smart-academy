<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/Debugbar/Collectors/BaseCollector.php';

class RoutesCollector extends BaseCollector {
    public function getName() {
        return 'routes';
    }

    public function collect() {
        return array(
            'current_route' => array(
                'controller' => $this->CI->router->class,
                'method' => $this->CI->router->method,
                'uri' => $this->CI->uri->uri_string()
            ),
            'routes' => $this->CI->router->routes
        );
    }

    public function getWidgets() {
        return array(
            "route" => array(
                "icon" => "share",
                "tooltip" => "Current Route",
                "map" => "routes.current_route.controller",
                "default" => ""
            )
        );
    }

    public function getTabContent() {
        $data = $this->collect();
        return $this->CI->load->view('debugbar/collectors/routes', $data, true);
    }
}