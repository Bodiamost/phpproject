<?php
/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-04-15
 * Time: 12:24 AM
 */
require_once "connect.php";
require_once "addCmnt.php";
require_once "getinfo.php";
$obj=new getinfo();
$pic=$obj->getpic();
$uname=$obj->getfname();
$cobj=new addCmnt();

$uid=$_POST['uid'];
$psid=$_POST['psid'];
$cmnt=$_POST['cmnt'];
//echo $uid;
///echo $pid;
//echo $cmnt;
//$uid=1;
//$cm=$_GET['cbox'];



$rslt=$cobj->addCmntToDB($psid,$uid,$cmnt);
//echo $cmnt;
//echo $uname->fname;
//echo $pic->prflpic;

$vardata=json_encode(array("uname"=>$uname->first_name,"pic"=>$pic->prflpic,"cm"=>$cmnt));

/*
echo"<div><img src=<?php echo "profile/".$pic->prflpic;?> style=\"float:left;height:45px;width:45px\"/><a href=\"#\"><?php echo $uname->fname; ?></a>
<div style='background-color: lightcyan;'><?php echo $cmnt;?></div><br/>
</div>";*/
//$data=json_encode($uname+$pic+$cmnt);

header("Content-Type:application/json");
echo $vardata;


