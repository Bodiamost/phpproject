<?php 
//session_save_path(dirname($_SERVER['DOCUMENT_ROOT']).'\bmostyts\network\tmp'); //for winhost
//session_save_path(dirname($_SERVER['DOCUMENT_ROOT']).'/mysite/5202PHP/network/tmp'); //for my laptop
ini_set("display_errors",1);
session_save_path(getcwd().'/../../tmp'); //for Ipage
session_start();
if(isset($_GET['action']))
{
    $action=filter_input(INPUT_GET, 'action');
}
$featuresdata=array(1=>'place',2=>'event',3=>'cafe',4=>'trip');
if ($action==='getreviewsJSON')
{
	require_once '../connect.php';
	require_once 'models/review.php';
	$id=filter_input(INPUT_GET, 'id');
	$type_id=filter_input(INPUT_GET, 'type');
	$db=Connect::DBconnect();
	$reviewsobj=new ReviewDAO($db);
	$reviews=$reviewsobj->getReviews($type_id,$id);
	$jreviews = json_encode($reviews);

	header("Content-Type: application/json");
	echo $jreviews;
}
else if ($action==='addreviewAJAX')
{
	require_once '../connect.php';
	require_once '../validate.php';
	require_once 'models/review.php';
	$id=filter_input(INPUT_GET, 'id');
	$type_id=filter_input(INPUT_GET, 'type');
    $validate=new Validate();
	$fields=$validate->getFields();
	$fields->addField('review_title');
	$fields->addField('review_desc');
    if($type_id!=4)
    {
        $fields->addField('visit_loadness');
        $fields->addField('visit_duration');
    }
    $fields->addField('review_rating');


	if ($id!='' && $type_id!='')
	{
		$db=Connect::DBconnect();
		$reviewsobj=new ReviewDAO($db);
		//$reviews=$reviewsobj->getReviews($type_id,$id);
		$visit=new Visit();
		$review=new Review();
		if (isset($_POST['savervw'])) 
		{

			//$visit->id
			if($type_id!=4)
			{
				$visit->item_type_id=$type_id;
				$visit->item_id=$id;
				$visit->user_id=$_SESSION['user_id'];// From session
				$visit->date=$_POST['visit_time'];
				$visit->duration=isset($_POST['visit_duration']) ? $_POST['visit_duration'] : '';
				$visit->loadness= isset($_POST['visit_loadness']) ? $_POST['visit_loadness'] : '';
                $validate->text('visit_loadness',$visit->loadness);
                $validate->text('visit_duration',$visit->duration);

			}
			else
			{
				$visit->item_type_id=$type_id;
				$visit->item_id=$id;
				$visit->user_id=$_SESSION['user_id'];// From session
				$visit->date='none';
				$visit->duration='0';
				$visit->loadness='0';
			}
			$review->title=$_POST['review_title'];
			$review->description=$_POST['review_desc'];
			$review->date=date("Y-m-d H:i:s");
			$review->rating=isset($_POST['review_rating'])?$_POST['review_rating']:'';

            $validate->text('review_rating',$review->rating);
			$validate->text('review_title',$review->title);
			$validate->text('review_desc',$review->description,true,1,10000);

			if($fields->hasErrors())
			{
				require_once 'views/add_reviewAJAX.php';
				return;
			}
			else
			{
				$reviewsobj->saveVisit($visit);
				$review->visit_id=$visit->id;
				$reviewsobj->saveReview($review);
				//header('Location: ../../home.php?feature='.$featuresdata[$type_id].'s&action=view'.$featuresdata[$type_id].'&id='.$id);
			}
		}
		else
			require_once 'views/add_reviewAJAX.php';	
	}
	else
		echo "<div class='box' style='height:300px;text-align: center;'><h2>No reviews yet! </h2></div>";
}
else if ($action==='deletereview')
{
	require_once '../connect.php';
	require_once 'models/review.php';
	$rid=filter_input(INPUT_GET, 'id');
	$review=new Review();
	if ($rid!='')
	{
		$db=Connect::DBconnect();
		$reviewsobj=new ReviewDAO($db);
		$review=$reviewsobj->getReviewVisitById($rid);
		if($_SESSION['user_id']!=$review->user_id) {echo "You do not have permissions for that action"; return;}
		$reviewsobj->deleteReview($review);
		//header('Location: ../../home.php?feature='.$featuresdata[$review->item_type_id].'s&action=view'.$featuresdata[$review->item_type_id].'&id='.$review->item_id);
	}
	else
		echo "<div class='box' style='height:300px;text-align: center;'><h2>Review already deleted! </h2></div>";
	
}
else if ($action==='viewreviews')
{
	require_once '../connect.php';
	require_once 'models/review.php';
	$id=filter_input(INPUT_GET, 'id');
	$type_id=filter_input(INPUT_GET, 'type');
	if ($id!='' && $type_id!='')
	{
		$db=Connect::DBconnect();
		$reviewsobj=new ReviewDAO($db);
		$reviews=$reviewsobj->getReviews($type_id,$id);
		require_once 'views/view_review.php';
	}
	else
		echo "<div class='box' style='height:300px;text-align: center;'><h2>No reviews yet! </h2></div>";
	
}
else
{
	echo "<div class='box' style='height:300px;text-align: center;'><h2>Page not found</h2></div>";
}
?>