<?php
/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-04-20
 * Time: 9:09 AM
 */
require_once "connect.php";
require_once "addloc.php";

$lat=$_POST['lat'];
$lng=$_POST['lng'];
$zi=$_POST['zm'];
//console.log($lat);
var_dump($lat);
var_dump($lng);
var_dump($zi);
$l=new Addloc();
$row=$l->addloct($lat,$lng,$zi);
//echo $row;
