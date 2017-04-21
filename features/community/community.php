<?php
//session_start();
ini_set('display_errors',1);
if(isset($_SESSION['sessData']['userLoggedIn']) && ($_SESSION['sessData']['userLoggedIn'] == true) ) {
    //User logged in
} else {
    echo "Please Login ";
    exit();
    die();
}

require_once 'features/community/dbconnect.php';
require_once 'features/community/faqdb.php';


$db = Connect::dbConnect();
$mylist =  new Faq($db);
$lists = $mylist->getCategories();

    if(isset($_POST['addpic']))
    {

        $department_name = $_POST['department_name'];
        $product_name = $_POST['product_name'];
        $curdate = date("Y/m/d") ;

        $file=$_FILES['pic']['name'];
        $file_type=$_FILES['pic']['type'];
        $file_size=$_FILES['pic']['size'];
        $file_tmp=$_FILES['pic']['tmp_name'];

        $file2=$_FILES['cover_pic']['name'];
        $file_type2=$_FILES['cover_pic']['type'];
        $file_size2=$_FILES['cover_pic']['size'];
        $file_tmp2=$_FILES['cover_pic']['tmp_name'];
        $random_name=rand();
        $random_name2=rand();

        $upic=new Faq($db);
        $id = $upic->addPic($department_name,$product_name,$random_name,$file_tmp,$random_name2,$file_tmp2,$curdate);
        echo '<script> window.location.replace("features/community/community_profile.php?id='.$id.'");</script>';




    }

    ?>

<script type="text/javascript" src="js/jquery-3.1.1.min.js">
</script>
<script type="text/javascript" src="features/community/js/faq.js" ></script>


<script src="js/jquery.1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<div class="box" style="height:2200px;">
<div style="margin: 10px;padding: 10px;background:#f7f7f7;">
<form method="post" action="home.php?feature=community" enctype="multipart/form-data">
  <h1 style="color:#757575;">Create Your Page</h1>

    <label for="Select-Department">Choose Department</label>
    <div class="form-group">

      <select class="form-control" name="department_name">

        <?php
        foreach ($lists as $c){


      echo "<option value=$c->category_name>$c->category_name</option>";
        }

        ?>
      </select>
    </div>
    <div class="form-group">
        <label for="product_name">Product Name</label>
        <input type="text" name="product_name" value=""class="form-control" id="exampleInputPassword1" placeholder="Product Name">
    </div>




        <div class="form-group">
            <label for="exampleInputFile">Profile Photo</label>
            <input type="file" id="exampleInputFile" name="pic"/>
        </div>
    <div class="form-group">
        <label for="exampleInputFile">Cover Photo</label>
        <input type="file" id="exampleInputFile" name="cover_pic">
    </div>
    <div>
    <input type="submit" name="addpic" class="btn btn-default" value="Create"/>
    </div>

</form>
</div>
</div>