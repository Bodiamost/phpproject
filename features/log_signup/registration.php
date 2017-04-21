<?php
//session_save_path(getcwd().'/../../tmp'); //for Ipage
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>

<?php
$url = 'social.jpg';
?>

<html>
<head>
    <title>Login page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style type="text/css">
       body
        {
            background-image:url('<?php echo $url ?>');
        }
    </style>
</head>

<div>
    <h1><b>WorldLink- Connect to the World. </b></h1>
</div>
<body>
<div class="container">
    <h2>Create a New Account</h2>
    <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
    <div class="regisFrm">
        <form action="userAccount.php" method="post" enctype="multipart/form-data">
            <input type="text" name="first_name" placeholder="FIRST NAME" required="">
            <input type="text" name="last_name" placeholder="LAST NAME" required="">
            <input type="email" name="email" placeholder="EMAIL" required="">
            <input type="text" name="age" placeholder="AGE" required="">
            <input type="text" name="country" placeholder="COUNTRY" required="">
            <input type="text" name="phone" placeholder="PHONE NUMBER" required="">
            <input type="file" name="prflpic" placeholder="PUT YOUR PIC HERE" required="">
            <input type="password" name="password" placeholder="PASSWORD" required="">
            <input type="password" name="confirm_password" placeholder="CONFIRM PASSWORD" required="">


            <div class="send-button">
                <input type="submit" name="signupSubmit" value="CREATE ACCOUNT">
            </div>
        </form>
    </div>
</div>
</body>
</html>