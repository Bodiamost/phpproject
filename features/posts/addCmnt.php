<?php


class addCmnt
{


public function addCmntToDB($p,$u,$c)
{
    $db=connect::dbConnect();
$query="insert into comments
          (pid,uid,cmnt)
          VALUES (:pid,:uid,:cm)";
$pdostmt=$db->prepare($query);
$pdostmt->bindValue(':pid',$p,PDO::PARAM_INT);
$pdostmt->bindValue(':uid',$u,PDO::PARAM_INT);
$pdostmt->bindValue(':cm',$c,PDO::PARAM_STR);
$row= $pdostmt->execute();
return $row;
}

}