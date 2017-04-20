<?php
/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-04-20
 * Time: 11:58 AM
 */
require_once "connect.php";
require_once "getcheckins.php";
require_once "getinfo.php";
$obj=new getinfo();

$chk=new getcheckins();
$chks=$chk->showChk();
$name=$obj->getfname();
$jchkin=json_encode($chks);
header("Content-Type:application/json");
//var_dump($jchkin);
echo $jchkin;