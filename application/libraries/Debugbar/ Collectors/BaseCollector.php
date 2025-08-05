<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class BaseCollector {
    protected $CI;

    public function __construct($CI) {
        $this->CI = $CI;
    }

    abstract public function getName();

    abstract public function collect();

    public function getWidgets() {
        return array();
    }

    public function getTabContent() {
        return '';
    }

    public function hasWidget() {
        return !empty($this->getWidgets());
    }

    protected function formatFilePath($path) {
        return str_replace(FCPATH, '', $path);
    }

    protected function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB');
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}