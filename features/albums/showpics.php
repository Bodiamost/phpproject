<?php

/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-03-15
 * Time: 1:54 PM
 */
class showpics
{

    public function viewpics($a_id)
    {
        $db=connect::dbConnect();
        $query2="SELECT * from photos WHERE albm_id=:id";
        $pdostmt2=$db->prepare($query2);
        $pdostmt2->bindValue(':id',$a_id,PDO::PARAM_INT);
        $pdostmt2->execute();
        $pics=$pdostmt2->fetchAll(PDO::FETCH_ASSOC);
        return $pics;

    }
}