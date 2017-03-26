<?php 
$action=filter_input(INPUT_GET, 'action');

if ($action==='viewlist')
{
	require_once 'features/connect.php';
	require_once 'features/places/models/place.php';

	$db=Connect::DBconnect();
	$placesobj=new PlaceDAO($db);
	$places=$placesobj->getApprovedPlaces();
	require_once 'views/view_places.php';
}
else if ($action==='viewplace' && isset($_GET['id'])) 
{
	$id=filter_input(INPUT_GET, 'id');
	require_once 'features/connect.php';
	require_once 'features/places/models/place.php';

	$db=Connect::DBconnect();
	$placesobj=new PlaceDAO($db);
	$place=$placesobj->getPlace($id);
	$open_hours=json_decode($place->getHours());
	require_once 'views/view_place.php';
}
else if ($action==='editplace' && isset($_GET['id'])) 
{
	require_once 'features/places/editPlaceController.php';
}
else if ($action==='addplace') 
{
	require_once 'features/places/addPlaceController.php';
}
else
{
	echo "<div class='box' style='height:300px;text-align: center;'><h2>Page not found</h2></div>";
}
?>