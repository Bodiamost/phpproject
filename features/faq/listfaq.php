<?php
require_once 'features/connect.php';//require_once 'dbconnect.php';
require_once 'faqdb.php';

$db = Connect::dbConnect();
$mylist =  new Faq($db);
$lists = $mylist->listFaq();

echo '<a href="features/faq/admin_add.php"> Add new</a>';
echo "<h1>Questions List</h1>
<table border='1'>
  <th>ID</th>
  <th>User Name</th>
  <th>Email</th>
  <th>Question</th>
  <th>Answer</th>
  <th>Date</th>
  <th>Likes</th>
  <th>Action</th>";


foreach($lists as $list){

/*    echo "
  <tr>
  <td>

<a href='listfaq.php?id=". $list->id . "' >" . "</a> $list->id</td>
 <td>$list->user_name </td>
  <td>$list->user_email </td>
 <td>$list->question </td>
 <td>$list->answer </td>
 <td> $list->curdate</td>
  <td>$list->likes</td>
   
     <form action=\"deletelist.php\" method=\"post\">
    <td><input type=\"hidden\" value='" . $list->id ."' name=\"id\">
    <input type=\"submit\" value=\"Delete\" name=\"delete\">
</form>   
        
        
        <form action=\"updatelist.php\" method=\"post\">
    <input type=\"hidden\" value='" . $list->id ."' name=\"id\">
    <input type=\"submit\" value=\"Update\" name=\"update\"></td>
    </tr>
</form>";
*/
 echo "
  <tr>
  <td>

<a href='features/faq/listfaq.php?id=". $list->id . "' >" . "</a> $list->id</td>
 <td>$list->user_name </td>
  <td>$list->user_email </td>
 <td>$list->question </td>
 <td>$list->answer </td>
 <td> $list->curdate</td>
  <td>$list->likes</td>
   
     <form action=\"features/faq/deletelist.php\" method=\"post\">
    <td><input type=\"hidden\" value='" . $list->id ."' name=\"id\">
    <input type=\"submit\" value=\"Delete\" name=\"delete\">
</form>   
        
        
        <form action=\"features/faq/updatelist.php\" method=\"post\">
    <input type=\"hidden\" value='" . $list->id ."' name=\"id\">
    <input type=\"submit\" value=\"Update\" name=\"update\"></td>
    </tr>
</form>";
}


?>
</table>



