<?php
if(isset($_POST['addpoll'])){
    echo 'add';
    $question = $_POST['question'];
    $starts = $_POST['starts'];
    $ends = $_POST['ends'];
    //$color = $_POST['color'];
    require_once  'app/init.php';
   // require_once 'database.php';
    $query = "INSERT INTO polls 
                  (question, starts, ends)
                  VALUES (:question, :starts, :ends)";
    $pdostmt = $db->prepare($query);
    $pdostmt->bindValue(':question',$question, PDO::PARAM_STR);
    $pdostmt->bindValue(':starts',$starts, PDO::PARAM_STR);
    $pdostmt->bindValue(':ends',$ends, PDO::PARAM_STR);
    //$pdostmt->bindValue(':color',$color, PDO::PARAM_STR);
    $row = $pdostmt->execute();
    print_r($row);
    //echo " Added " . $row;
    header("Location: insertpoll.php");
}
?>



<h3>Add Poll</h3>
<form action="insertpoll.php" method="post">
    Question: <input type="text" name="name" /><br />
    start date: <input type="text" name="start_date" /><br />
    end date: <input type="text" name="end_date" /><br />

    <input type="submit" value="Add Question" name="addpoll" />
</form>

<form>
   
foreach($question as $q){

    <li><a href='listdino.php?id=".  $q->id . "' >" . $q->name . "</a>
    <form action="deletepoll.php" method="post">
    <input type="hidden" value='" . $q->id ."' name="id">
    <input type="submit" value="Delete" name="delete">
</form>
    <form action="updatepoll.php" method="post">
    <input type="hidden" value='" . $q->id ."' name="id">
    <input type="submit" value="Update" name="update">
</form>

   </li>";

}


?>
