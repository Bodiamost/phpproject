<?php

include 'dbconnect.php';


$search_sql="SELECT * FROM faq WHERE question LIKE '%".$_POST['search']."%' OR 
answer LIKE '%".$_POST['search']."%'";
$search_query = mysql_query($search_sql);
if(mysql_num_rows($search_query) !=0) {
    $search_rs = mysql_fetch_assoc($search_query);
}
?>


    <form action='search.php' method='post'>

        <input type = 'text' name='k' size='50'
               value='<?php echo $GET['k'];?>'/>
        <input type='submit' value='search'>
    </form>

