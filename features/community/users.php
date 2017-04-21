<?php
ini_set('session.save_path',getcwd(). '/../../tmp');
session_start();

if(isset($_SESSION['sessData']['userLoggedIn']) && ($_SESSION['sessData']['userLoggedIn'] == true) ) {

    $username = $_SESSION['sessData']['userName'];
    $userId = $_SESSION['sessData']['userID'];

} else {
    echo "Please Login ";
    exit();
    die();
}


require_once "dbconnect.php";
require_once "faqdb.php";


$db=connect::dbConnect();
$pics=new Faq($db);

if( (isset($_GET['action'])) && ($_GET['action'] == "INVITE") && (isset($_GET['id']) != "") && (is_numeric($_GET['id'])) && ($_GET['page_id']) ) {

  $pics->sendInvitations($_GET['id'],$userId,$_GET['page_id']);

  header("Location: community_profile.php?id=".$_GET['page_id']);

}

?>
