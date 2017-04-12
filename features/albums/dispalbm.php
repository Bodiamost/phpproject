<?php
require_once "features/connect.php";//require_once "connect.php";
require_once "showalbum.php";
$shwalbm=new showalbum();
$results=$shwalbm->viewalbms();
//var_dump($results);
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<!--<a href="index.php?feature=amadd">Create a New Album</a>-->
<a href="home.php?feature=album&action=amadd">Create a New Album</a>

<?php

    echo " <table class='viewalbm'>  <tr>";
    global $results;
    foreach ($results as $pic)
    {
      /*  echo "

       
            <td><img src='album_covers/".$pic['cover_photo']."' width='200px' height='200px'/><br/><a href='index.php?id=".$pic['id']."&amp;feature=pics'>".$pic['name']."</a><br/>
            <h3>Album Description</h3>".$pic['description']."</td>
         ";*/
         echo "

       
            <td><img src='features/albums/album_covers/".$pic['cover_photo']."' width='200px' height='200px'/><br/><a href='home.php?id=".$pic['id']."&amp;feature=album&action=pics'>".$pic['name']."</a><br/>
            <h3>Album Description</h3>".$pic['description']."</td>
         ";
    }
    echo "</tr></table>";


?>
</body>
</html>
