<?php
session_start();
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>

<?php
$url = 'img/social.jpg';//$url = 'features/users/img/social.jpg';//$url = 'social.jpg';
?>

<html>
<head>
    <title>Login page</title>
    <link rel="stylesheet" type="text/css" href="features/users/style.css"><!--<link rel="stylesheet" type="text/css" href="style.css">-->
    <style type="text/css">
       body
        {
            background-image:url('<?php echo $url ?>');
        }
    </style>
</head>
<div>
<h1><b>WorldLink- Connect to the World.</b></h1>
</div>
<body>
<div class="container">

    <?php
        if (!empty($sessData['userLoggedIn']) && !empty($sessData['userID'])){
            chdir("features/users");//added
            include 'user.php';
            $user = new User();
            $conditions['where'] = array(
                'id' => $sessData['userID'],
            );
            $conditions['return_type'] = 'single';
            $userData = $user->getRows($conditions);
    ?>
    <h2>Welcome <?php echo $userData['first_name']; ?>!</h2>
    <a href="features/users/userAccount.php?logoutSubmit=1" class="logout">Logout</a><!--<a href="userAccount.php?logoutSubmit=1" class="logout">Logout</a>-->
    <div class="regisFrm">
        <p><b>Name: </b><?php echo $userData['first_name'].' '.$userData['last_name']; ?></p>
        <p><b>Email: </b><?php echo $userData['email']; ?></p>
        <p><b>Phone: </b><?php echo $userData['phone']; ?></p>
    </div>
    <?php }else{ ?>

    <h2>Login to Your Account</h2>
    <?php echo !empty($statusMsg)?'<p class="'.$statusMsgType.'">'.$statusMsg.'</p>':''; ?>
    <div class="regisFrm">
        <form action="features/users/userAccount.php" method="post"><!--<form action="userAccount.php" method="post">-->
            <input type="email" name="email" placeholder="EMAIL" required="">
            <input type="password" name="password" placeholder="PASSWORD" required="">
            <div class="send-button">
                <input type="submit" name="loginSubmit" value="LOGIN">
            </div>
        </form>
        <p>Don't have an account? <a href="features/users/registration.php">Register</a><!--<a href="registration.php">Register</a>--></p>
	<a href="home.php">Skip to check</a>
    </div>
    <?php } ?>
</div>
</body>
</html>
