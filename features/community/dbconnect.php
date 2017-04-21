<?php

class Connect
{
    private static $dsn = "mysql:host=network.cga94bd83uty.ca-central-1.rds.amazonaws.com:3306;dbname=network";
    //private static $dsn = "mysql:host=bohdanmostcom.ipagemysql.com:3306;dbname=network";
    private static $username = "teammember";
    private static $password = "phpteam1!";
    private static $db;

    private function __construct(){
    }

    public static function dbConnect(){
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$username, self::$password);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$db;
    }



}
