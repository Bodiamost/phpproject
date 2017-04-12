<?php 
$action=filter_input(INPUT_GET, 'action');

if ($action==='getEventsJSON')
{
	require_once '../../features/connect.php';
	require_once '../../features/events/models/event.php';

	$db=Connect::DBconnect();
	$eventsobj=new EventDAO($db);
	$search_place='';	
	
	if(isset($_POST['map_zoom'])&&!empty($_POST['map_zoom']))
	{
		$search_place=$_POST['search_place'];
		$distance=($_POST['map_zoom']/1000.0) < 2.5 ? 2.5:$_POST['map_zoom']/1000.0;
		$events=$eventsobj->getApprovedEventsByLocationJSON($_POST['map_lat'],$_POST['map_lng'],$distance,$_POST['map_page']);
	}
	else //
		$events=$eventsobj->getApprovedEventsJSON(isset($_POST['map_zoom']) ? $_POST['map_page']:0);

	$jevents = json_encode($events);

	header("Content-Type: application/json");
	echo $jevents;

	//require_once 'views/view_places.php';
} 
else if ($action==='getEventJSON'&& isset($_GET['id']))
{
	$id=filter_input(INPUT_GET, 'id');
	require_once '../../features/connect.php';
	require_once '../../features/events/models/event.php';

	$db=Connect::DBconnect();
	$eventsobj=new EventDAO($db);
	$event=$eventsobj->getEvent($id);

	$jevent = json_encode($event);

	header("Content-Type: application/json");
	echo $jevent;
}
else if ($action==='viewlist')
{
	require_once 'features/connect.php';
	require_once 'features/events/models/event.php';

	$db=Connect::DBconnect();
	$eventsobj=new EventDAO($db);
	$search_place='';	
	
	if(isset($_POST['map_zoom']))
	{
		$search_place=$_POST['search_place'];
		$distance=($_POST['map_zoom']/1000.0) < 2.5 ? 2.5:$_POST['map_zoom']/1000.0;
		$events=$eventsobj->getApprovedEventsByLocation($_POST['map_lat'],$_POST['map_lng'],$distance);
	}
	else
		$events=$eventsobj->getUserEvents($_SESSION['user_id']);

	require_once 'views/view_events.php';
}
else if ($action==='viewevent' && isset($_GET['id'])) 
{
	$id=filter_input(INPUT_GET, 'id');
	require_once 'features/connect.php';
	require_once 'features/events/models/event.php';

	$db=Connect::DBconnect();
	$eventsobj=new EventDAO($db);
	$event=$eventsobj->getEvent($id);
	require_once 'views/view_event.php';
}
else if ($action==='editevent' && isset($_GET['id'])) 
{
	require_once 'features/events/editEventController.php';
}
else if ($action==='addevent') 
{
	require_once 'features/events/addEventController.php';
}
else
{
	echo "<div class='box' style='height:300px;text-align: center;'><h2>Page not found</h2></div>";
}
?>