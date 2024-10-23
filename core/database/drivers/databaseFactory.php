<?php 

namespace Core\Database\Drivers;

class DatabaseFactory 
{
    public static function createConnection($type) 
    {
        switch ($type) {
            case 'mysql':
                return MySQLConnection::getInstance()->getConnection();
            case 'pgsql':
                return PostgreSQLConnection::getInstance()->getConnection();
            default:
                return MySQLConnection::getInstance()->getConnection();
        }
    }
}