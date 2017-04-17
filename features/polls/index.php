<?php
require_once  'app/init.php';
$pollsQuery = $db->query("
    SELECT id, question
    FROM polls
    WHERE DATE(NOW()) BETWEEN  starts AND ends
");

while($row = $pollsQuery-> fetchObject())
{
   // print_r($row);
    $polls[] = $row;
}
    //-- Amazing method to print data to check
    //echo '<pre>', print_r($polls), '</pre>';

//get poll choices

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
    <?php if(!empty($polls)):?>
        <ul>
            <?php foreach ($polls as $poll):?>
            <li><a href="poll.php?poll=<?php echo $poll->id;?>"><?php echo $poll->question; ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php else:?>
        <p>Sorry, no polls available right now!</p>
    <?php endif; ?>
    <!-- <ul>
         check if poll is available
        <li><a href="poll.php">poll 1</a></li>
        <li><a href="poll.php">poll 1</a></li>
    </ul>-->
    </body>

</html>
