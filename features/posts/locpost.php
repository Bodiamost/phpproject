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
$p=$_POST['pl'];
$l=new Addloc();
$row=$l->addloct($lat,$lng,$p,$zi);
//echo $row;
