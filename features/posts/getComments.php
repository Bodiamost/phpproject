<?php

/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-04-18
 * Time: 5:14 PM
 */
class GetComments
{
    public function showCmnts($pid)
    {
        $db=connect::dbConnect();
        $query1="SELECT cmnt,first_name,prflpic FROM comments,usertb where pid=:id and comments.uid=usertb.id order by comments.Id Desc";
        $pdostmt=$db->prepare($query1);
        $pdostmt->bindValue(':id',intval($pid),PDO::PARAM_INT);
        $pdostmt->execute();
        $cdata=$pdostmt->fetchAll(PDO::FETCH_ASSOC);
        return $cdata;
    }

}