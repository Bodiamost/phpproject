<?php 
$action=filter_input(INPUT_GET, 'action');

if ($action==='viewlist')
{
	require_once 'features/connect.php';
	require_once 'features/events/models/event.php';

	$db=Connect::DBconnect();
	$eventsobj=new EventDAO($db);
	$events=$eventsobj->getEvents();
	require_once 'admin_views/view_events.php';
}
else if ($action==='deleteevent' && isset($_GET['id'])) 
{
	require_once 'features/connect.php';
	require_once 'features/events/models/event.php';

	$db=Connect::DBconnect();
	$eventsobj=new EventDAO($db);
	$id=filter_input(INPUT_GET, 'id');
	$event=$eventsobj->getEvent($id);
	if(isset($_POST['delete']))
	{
		$eventsobj->deleteEvent($event);
		echo "<div class='box' style='height:300px;text-align: center;'><h2>Deleted</h2></div>";
	}
	else
	{	
		require_once 'admin_views/delete_event.php';
	}
}
else if ($action==='editevent' && isset($_GET['id'])) 
{
	require_once 'features/events/editAdminEventController.php';
}
else if ($action==='addevent') 
{
	require_once 'features/events/addAdminEventController.php';
}
else
{
	echo "<div class='box' style='height:300px;text-align: center;'><h2>Page not found</h2></div>";
}
?>