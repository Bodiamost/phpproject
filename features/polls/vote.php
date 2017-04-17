<?php

require_once  'app/init.php';

if(isset($_GET['poll'], $_GET['choice']))
{
   // $user = $_POST['user'];
    $poll = $_GET['poll'];
    $choice = $_GET['choice'];
    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'hello';
    //print_r($poll);
    $voteQuery = $db-> prepare("
        INSERT INTO polls_answers(user, poll, choice)
          SELECT :user, :poll, :choice
           FROM polls
           WHERE EXISTS (
              SELECT  id
              FROM polls
              WHERE id = :poll
               AND DATE(NOW()) BETWEEN starts AND  ends)
           AND EXISTS (
              SELECT  id
              FROM polls_choices
              WHERE id = :choice
              AND poll = :poll)
           
              LIMIT 1            
    ");

    $voteQuery->execute([
        'user' => $_SESSION['user_id'],
        'poll' => $poll,
        'choice' => $choice
    ]);

header('Location: poll.php?poll=' . $poll);
}
header ('Location: index.php');