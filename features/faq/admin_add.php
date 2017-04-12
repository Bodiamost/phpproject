<?php

if(isset($_POST['btnsubmit'])){
    //var_dump($_POST);
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $curdate = date("Y/m/d") ;

    require_once '../../features/connect.php';$db = Connect::dbConnect();//require_once 'database.php';
    $query = "INSERT INTO faq(question,answer,curdate) 
                  VALUES (:question,:answer,:curdate)";// var values
    $pdostmt = $db->prepare($query);
    $pdostmt->bindValue(':question',$question, PDO::PARAM_STR);
    $pdostmt->bindValue(':answer',$answer, PDO::PARAM_STR);
    $pdostmt->bindValue(':curdate',$curdate, PDO::PARAM_STR);
    $row = $pdostmt->execute();
    header("Location: ../../admin.php?feature=faq");//header("Location: listfaq.php");
}
?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>FAQ</title>

</head>
<body>

<div id="body_wrap">
    <h1>Add Question</h1>

    <form method="post" action="admin_add.php">
        <table>
            <tr>
                <td>Question</td>
                <td><input type="text" name="question" value=""/></td>
            </tr>
            <tr>
                <td>Answer</td>
                <td><textarea name="answer" value=""></textarea></td>
            </tr>

            <tr>
                <td><input type="submit" name="btnsubmit" value="ADD" /></td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>
