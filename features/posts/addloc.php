<?php

/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-04-20
 * Time: 9:09 AM
 */
class Addloc
{
    public function addloct($l,$lt,$p,$z)
    {
        $db=Connect::dbConnect();
        $query="insert into loctab
          (lat,lng,place,zi,uid)
          VALUES (:lt,:ln,:pl,:z,1)";
        $pdostmt=$db->prepare($query);
        $pdostmt->bindValue(':lt',$l,PDO::PARAM_INT);
        $pdostmt->bindValue(':ln',$lt,PDO::PARAM_INT);
        $pdostmt->bindValue(':pl',$p,PDO::PARAM_STR);
        $pdostmt->bindValue(':z',$z,PDO::PARAM_STR);
        $row= $pdostmt->execute();
        return $row;
    }

}