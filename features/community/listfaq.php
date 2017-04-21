<?php
require_once 'dbconnect.php';
require_once 'faqdb.php';

$db = Connect::dbConnect();
$mylist =  new Faq($db);
$lists = $mylist->ListFaqAdmin();


echo "<h1>Questions List</h1>
<table border='1'>
  <th>ID</th>
  <th>Question</th>
  <th>Answer</th>
  <th>Date</th>
  <th>Likes</th>
  <th>Action</th>";


foreach($lists as $list){

    echo "
  <tr>
  <td>

<a href='listfaq.php?id=". $list->id . "' >" . "</a> $list->id</td>
 <td>$list->question </td>
 <td>$list->answer </td>
 <td> $list->curdate</td>
  <td>$list->likes</td>
   
     <form action=\"features/community/deletelist.php\" method=\"post\">
    <td><input type=\"hidden\" value='" . $list->id ."' name=\"id\">
    <input type=\"submit\" value=\"Delete\" name=\"delete\">
</form>   
        
        
        <form action=\"features/community/updatelist.php\" method=\"post\">
    <input type=\"hidden\" value='" . $list->id ."' name=\"id\">
    <input type=\"submit\" value=\"Update\" name=\"update\"></td>
    </tr>
</form>";


}


?>
</table>



