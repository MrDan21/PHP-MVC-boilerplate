<?php 

namespace Core;

abstract class Database {
    
    public static $instance = null;
    public $connection;

    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}