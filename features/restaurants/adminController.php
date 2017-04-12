<?php 
$action=filter_input(INPUT_GET, 'action');

if ($action==='viewlist')
{
	require_once 'features/connect.php';
	require_once 'features/restaurants/models/cafe.php';

	$db=Connect::DBconnect();
	$cafesobj=new CafeDAO($db);
	$cafes=$cafesobj->getCafes();
	require_once 'admin_views/view_cafes.php';
}
else if ($action==='deletecafe' && isset($_GET['id'])) 
{
	require_once 'features/connect.php';
	require_once 'features/restaurants/models/cafe.php';

	$db=Connect::DBconnect();
	$cafesobj=new CafeDAO($db);
	$id=filter_input(INPUT_GET, 'id');
	$cafe=$cafesobj->getCafe($id);
	if(isset($_POST['delete']))
	{
		$cafesobj->deleteCafe($cafe);
		echo "<div class='box' style='height:300px;text-align: center;'><h2>Deleted</h2></div>";
	}
	else
	{	
		require_once 'admin_views/delete_cafe.php';
	}
}
else if ($action==='editcafe' && isset($_GET['id'])) 
{
	require_once 'features/restaurants/editAdminCafeController.php';
}
else if ($action==='addcafe') 
{
	require_once 'features/restaurants/addAdminCafeController.php';
}
else
{
	echo "<div class='box' style='height:300px;text-align: center;'><h2>Page not found</h2></div>";
}
?>