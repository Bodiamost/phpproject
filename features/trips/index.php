<?php 
$action=filter_input(INPUT_GET, 'action');

if ($action==='viewlist')
{
	require_once 'features/connect.php';
	require_once 'features/trips/models/trip.php';

	$db=Connect::DBconnect();
	$tripsobj=new TripDAO($db);
	$search_place='';	
	
	if(isset($_POST['map_zoom']))
	{
		$search_place=$_POST['search_place'];
		$distance=($_POST['map_zoom']/1000.0) < 2.5 ? 2.5:$_POST['map_zoom']/1000.0;
		$trips=$tripsobj->getTripsByLocation($_POST['map_lat'],$_POST['map_lng'],$distance);
	}
	else
		$trips=$tripsobj->getUserTrips($_SESSION['user_id']);

	require_once 'views/trips_view.php';
}
else if ($action==='viewtrip')
{
	$id=filter_input(INPUT_GET, 'id');
	require_once 'features/connect.php';
	require_once 'features/trips/models/trip.php';

	$db=Connect::DBconnect();
	$tripsobj=new TripDAO($db);
	$trip=$tripsobj->getTrip($id);
    require_once 'views/trip_view.php';
}
else if ($action==='new_trip')
{
    require_once 'addTripController.php';
}
else if ($action==='deletetrip')
{
   	$id=filter_input(INPUT_GET, 'id');
	require_once 'features/connect.php';
	require_once 'features/trips/models/trip.php';

	$db=Connect::DBconnect();
	$tripsobj=new TripDAO($db);
	$trip=$tripsobj->getTrip($id);
	$tripsobj->deleteTrip($trip);
	echo "Done!";
}
?>