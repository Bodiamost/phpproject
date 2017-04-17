<?php
    session_start();

    require_once '../connect.php';

    $_SESSION['user_id'] = 2;

    //$db = new PDO('mysql:host=localhost; dbname=phppoll', 'root', '');
    $db = Connect::DBconnect();
?>