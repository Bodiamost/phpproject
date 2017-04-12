<?php 
$action=filter_input(INPUT_GET, 'action');

if ($action==='getCafesJSON')
{
	require_once '../../features/connect.php';
	require_once '../../features/restaurants/models/cafe.php';

	$db=Connect::DBconnect();
	$cafesobj=new CafeDAO($db);
	$search_place='';	
	
	if(isset($_POST['map_zoom'])&&!empty($_POST['map_zoom']))
	{
		$search_place=$_POST['search_place'];
		$distance=($_POST['map_zoom']/1000.0) < 2.5 ? 2.5:$_POST['map_zoom']/1000.0;
		$cafes=$cafesobj->getApprovedCafesByLocationJSON($_POST['map_lat'],$_POST['map_lng'],$distance,$_POST['map_page']);
	}
	else //
		$cafes=$cafesobj->getApprovedCafesJSON(isset($_POST['map_zoom']) ? $_POST['map_page']:0);

	$jcafes = json_encode($cafes);

	header("Content-Type: application/json");
	echo $jcafes;

	//require_once 'views/view_places.php';
}
else if ($action==='getCafeJSON'&& isset($_GET['id']))
{
	$id=filter_input(INPUT_GET, 'id');
	require_once '../../features/connect.php';
	require_once '../../features/restaurants/models/cafe.php';

	$db=Connect::DBconnect();
	$cafesobj=new CafeDAO($db);
	$cafe=$cafesobj->getCafe($id);

	$jcafe = json_encode($cafe);

	header("Content-Type: application/json");
	echo $jcafe;
}
else if ($action==='viewlist')
{
	require_once 'features/connect.php';
	require_once 'features/restaurants/models/cafe.php';

	$db=Connect::DBconnect();
	$cafesobj=new CafeDAO($db);
	$search_place='';	
	
	if(isset($_POST['map_zoom']))
	{
		$search_place=$_POST['search_place'];
		$distance=($_POST['map_zoom']/1000.0) < 2.5 ? 2.5:$_POST['map_zoom']/1000.0;
		$cafes=$cafesobj->getApprovedCafesByLocation($_POST['map_lat'],$_POST['map_lng'],$distance);
	}
	else
		$cafes=$cafesobj->getUserCafes($_SESSION['user_id']);

	require_once 'views/view_cafes.php';
}
else if ($action==='viewcafe' && isset($_GET['id'])) 
{
	$id=filter_input(INPUT_GET, 'id');
	require_once 'features/connect.php';
	require_once 'features/restaurants/models/cafe.php';

	$db=Connect::DBconnect();
	$cafesobj=new CafeDAO($db);
	$cafe=$cafesobj->getCafe($id);
	$open_hours=json_decode($cafe->getHours());
	require_once 'views/view_cafe.php';
}
else if ($action==='editcafe' && isset($_GET['id'])) 
{
	require_once 'features/restaurants/editCafeController.php';
}
else if ($action==='addcafe') 
{
	require_once 'features/restaurants/addCafeController.php';
}
else
{
	echo "<div class='box' style='height:300px;text-align: center;'><h2>Page not found</h2></div>";
}
?>