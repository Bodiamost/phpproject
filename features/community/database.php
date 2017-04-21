<?php
$dsn = "mysql:host=network.cga94bd83uty.ca-central-1.rds.amazonaws.com:3306;dbname=network";
//$dsn = "mysql:host=bohdanmostcom.ipagemysql.com:3306;dbname=network";
$username = "teammember";
$password = "phpteam1!";
try {
    $db = new PDO($dsn,$username,$password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e->getMessage();
}

