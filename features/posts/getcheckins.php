<?php

/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-04-20
 * Time: 9:57 AM
 */
class getcheckins
{
    public function showChk()
    {
        $db=connect::dbConnect();
        $query2="SELECT lat,lng,place,first_name as fname from loctab,usertb where loctab.uid=usertb.id ORDER BY uid DESC";
        $pdostmt2=$db->prepare($query2);
        $pdostmt2->execute();
        $locs=$pdostmt2->fetchAll(PDO::FETCH_ASSOC);
        return $locs;

    }

}