<?php
/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-04-14
 * Time: 5:32 PM
 */
require_once "connect.php";
require_once "features/posts/getinfo.php";
$obj=new getinfo();
$pic=$obj->getpic();


//$jname=json_encode($name);
$jpic=json_encode($pic);

header("Content-Type:application/json");
echo  $jpic;