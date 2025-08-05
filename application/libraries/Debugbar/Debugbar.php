<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Debugbar {
    protected $CI;
    protected $collectors = array();
    protected $enabled;
    protected $assets_path;
    protected $views_path;
    protected $options;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->config->load('debugbar', true);
        $config = $this->CI->config->item('debugbar');

        $this->enabled = $config['enabled'];
        $this->assets_path = $config['assets_path'];
        $this->views_path = $config['views_path'];
        $this->options = $config['options'];

        if ($this->enabled) {
            $this->initializeCollectors($config['collectors']);
            $this->registerHooks();
        }
    }

    protected function initializeCollectors($collectors) {
        foreach ($collectors as $collector) {
            $class = ucfirst($collector) . 'Collector';
            $file = APPPATH . 'libraries/Debugbar/Collectors/' . $class . '.php';

            if (file_exists($file)) {
                require_once($file);
                $collectorClass = $class;
                $this->collectors[$collector] = new $collectorClass($this->CI);
            }
        }
    }

    protected function registerHooks() {
        $this->CI->load->helper('debugbar');

        // Register output hook
        $this->CI->load->library('hooks');
        $this->CI->hooks->register('post_controller', array($this, 'injectDebugbar'));
    }

    public function getCollector($name) {
        return isset($this->collectors[$name]) ? $this->collectors[$name] : null;
    }

    public function injectDebugbar() {
        if (!$this->enabled || $this->CI->input->is_ajax_request()) {
            return;
        }

        $output = $this->CI->output->get_output();
        $debugbarContent = $this->render();

        // Inject before </body>
        $output = preg_replace('/<\/body>/i', $debugbarContent . '</body>', $output);

        $this->CI->output->set_output($output);
    }

    public function render() {
        $data = array(
            'collectors' => $this->collectors,
            'assets_path' => base_url() . str_replace(FCPATH, '', $this->assets_path),
            'styles' => $this->getStyles(),
            'scripts' => $this->getScripts()
        );

        return $this->CI->load->view($this->views_path . '/main', $data, true);
    }

    protected function getStyles() {
        return array(
            'debugbar.css',
            'widgets.css'
        );
    }

    protected function getScripts() {
        return array(
            'debugbar.js',
            'widgets.js'
        );
    }

    public function getAssetsPath() {
        return $this->assets_path;
    }

    public function isEnabled() {
        return $this->enabled;
    }

    public function enable() {
        $this->enabled = true;
    }

    public function disable() {
        $this->enabled = false;
    }

    public function getData() {
        $data = array();
        foreach ($this->collectors as $name => $collector) {
            $data[$name] = $collector->collect();
        }
        return $data;
    }
}