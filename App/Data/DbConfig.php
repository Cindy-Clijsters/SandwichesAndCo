<?php
namespace App\Data;

use PDO;

class DbConfig
{
    public static $DB_CONNSTRING = "mysql:host=localhost;dbname=[---DBNAME--];charset=utf8";
    public static $DB_USERNAME   = "[---USERNAME---]";
    public static $DB_PASSWORD   = "[---PASSWORD---]";
    
    /**
     * Get the pdo connection
     * 
     * @return PDO
     */
    public static function getPdo():PDO
    {
        $pdo = new PDO(self::$DB_CONNSTRING, self::$DB_USERNAME, self::$DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        
        return $pdo;
    }
}