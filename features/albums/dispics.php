<?php
require_once "features/connect.php";//require_once "connect.php";
require_once "showpics.php";


$a_id=$_GET['id'];

$pics=new showpics();
$shwpics=$pics->viewpics($a_id);
/*foreach ($shwpics as $pic)
{
    echo $pic['imgurl'];
}*/




?>


<h3>Your Images in this Album are</h3>
<!--<h2><a href="album.php?feature=amadd">Create a New Album</a></h2>-->
<h2><a href="home.php?feature=album&action=amadd">Create a New Album</a></h2>
<br/>
    <?php
    global $shwpics;
    //echo "<table>";
    foreach ($shwpics as $spic)
    {

        //echo "<tr>";
        //for($i=0;$i<2;$i++)
        //{
      /*  echo "
        

      <img src='uploads/".$spic['imgurl']."' width='275px' height='275px' class='disimg'/>
      
      
      
      ";*/
        echo "
        

      <img src='features/albums/uploads/".$spic['imgurl']."' width='275px' height='275px' class='disimg'/>
      
      
      
      ";
        }
        //cho "</tr>";
    //}
    //echo "</tr></table>";

    ?>

