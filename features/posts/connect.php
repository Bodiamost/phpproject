<?php

/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-03-14
 * Time: 3:11 PM
 */
//require_once 'features/connect.php';

class Connect
{
    /* private static $hostname='localhost';
     private static $username='root';
     private static $password='300703';
     private static $dbname="bohdantest";
     private static $db;*/

    private static $hostname='network.cga94bd83uty.ca-central-1.rds.amazonaws.com:3306';
    //private static $hostname='bohdanmostcom.ipagemysql.com:3306';
    private static $username='teammember';
    private static $password='phpteam1!';
    private static $dbname='network';
    private static $db;

    private function __construct()
    {

    }

    public static function DBconnect()
    {
        if(!isset(self::$db))
        {
            try {
                self::$db = new PDO("mysql:host=".self::$hostname.";dbname=".self::$dbname,self::$username,self::$password);

                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        return self::$db;
    }
    public static function DBconnectMysqli()
    {
        if(!isset(self::$db))
        {
            $conn = new mysqli(self::$hostname, self::$username,self::$password, self::$dbname);
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                self::$db = $conn;
            }

        }
        return self::$db;
    }
}

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

}
*/