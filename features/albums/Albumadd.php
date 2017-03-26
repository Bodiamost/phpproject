<?php

/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-03-14
 * Time: 11:37 PM
 */
class Albumadd
{
    public function  addAlbum($name,$desc,$cre_date,$cvrpic,$cvr_temp)
    {
        $db=connect::dbConnect();
        $query="insert into albums1
          (name,description,date_created,cover_photo)
          VALUES (:name,:desc,:cre_date,:cvrpic)";
        $pdostmt=$db->prepare($query);
        $pdostmt->bindValue(':name',$name,PDO::PARAM_STR);
        $pdostmt->bindValue(':desc',$desc,PDO::PARAM_STR);
        $pdostmt->bindValue(':cre_date',$cre_date,PDO::PARAM_STR);

        $pdostmt->bindValue(':cvrpic',$cvrpic.'.jpg',PDO::PARAM_STR);
        $row= $pdostmt->execute();
        //move_uploaded_file($cvr_temp,'album_covers/'.$cvrpic.'.jpg');
        move_uploaded_file($cvr_temp,'features/albums/album_covers/'.$cvrpic.'.jpg');
    }

}