<?php 
	require_once 'features/connect.php';
	require_once 'features/validate.php';
	require_once 'features/events/models/event.php';

	$db=Connect::DBconnect();
	$eventsobj=new EventDAO($db);
	$categories=$eventsobj->getCategories();
	$id=filter_input(INPUT_GET, 'id');
	$event=$eventsobj->getEvent($id);
	
	if($_SESSION['user_id']!=$event->getpostedBy())
	{
		echo "You do not have such permissions!";
		return;
	}
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

	if(isset($_POST['edit']))
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
		////////////////////////////////////////////////////
		$validate->text('event_title',$event->getTitle());
		$validate->text('event_cat',$event->getCid());
		$validate->text('event_desc',$event->getDesc(),true,1,10000);
		echo $fields->hasErrors(); 
		$validate->text('event_address',$event->getAddress());
		//echo $fields->hasErrors(); 
		$validate->text('event_contact',$event->getContact());

		if($fields->hasErrors())
		{
			require_once 'views/edit_event.php';
			return;
		}
		else
		{
			//header('Location: index.php?feature=events&action=viewlist');
		}
		////////////////////////////////////////////////////
		////////////////////////////////////////////////////
		if(isset($_FILES["event_image"])&&!empty($_FILES["event_image"]['name']))
		{
			$targetDir = "features/events/images/";
			$targetName = uniqid("event");
			require_once 'imageUploadHelper.php';
			$smg = uploadImage($targetDir,$targetName);
			echo $smg;
			$event->setImage($targetDir.$targetName);
		}
		////////////////////////////////////////////////////
		$eventsobj->updateEvent($event);
		echo "<div class='box' style='height:300px;text-align: center;'><h2>Updated</h2></div>";
	}
	else
	{	
		require_once 'views/edit_event.php';
	}
?>