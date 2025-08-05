<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['debugbar'] = array(
    'enabled' => ENVIRONMENT === 'development',
    'collectors' => array(
        'config',
        'database',
        'views',
        'models',
        'routes',
        'session',
        'logs'
    ),
    'assets_path' => APPPATH . 'third_party/Debugbar/Assets',
    'views_path' => APPPATH . 'views/debugbar'
);