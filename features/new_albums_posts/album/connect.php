<?php

/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-03-14
 * Time: 3:11 PM
 */
require_once '../../connect.php';
/*class connect
{
    private static $dsn = "mysql:host=localhost;dbname=project"; //enter database name here
    private static $username = "root";
    private static $password = "";
    private static $db;
    private  function __construct()
    {

    }
    public static function dbConnect()
    {
        if(!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$username, self::$password); //creating new php data object
                static::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$db;
    }

}*/