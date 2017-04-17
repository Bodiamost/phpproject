<?php
echo 'test';
if(isset($_POST['update'])){
    $id = $_POST['id'];
    print ($id);
    require_once  'app/init.php';

    $query = "SELECT * FROM polls WHERE id = 1 AND DATE(NOW()) BETWEEN starts AND ends";
    $pdostmt = $db->prepare($query);
    $pdostmt->bindValue(':id',$id, PDO::PARAM_INT);
    $pdostmt->execute();
    $results = $pdostmt->fetch();
    print_r($results);
}

if(isset($_POST['upd'])){
    echo 'were';
    $question = $_POST['question'];
    $starts = $_POST['starts'];
    $ends = $_POST['ends'];
    $id = $_POST['aid'];;
    require_once  'app/init.php';
    $query = "UPDATE polls 
                 SET  question = \"what is your fav language?\",
                 starts = 2017-04-12,
                 ends = 2017-04-13
                  WHERE id = 1;";
    $pdostmt = $db->prepare($query);
    print_r($pdostmt);
    $pdostmt->bindValue(':question',$question, PDO::PARAM_STR);
    $pdostmt->bindValue(':starts',$starts, PDO::PARAM_STR);
    $pdostmt->bindValue(':ends',$ends, PDO::PARAM_STR);
    $pdostmt->bindValue(':id',$id, PDO::PARAM_INT);
    $row = $pdostmt->execute();
   echo 'upadet test';
    print_r ($row);
    //echo " updated " . $row;
    header("Location: index.php");
}
?>

<h3>Update </h3>
<form action="updatepoll.php" method="post">
    <input type="hidden" name="aid"  value="<?php echo $id; ?>"/>
    Question: <input type="text" name="question"  value="<?php echo $results['question']; ?>"/><br />
    starts: <input type="text" name="starts" value="<?php echo $results['starts']; ?>" /><br />
    end: <input type="text" name="ends" value="<?php echo $results['ends']; ?>" /><br />
    <input type="submit" value="Update poll" name="upd" />
</form>
