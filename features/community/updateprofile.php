<?php

if(isset($_POST['update'])){
    $id = $_POST['id'];
    require_once 'database.php';
    $query = "SELECT * FROM community WHERE id = $id";
    $pdostmt = $db->prepare($query);
    $pdostmt->bindValue(':id',$id, PDO::PARAM_INT);
    $pdostmt->execute();
    $results = $pdostmt->fetch();


}

if(isset($_POST['upd'])){
    $picture = $_POST['picture'];
    $id = $_POST['id'];

    $file=$_FILES['pic']['name'];
    $file_type=$_FILES['pic']['type'];
    $file_size=$_FILES['pic']['size'];
    $file_tmp=$_FILES['pic']['tmp_name'];
    $random_name=rand();


    require_once 'database.php';
    $query = "UPDATE community SET  picture = $random_name WHERE id = $id";
    $pdostmt = $db->prepare($query);
    $pdostmt->bindValue(':id',$id, PDO::PARAM_INT);
    $pdostmt->bindValue(':picture',$random_name, PDO::PARAM_STR);
    $row= $pdostmt->execute();
    move_uploaded_file($file_tmp,'uploads/'.$random_name);
    header("Location:community_profile.php?id=$id");
}

?>


<h3>Update Profile Picture</h3>
<form action="updateprofile.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id"  value="<?php echo $id; ?>"/>

    <input type="file" value="" id="exampleInputFile" name="pic"/>

    <input type="submit" class="btn btn-primary" value="EDIT" name="upd" />
</form>






