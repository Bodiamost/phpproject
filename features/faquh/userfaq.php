<!doctype html>
<html lang="en">
<head>
    <script type="text/javascript" src="js/jquery-3.1.1.min.js">
    </script>
    <script type="text/javascript" src="js/faq.js" ></script>


<!--comment-->
    <meta charset="utf-8" />
    <title>Slide out Content</title>
</head>

<body>

<div style="padding: 20px;">
    <input type="submit" value="Another Question" onclick="window.open('features/faq/ask.php','My Window', 'height=300,width=300,margin:auto')"/><!--<input type="submit" value="Another Question" onclick="window.open('ask.php','My Window', 'height=300,width=300,margin:auto')"/>-->
<?php
require_once 'features/connect.php';//require_once 'dbconnect.php';
require_once 'faqdb.php';

$db = Connect::dbConnect();
$mylist =  new Faq($db);
$lists = $mylist->listFaq();


echo "<h1>Frequently asked Questions</h1>";

foreach($lists as $list){

    echo "

  <div class='panelContainer'>
  <h2 id='h21' style='font-size: 26px;height:55px;width:515px;border-radius:10px;background-color:#2dc3e8;padding:12px;'>$list->question
  </h2>
  
<p class='contentBox' style='width:515px;'>$list->answer
</br>
$list->likes <img style='width:35px;height:35px;' src='img/like.png'>
</p>

</div>

  
";


}

?>


    <input type="submit" value="Another Question" onclick="window.open('features/faq/ask.php','My Window', 'height=300,width=300,margin:auto')"/><!--<input type="submit" value="Another Question" onclick="window.open('ask.php','My Window', 'height=300,width=300,margin:auto')"/>-->



</div>
</body>
</html>




