<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/Debugbar/Collectors/BaseCollector.php';

class DatabaseCollector extends BaseCollector {
    protected $queries = array();
    protected $total_time = 0;
    protected $query_hashes = array();
    protected $duplicates = 0;

    public function __construct($CI) {
        parent::__construct($CI);

        $this->CI->db->save_queries = true;
        $this->CI->db->query_hook = array($this, 'onQuery');
    }

    public function getName() {
        return 'database';
    }

    public function onQuery($sql, $time) {
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10);

        $this->queries[] = array(
            'sql' => $sql,
            'time' => $time,
            'trace' => $backtrace,
            'duplicate' => false
        );

        $this->total_time += $time;

        $hash = md5($sql);
        if (isset($this->query_hashes[$hash])) {
            $this->duplicates++;
            $this->queries[count($this->queries)-1]['duplicate'] = true;
        }
        $this->query_hashes[$hash] = true;
    }

    public function collect() {
        return array(
            'queries' => $this->queries,
            'total_time' => $this->total_time,
            'count' => count($this->queries),
            'duplicates' => $this->duplicates
        );
    }

    public function getWidgets() {
        return array(
            "database" => array(
                "icon" => "database",
                "widget" => "PhpDebugBar.Widgets.SQLQueriesWidget",
                "map" => "database.queries",
                "default" => "[]"
            ),
            "database:badge" => array(
                "map" => "database.count",
                "default" => 0
            )
        );
    }
}