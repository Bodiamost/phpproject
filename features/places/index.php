<?php 
$action=filter_input(INPUT_GET, 'action');

if ($action==='getPlacesJSON')
{
	require_once '../../features/connect.php';
	require_once '../../features/places/models/place.php';

	$db=Connect::DBconnect();
	$placesobj=new PlaceDAO($db);
	$search_place='';	
	
	if(isset($_POST['map_zoom'])&&!empty($_POST['map_zoom']))
	{
		$search_place=$_POST['search_place'];
		$distance=($_POST['map_zoom']/1000.0) < 2.5 ? 2.5:$_POST['map_zoom']/1000.0;
		$places=$placesobj->getApprovedPlacesByLocationJSON($_POST['map_lat'],$_POST['map_lng'],$distance,$_POST['map_page']);
	}
	else //
		$places=$placesobj->getApprovedPlacesJSON(isset($_POST['map_zoom']) ? $_POST['map_page']:0);

	$jplaces = json_encode($places);

	header("Content-Type: application/json");
	echo $jplaces;

	//require_once 'views/view_places.php';
}
else if ($action==='getPlaceJSON'&& isset($_GET['id']))
{
	$id=filter_input(INPUT_GET, 'id');
	require_once '../../features/connect.php';
	require_once '../../features/places/models/place.php';

	$db=Connect::DBconnect();
	$placesobj=new PlaceDAO($db);
	$place=$placesobj->getPlace($id);

	$jplace = json_encode($place);

	header("Content-Type: application/json");
	echo $jplace;
}
else if ($action==='viewlist')
{
	require_once 'features/connect.php';
	require_once 'features/places/models/place.php';

	$db=Connect::DBconnect();
	$placesobj=new PlaceDAO($db);
	$search_place='';	
	
	if(isset($_POST['map_zoom']))
	{
		$search_place=$_POST['search_place'];
		$distance=($_POST['map_zoom']/1000.0) < 2.5 ? 2.5:$_POST['map_zoom']/1000.0;
		$places=$placesobj->getApprovedPlacesByLocation($_POST['map_lat'],$_POST['map_lng'],$distance);
	}
	else
		$places=$placesobj->getUserPlaces($_SESSION['user_id']);

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