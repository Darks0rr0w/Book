<?php
/**
 * Created by PhpStorm.
 * User: pashok
 * Date: 12.07.15
 * Time: 9:33
 */
require_once($_SERVER['DOCUMENT_ROOT']. '/SnC/config/dbconfig.php');

    class DBConnection extends DBConfig
    {
        private static $dbh;
        public static function connect()
        {
            return DBConnection::$dbh = new PDO('mysql:host=localhost;dbname=SnC', DBConfig::$user, DBConfig::$password);
        }
        public static function disconnect()
        {
            DBConnection::$dbh = null;
        }
    }