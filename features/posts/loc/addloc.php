<?php

/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-04-20
 * Time: 9:09 AM
 */
class Addloc
{
    public function addloct($l,$lt,$z)
    {
        $db=connect::dbConnect();
        $query="insert into loctab
          (lat,lng,zi)
          VALUES (:lt,:ln,:z)";
        $pdostmt=$db->prepare($query);
        $pdostmt->bindValue(':lt',$l,PDO::PARAM_INT);
        $pdostmt->bindValue(':ln',$lt,PDO::PARAM_INT);
        $pdostmt->bindValue(':z',$z,PDO::PARAM_STR);
        $row= $pdostmt->execute();
        return $row;
    }

}