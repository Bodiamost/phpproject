<?php

/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-04-10
 * Time: 11:10 AM
 */
class disPosts
{
    public function disPosts()
    {
        $db=connect::dbConnect();
        $query2="SELECT * from postab  ORDER BY id DESC";
        $pdostmt2=$db->prepare($query2);
        $pdostmt2->execute();
        $posts=$pdostmt2->fetchAll(PDO::FETCH_ASSOC);
        return $posts;
    }


}