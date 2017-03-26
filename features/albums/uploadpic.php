<?php

/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-03-15
 * Time: 1:06 PM
 */
class uploadpic
{
    public function  addPic($name,$a_id,$rand_name,$file_tmp)
    {
        $db=connect::dbConnect();
        $query="insert into photos
          (name,albm_id,imgurl)
          VALUES (:name,:albm_id,:imgurl)";
        $pdostmt=$db->prepare($query);
        $pdostmt->bindValue(':name',$name,PDO::PARAM_STR);
        $pdostmt->bindValue(':albm_id',$a_id,PDO::PARAM_INT);
        $pdostmt->bindValue(':imgurl',$rand_name.'.jpg',PDO::PARAM_STR);
        $row= $pdostmt->execute();
        move_uploaded_file($file_tmp,'features/albums/uploads/'.$rand_name.'.jpg');
    }

}