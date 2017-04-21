<?php
if(isset($_POST['update'])){
    $id = $_POST['id'];
    require_once 'database.php';
    $query = "SELECT * FROM faq WHERE id = :id";
    $pdostmt = $db->prepare($query);
    $pdostmt->bindValue(':id',$id, PDO::PARAM_INT);
    $pdostmt->execute();
    $results = $pdostmt->fetch();

}
if(isset($_POST['upd'])){
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $id = $_POST['id'];
    $curdate = date("Y/m/d") ;
    require_once 'database.php';
    $query = "UPDATE faq SET  question = :question, answer = :answer , curdate= :curdate WHERE id = :id";
    $pdostmt = $db->prepare($query);
    $pdostmt->bindValue(':question',$question, PDO::PARAM_STR);
    $pdostmt->bindValue(':answer',$answer, PDO::PARAM_STR);
    $pdostmt->bindValue(':id',$id, PDO::PARAM_INT);
    $pdostmt->bindValue(':curdate',$curdate, PDO::PARAM_STR);
    $row = $pdostmt->execute();
    //echo " updated " . $row;
    header("Location: ../../admin.php?feature=faq");
}
?>



<h3>Update List</h3>
<form action="updatelist.php" method="post">
    <input type="hidden" name="id"  value="<?php echo $id; ?>"/>
    Question: <input type="text" name="question"  value="<?php echo $results['question']; ?>"/><br />
    Answer: <textarea name="answer" value=""><?php echo $results['answer']; ?></textarea><br/>
    <input type="submit" value="Update List" name="upd" />
</form>


