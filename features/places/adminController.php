<?php 
$action=filter_input(INPUT_GET, 'action');

if ($action==='viewlist')
{
	require_once 'features/connect.php';
	require_once 'features/places/models/place.php';

	$db=Connect::DBconnect();
	$placesobj=new PlaceDAO($db);
	$places=$placesobj->getPlaces();
	require_once 'admin_views/view_places.php';
}
else if ($action==='deleteplace' && isset($_GET['id'])) 
{
	require_once 'features/connect.php';
	require_once 'features/places/models/place.php';

	$db=Connect::DBconnect();
	$placesobj=new PlaceDAO($db);
	$id=filter_input(INPUT_GET, 'id');
	$place=$placesobj->getPlace($id);
	if(isset($_POST['delete']))
	{
		$placesobj->deletePlace($place);
		echo "<div class='box' style='height:300px;text-align: center;'><h2>Deleted</h2></div>";
	}
	else
	{	
		require_once 'admin_views/delete_place.php';
	}
}
else if ($action==='editplace' && isset($_GET['id'])) 
{
	require_once 'features/places/editAdminPlaceController.php';
}
else if ($action==='addplace') 
{
	require_once 'features/places/addAdminPlaceController.php';
}
else
{
	echo "<div class='box' style='height:300px;text-align: center;'><h2>Page not found</h2></div>";
}
?>