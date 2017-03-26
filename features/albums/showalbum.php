<?php

/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-03-15
 * Time: 1:47 PM
 */
class showalbum
{

    public function viewalbms()
    {
$db=connect::dbConnect();

$query="SELECT * FROM albums1";
$pdostmt=$db->prepare($query);
$pdostmt->execute();
$albms=$pdostmt->fetchAll(PDO::FETCH_ASSOC);
return $albms;
    }
}