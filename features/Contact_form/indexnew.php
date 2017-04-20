<?php
session_start(); // submitting the form, then validating it later on
require 'connection.php';

$success = false;
$error   = '';
$name    = '';
$email   = '';
$subj    = '';
$message = '';

if(isset($_POST['submit']))
{
    $conn    = Connect();
    $name    = $_POST['u_name'];
    $email   = $_POST['u_email'];
    $subj    = $_POST['subj'];
    $message = $_POST['message'];

    if(!isset($_REQUEST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response']))
    {
        $error = "Please fill the captcha.";
    }
    else
    {
        $cresponse = urlencode($_REQUEST['g-recaptcha-response']);
        if($cresponse!=$_SESSION['custom_captcha'])
        {
            $error = "INVALID CAPTCHA";
        }
    }
    if($error=="")
    {
        $query   = "INSERT into contact(u_name,u_email,subj,message) VALUES('" . $name . "','" . $email . "','" . $subj . "','" . $message . "')";
        $success = $conn->query($query);
    }


    if (!$success)
    {
        //die("Couldn't enter data: ".$conn->error);
        //header('Location: main.php');
        require_once 'mainnew.php';
    }
    else
        echo "Thank You For Contacting Us. <br>";
    $conn->close();

}
else
{
    require_once 'mainnew.php';
}
?>
