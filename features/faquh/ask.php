<?php

if(isset($_POST['btnsubmit'])){
    //var_dump($_POST);
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $question = $_POST['question'];
    $curdate = date("Y/m/d") ;

    require_once '../../features/connect.php';$db = Connect::dbConnect();//require_once 'database.php';

    $query = "INSERT INTO faq(user_name,user_email,question,curdate) 
                  VALUES (:user_name,:user_email,:question,:curdate)";// var values
    $pdostmt = $db->prepare($query);
    $pdostmt->bindValue(':user_name',$user_name, PDO::PARAM_STR);
    $pdostmt->bindValue(':user_email',$user_email, PDO::PARAM_STR);
    $pdostmt->bindValue(':question',$question, PDO::PARAM_STR);
    $pdostmt->bindValue(':curdate',$curdate, PDO::PARAM_STR);
    $row = $pdostmt->execute();
    echo "ThankYou " . $user_name. " We will email Your answer soon";
}
?>


<html>
<body>
<div style="width:400px;height:200px;background:white;margin:auto;border:1px solid black;">

    <form method="post" action="ask.php"><!--<form method="post" action="features/faq/ask.php">-->
        <table>
            <tr>
                <td>Name</td>
                <td><input type="text" name="user_name" value=""/></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="user_email" value=""/></td>
            </tr>
            <tr>
                <td>Question</td>
                <td><textarea name="question" value=""></textarea></td>
            </tr>

            <tr>
                <td><input type="submit" name="btnsubmit" value="Submit" /></td>
            </tr>
        </table>
    </form>


</div>
</body>
</html>