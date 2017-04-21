<?php

/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-04-05
 * Time: 12:01 AM
 */
class getinfo
{
    public  function getfname()
    {
        $db=connect::dbConnect();
        $query1="SELECT first_name FROM usertb where id=:id";
        $pdostmt=$db->prepare($query1);
        $pdostmt->bindValue(':id',12,PDO::PARAM_INT);
        $pdostmt->execute();
        $fname=$pdostmt->fetch(PDO::FETCH_OBJ);
        return $fname;
    }
    public  function getpic()
    {
        $db=connect::dbConnect();
        $query2="SELECT prflpic FROM usertb where id=:id";
        $pdostmt=$db->prepare($query2);
        $pdostmt->bindValue(':id',12,PDO::PARAM_INT);
        $pdostmt->execute();
        $pic=$pdostmt->fetch(PDO::FETCH_OBJ);
        return $pic;
    }
}