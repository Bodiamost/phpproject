<?php

/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-04-05
 * Time: 10:08 AM
 */
class newPost
{
    public function  addPost($usrId,$st,$st_img,$st_temp,$loc,$timest,$date)
    {
        $db=connect::dbConnect();
        $query="insert into postab
          (user_id,status,status_img,status_loc,timest,datest)
          VALUES (:uid,:st,:st_img,:loc,:tm,:dt)";
        $pdostmt=$db->prepare($query);
        $pdostmt->bindValue(':uid',$usrId,PDO::PARAM_INT);
        $pdostmt->bindValue(':st',$st,PDO::PARAM_STR);
        $pdostmt->bindValue(':st_img',$st_img.'.jpg',PDO::PARAM_STR);
        $pdostmt->bindValue(':loc',$loc,PDO::PARAM_STR);
        $pdostmt->bindValue(':tm',$timest,PDO::PARAM_STR);
        $pdostmt->bindValue(':dt',$date,PDO::PARAM_STR);
        $row= $pdostmt->execute();
        move_uploaded_file($st_temp,'features/posts/post_img/'.$st_img.'.jpg');
        return $row;
    }
}