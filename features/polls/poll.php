<?php
   require_once  'app/init.php';
   if(!isset($_GET['poll']))
   {
        header('Location: index.php');
   }else
       {
           //will take int only
           $id = (int)$_GET['poll'];

           //get general poll information

           $pollQuery = $db->prepare(
               "SELECT id, question 
               FROM polls 
               WHERE id = :poll
               AND DATE(NOW()) BETWEEN starts AND ends
           ");
           $pollQuery -> execute([
               'poll' => $id
           ]);

           $poll = $pollQuery->fetchObject();
          // print_r($poll);
        $choicesQuery = $db-> prepare("
              SELECT polls.id, polls_choices.id AS choice_id, polls_choices.name
              FROM polls
              JOIN polls_choices
              ON polls.id = polls_choices.poll
              WHERE polls.id = :poll
              AND DATE(NOW()) BETWEEN  polls.starts AND polls.ends
 ");
           $choicesQuery->execute([
               'poll' => $id
           ]);
          // print_r($choicesQuery->fetchObject());

           //extract choices
           while ($row = $choicesQuery->fetchObject()){
               $choices[] = $row;
           }
         // echo '<pre>', print_r($choices),'<pre>';
       }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php if(!$poll):?>
        <p>That poll doesn't exist</p>
    <?php else: ?>
    <div class="poll">
    <div class="poll_question">
     <?php echo $poll -> question; ?>

    </div>
        <?php if(!empty($choices)):?>
        <form action="vote.php" method="get">
            <div class="poll-options">
                <?php foreach ($choices as $index => $choice):?>
                <div class="poll-option">
                    <input type="radio" name="choice" value="<?php echo $choice-> choice_id?>" id="c<?php echo $index;?>">
                    <label for="c<?php echo $index;?>"><?php echo $choice->name;?></label>
                </div>
                <?php endforeach;?>
               <!-- <div class="poll-option">
                    <input type="radio" name="choice" value="20" id="c2">
                    <label for="c1">Choice 2</label>
                </div>
                <div class="poll-option">
                    <input type="radio" name="choice" value="35" id="c3">
                    <label for="c1">Choice 3</label>
                </div>
                -->
            </div>
            <input type="submit" value="Submit Answer">
            <input type="hidden" name="poll" value="1">
        </form>
        <?php else:?>
            <p>No choices right now!!!</p>
            <?php endif;?>
    </div>
<?php endif;?>
</body>

</html>