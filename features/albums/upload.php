<?php
/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-03-13
 * Time: 12:34 PM
 */



require_once "features/connect.php";//require_once "connect.php"; 
require_once "uploadpic.php";
//require_once "showalbum.php";
$db=connect::dbConnect();

$query="SELECT * FROM albums1";
$pdostmt=$db->prepare($query);
$pdostmt->execute();
$albms=$pdostmt->fetchAll(PDO::FETCH_ASSOC);


//$albms=new showalbum();
//$albms->viewalbms();

if(isset($_POST['addpic']))
{
  $name=$_POST['name'];
  $albm_id=$_POST['albums'];
  $file=$_FILES['pic']['name'];
  $file_type=$_FILES['pic']['type'];
  $file_size=$_FILES['pic']['size'];
  $file_tmp=$_FILES['pic']['tmp_name'];

  $random_name=rand();


  if(empty($name) or empty($file))
  {
      echo "Please fill all the fields<br/>";
  }
  else
  {
     // echo "Its working!!<br/>";
      $upic=new uploadpic();
      $upic->addPic($name,$albm_id,$random_name,$file_tmp);
      echo "File uploaded";

  }

}

include "title_bar.php";

echo"

<h3>Create Album</h3>
<form method='post' enctype='multipart/form-data' class='form-control' >
<b>Name:</b><input type='text' name='name'/>
<br/><br/>
Select Album:
<select name='albums'>";
foreach ($albms as $a)
{
    $selected=($_REQUEST['albums'] == $a['name'])?$selected="selected":null; /*to retain the selected value*/
    echo" <option name='albm' value='".$a['id']."' $selected>". $a['name'] ."</option>";
}
echo"

</select>
<br/><br/>
Select Photo:
<input type='file' name='pic'/>
<br/><br/>
<input type='submit' name='addpic' value='Upload'/>

</form>

";
/**
 * Created by PhpStorm.
 * User: Sharanjeet Kaur
 * Date: 2017-03-15
 * Time: 12:10 AM
 */