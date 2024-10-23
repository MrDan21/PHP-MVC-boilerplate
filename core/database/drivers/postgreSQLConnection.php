<?php 

namespace Core\Database\Drivers;

use Core\Database\Interfaces\DatabaseConnection;
use PDO;

class PostgreSQLConnection {

	public static $instance = null;
    public $connection;
   
    protected function __construct()
    {
        try{
        	$this->connection = new PDO(
        		"pgsql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS
        	)
        	$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
    }

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