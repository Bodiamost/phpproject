<?php 
	require_once 'features/connect.php';
	require_once 'features/validate.php';
	require_once 'features/events/models/event.php';

	$db=Connect::DBconnect();
	$eventsobj=new EventDAO($db);
	$categories=$eventsobj->getCategories();
	$event=new Event();
    $validate=new Validate();
	$fields=$validate->getFields();
	$fields->addField('event_title');
	$fields->addField('event_cat');
	$fields->addField('event_desc');
	$fields->addField('event_address');
	$fields->addField('event_contact');
	$fields->addField('event_image');
	//$fields->addField('event_lat');
	//$fields->addField('event_lng');


	if(isset($_POST['add']))
	{
		
		$event->setCid($_POST['event_cat']);
		$event->setTitle($_POST['event_title']);
		$event->setDesc($_POST['event_desc']);
		//$event->setHours($_POST['event_hours']);
		$event->setAddress($_POST['event_address']);
		$event->setContact($_POST['event_contact']);
		$event->setLat($_POST['event_lat']);
		$event->setLng($_POST['event_lng']);
		
		$event->setStart($_POST['event_start']);
		$event->setEnd($_POST['event_end']);

		//$event->setImage("");
		$event->setRating("0");
		$event->setPostedBy("1");
		$event->setPosted(date("Y-m-d H:i:s"));
		$event->setApproved("0");
		$event->setVerified("0");

		////////////////////////////////////////////////////
		$validate->text('event_title',$event->getTitle());
		$validate->text('event_cat',$event->getCid());
		$validate->text('event_desc',$event->getDesc(),true,1,10000);
		$validate->text('event_address',$event->getAddress());
		$validate->text('event_contact',$event->getContact());
		//$validate->text('event_lat',$event->getTitle());
		if($fields->hasErrors())
		{
			require_once 'views/add_event.php';
			return;
		}
		else
		{
			//header('Location: index.php?feature=events&action=viewlist');
		}
		////////////////////////////////////////////////////
		$targetDir = "features/events/images/";
		$targetName = uniqid("event");
		require_once 'features/imageUploadHelper.php';
		$smg = uploadImage($targetDir,$targetName,"event");
		//echo $smg;
		$event->setImage($targetDir.$targetName);
		////////////////////////////////////////////////////


		$eventsobj->addEvent($event);
		echo "<div class='box' style='height:300px;text-align: center;'><h2>Added</h2></div>";
	}
	else
	{	
		require_once 'views/add_event.php';
	}
?>