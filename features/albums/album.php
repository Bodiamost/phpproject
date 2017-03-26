<?php
/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-03-13
 * Time: 12:34 PM
 */



require_once "features/connect.php";//require_once "connect.php";
require_once  "Albumadd.php";
$albm=new Albumadd();


if(isset($_POST['add']))
{
    $name=$_POST['al_name'];
    $desc=$_POST['desc'];
    $credate=$_POST['credate'];


    $cvrpic=$_FILES['covrpic']['name'];
    $cvrpic_type=$_FILES['covrpic']['type'];
    $cvrpic_size=$_FILES['covrpic']['size'];
    $cvrpic_tmp=$_FILES['covrpic']['tmp_name'];

    $random_name=rand();


    if(empty($name) or empty($cvrpic))
    {
        echo "Please fill all the fields<br/>";
    }
    else
    {
        // echo "Its working!!<br/>";
        $albm->addAlbum($name,$desc,$credate,$random_name,$cvrpic_tmp);
        echo "Album is created";

    }

}



include "title_bar.php";
echo"


<h3>Create Album</h3>
<form method='post' enctype='multipart/form-data' >
Album Name:
<input type='text' id='al_name' name='al_name'/>
<br/><br/>
Description:<textarea name='desc' cols='5' width='200px'></textarea>
<br/><br/>
Date: <input type='date' name='credate'/>
<br/><br/>
Cover Photo:<input type='file' name='covrpic'/>
<br/><br/>
<input type='submit' name='add' value='Create'/>
</form>




";