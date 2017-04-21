<?php
if(isset($_GET['action'])&& $_GET['action']=='results')
{
	require_once 'features/pollsystem/results.php';
	return;
}
//Include and initialize Poll class
include 'Poll.php';
$poll = new Poll;

//Check whether vote is submitted


if(isset($_POST['voteSubmit']) && isset($_POST['voteOpt'])){
    $voteData = array(
        'poll_id' => $_POST['pollID'],
        'poll_option_id' => $_POST['voteOpt']
    );
    //Submit vote by Poll class
    $voteSubmit = $poll->vote($voteData);
    if($voteSubmit){ 
        //store in $_COOKIE to signify the user has voted
       // setcookie($_POST['pollID'], 1, time()+60*60*24*365);
        $statusMsg = 'Your vote has been submitted successfully.';
    }else{
        $statusMsg = 'Your vote already had submitted.';
    }
}
if(!isset($_POST['voteOpt'])){
    $errorMsg = 'Please select an option.';
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
 <link rel="stylesheet" href="features/pollsystem/poll.css">

<style type="text/css">
.pollContent{
   
}
.pollContent h3 {
    font-size: 18px;
    color: #0c1133;
    text-align: left;
    float: left;
    border-bottom: 2px solid #181e33;
    width: 40%;
    margin: 0 auto;
    padding-bottom: 10px;
}
.pollContent ul{
    list-style: none;
    float: left;
    width: 100%;
    padding: 10px;
}
.pollContent input[type="submit"], .pollContent a{
    border: none;
    font-size: 16px;
    color: #fff;
    border-radius: 3px;
    padding: 10px 15px 10px 15px; 
    background-color: #a88277;
    text-decoration: none;
    cursor: pointer;
}
.stmsg{font-size: 16px;color: #8dfb6d;}
</style>
</head>
<body>
<div class="container">
    <?php
        //Get poll and options data
        $pollDatas = $poll->getPolls();

        /*echo "<pre>";
        print_r($pollData);
        //var_dump($pollData);
        echo "<pre>";*/


    foreach($pollDatas as $pollData) {
    ?>


    <div class="pollContent">
<h1>Vote now
!</h1>
        <form action="" method="post" name="pollFrm">
		
            <h3><?php echo $pollData['poll']['subject']; ?></h3>
            <ul>

                <?php foreach ($pollData['options'] as $opt) {
                    echo '<li><input type="radio" name="voteOpt" value="' . $opt['id'] . '" >' . $opt['name'] . '</li>';
                } ?>

            </ul>

            <input style="background-color:#2dc3e8;" type="hidden" name="pollID"  value="<?php echo $pollData['poll']['id']; ?>">
            <input style="background-color:#2dc3e8;" type="submit" name="voteSubmit" class="button" value="Vote">
            <a style="background-color:#2dc3e8;" href="home.php?feature=pollsystem&action=results&pollID=<?php echo $pollData['poll']['id']; ?>">Results</a>
			
        </form>
        <?php
        if (isset($_POST['voteSubmit']) && $pollData['poll']['id'] == $_POST['pollID']) {
            echo !empty($statusMsg) ? '<p class="stmsg">' . $statusMsg . '</p>' : '';
        }
        ?>
        <?php
        if (isset($_POST['pollID'])) {

        if (isset($errorMsg) && $pollData['poll']['id'] == $_POST['pollID']) {
            echo !empty($errorMsg) ? '<p class="ermsg">' . $errorMsg . '</p>' : '';
        }
        }
            ?>
        </div>

    <?php } ?>
</div>
</body>
</html>