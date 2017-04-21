<?php

class Faq
{
private $db;

public function __construct($db)
{
$this->db = $db;
}

public function listFaq($search){

 $query = "SELECT * FROM faq ";
 $search = trim($search);
 $search = $this->cleanString($search); //Cleaning the invalid chars in query


 if($search != false) {
   $query .=  " WHERE question LIKE '%".$search."%' OR answer LIKE '%".$search."%' ";
 }

$pdostmt = $this->db->prepare($query);
$pdostmt-> execute();

$dinos = $pdostmt->fetchAll(PDO::FETCH_OBJ);
return $dinos;
}
public function ListFaqAdmin()
{

    $query = "SELECT * FROM faq ";
    $pdostmt = $this->db->prepare($query);
    $pdostmt-> execute();
    $dinos = $pdostmt->fetchAll(PDO::FETCH_OBJ);
    return $dinos;
}

public function Like($faqId){

    $query = "UPDATE faq SET likes = likes + 1 WHERE id = '".$faqId."'";
    $pdostmt = $this->db->prepare($query);
    $pdostmt-> execute();

}//This function remove invalida characyers int he mysql query
    public function cleanString($string) {
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a") ,"",$string);
        return $string;
    }
    public function getCategories(){

        $query = "SELECT DISTINCT category_name FROM community";
        $pdostmt = $this->db->prepare($query);
        $pdostmt->execute();
        $categories = $pdostmt->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }
    public function  addPic($department_name,$product_name,$random_name,$file_tmp,$random_name2,$file_tmp2,$curdate)
    {
        $db=connect::dbConnect();
        $query="insert into community(category_name,product_name,picture,cover_picture,curdate)
          VALUES (:category_name,:product_name,:picture,:cover_picture,:curdate)";
        $pdostmt=$db->prepare($query);
        $pdostmt->bindValue(':category_name',$department_name, PDO::PARAM_STR);
        $pdostmt->bindValue(':product_name',$product_name, PDO::PARAM_STR);
        $pdostmt->bindValue(':picture',$random_name.'.jpg',PDO::PARAM_STR);
        $pdostmt->bindValue(':cover_picture',$random_name2.'.jpg',PDO::PARAM_STR);
        $pdostmt->bindValue(':curdate',$curdate, PDO::PARAM_STR);
        $row= $pdostmt->execute();
        move_uploaded_file($file_tmp,'features/community/uploads/'.$random_name.'.jpg');
        move_uploaded_file($file_tmp2,'features/community/cover-photo-uploads/'.$random_name2.'.jpg');
        $pdostmt=$this->db->LastInsertId();
        return $pdostmt;
    }
    public function viewPics($id)
    {
        $query = "SELECT * FROM community where id=:id";
        $pdostmt = $this->db->prepare($query);
        $pdostmt->bindValue(':id',$id, PDO::PARAM_STR);
        $pdostmt-> execute();
        $dinos = $pdostmt->fetchAll(PDO::FETCH_OBJ);
        return $dinos;

    }

    public function updatePost($user_id,$user_post,$curdate,$posted_by,$posted_by_name)
    {



        $query="insert into user_post(user_id,user_post,curdate,posted_by,posted_by_name)
          VALUES (:user_id,:user_post,:curdate,:posted_by,:posted_by_name)";
        $pdostmt =$this->db->prepare($query);
        $pdostmt->bindValue(':user_id',$user_id, PDO::PARAM_INT);
        $pdostmt->bindValue(':user_post',$user_post, PDO::PARAM_STR);
        $pdostmt->bindValue(':curdate',$curdate, PDO::PARAM_STR);
        $pdostmt->bindValue(':posted_by',$posted_by, PDO::PARAM_INT);
        $pdostmt->bindValue(':posted_by_name',$posted_by_name, PDO::PARAM_STR);
        $row = $pdostmt->execute();
        return $row;
    }
    public function usersLike($faqId){


        $query = "UPDATE user_post SET likes = likes + 1 WHERE user_id = '".$faqId."'";
        $pdostmt = $this->db->prepare($query);
        $rows = $pdostmt->execute();
        return $rows;

    }

    public function usersComments($post_id,$comment,$curdate,$curtime,$user_id,$user_name)
    {

        $query="insert into user_comments(post_id,comment,curdate,curtime,user_name,user_id)
          VALUES (:post_id,:comment,:curdate,:curtime,:user_name,:user_id)";
        $pdostmt =$this->db->prepare($query);
        $pdostmt->bindValue(':post_id',$post_id, PDO::PARAM_INT);
        $pdostmt->bindValue(':comment',$comment, PDO::PARAM_STR);
        $pdostmt->bindValue(':curdate',$curdate, PDO::PARAM_STR);
        $pdostmt->bindValue(':curtime',$curtime, PDO::PARAM_STR);
        $pdostmt->bindValue(':user_name',$user_name, PDO::PARAM_STR);
        $pdostmt->bindValue(':user_id',$user_id, PDO::PARAM_INT);
        $row = $pdostmt->execute();
        return $row;
    }
    public function viewComment($id)
    {
        $db=connect::dbConnect();
        $query = "SELECT * FROM user_comments where post_id= $id";
        $pdostmt = $db->prepare($query);
        $pdostmt->bindValue(':post_id',$id, PDO::PARAM_STR);
        $pdostmt-> execute();
        $dinos = $pdostmt->fetchAll(PDO::FETCH_OBJ);
        return $dinos;

    }

    public function sendInvitations($forUser,$sentBy,$pageId){

        $query="insert into community_invitations(forUser,sentBy,pageId,dt)
          VALUES (:forUser,:sentBy,:pageId,:dt)";
        $pdostmt =$this->db->prepare($query);

        $pdostmt->bindValue(':forUser',$forUser, PDO::PARAM_INT);
        $pdostmt->bindValue(':sentBy',$sentBy, PDO::PARAM_INT);
        $pdostmt->bindValue(':pageId',$pageId, PDO::PARAM_INT);
        $pdostmt->bindValue(':dt',date('Y-m-d H:i'), PDO::PARAM_INT);

        $row = $pdostmt->execute();
        return true;

    }

    public function usersInvites($search,$pageId)
    {
        $db=connect::dbConnect();
        $query = "SELECT ( CASE WHEN ( SELECT count(*) FROM community_invitations WHERE pageId = '". $pageId ."' AND forUser = u.id ) = 1 THEN 'invited'  ELSE 'not_invited'END ) AS inv_status, u.* FROM `usertb` AS u WHERE id != '". $_SESSION['sessData']['userID'] ."'  ";
        $search = trim($search);
        $search = $this->cleanString($search); //Cleaning the invalid chars in query


        if($search != false) {
            $query .=  " WHERE question LIKE '%".$search."%' OR answer LIKE '%".$search."%' ";
        }
        $pdostmt = $db->prepare($query);
        $pdostmt-> execute();
        $dinos = $pdostmt->fetchAll(PDO::FETCH_OBJ);
        return $dinos;

    }

    public function viewPost($id)
    {
        $db=connect::dbConnect();
        $query = "SELECT * FROM user_post where user_id=:user_id";
        $pdostmt = $db->prepare($query);
        $pdostmt->bindValue(':user_id',$id, PDO::PARAM_STR);
        $pdostmt-> execute();
        $dinos = $pdostmt->fetchAll(PDO::FETCH_OBJ);
        return $dinos;

    }
    public function viewUsername($id)
    {

        $query = "SELECT * FROM usertb where id= $id;";
        $pdostmt = $this->db->prepare($query);
        $pdostmt->bindValue(':id',$id, PDO::PARAM_STR);
        $pdostmt-> execute();
        $dinos = $pdostmt->fetchAll(PDO::FETCH_OBJ);
        return $dinos;
    }

    public function  multipleImages($user_id,$rand_name,$file_tmp)
    {
        $db=connect::dbConnect();
        $query="insert into user_images(picture,user_id)
        VALUES (:picture,:user_id)";
        $pdostmt=$db->prepare($query);
        $pdostmt->bindValue(':user_id',$user_id, PDO::PARAM_STR);
        $pdostmt->bindValue(':picture',$rand_name.'.jpg',PDO::PARAM_STR);
        $row= $pdostmt->execute();
        $pdostmt=$this->db->LastInsertId();
        move_uploaded_file($file_tmp,'multiple-users-uploads/'.$rand_name.'.jpg');
        return $pdostmt;
    }
    public function  userVideos($user_id,$rand_name,$file_tmp)
    {
        $db=connect::dbConnect();
        $query="insert into users_videos(user_video,user_id)
        VALUES (:user_video,:user_id)";
        $pdostmt=$db->prepare($query);
        $pdostmt->bindValue(':user_id',$user_id, PDO::PARAM_STR);
        $pdostmt->bindValue(':user_video',$rand_name,PDO::PARAM_STR);
        $row= $pdostmt->execute();
        $pdostmt=$this->db->LastInsertId();
        move_uploaded_file($file_tmp,'uploads-videos/'.$rand_name);
        return $pdostmt;
    }

    public function viewmultiplePics($id)
    {
        $query = "SELECT * FROM user_images where user_id=:user_id";
        $pdostmt = $this->db->prepare($query);
        $pdostmt->bindValue(':user_id',$id, PDO::PARAM_STR);
        $pdostmt-> execute();
        $dinos = $pdostmt->fetchAll(PDO::FETCH_OBJ);
        return $dinos;

    }
    public function viewVideos($id)
    {
        $query = "SELECT * FROM users_videos where user_id=:user_id";
        $pdostmt = $this->db->prepare($query);
        $pdostmt->bindValue(':user_id',$id, PDO::PARAM_STR);
        $pdostmt-> execute();
        $dinos = $pdostmt->fetchAll(PDO::FETCH_OBJ);
        return $dinos;

    }



}
?>