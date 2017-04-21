<?php 
	require_once 'features/connect.php';
	require_once 'features/validate.php';
	require_once 'features/places/models/place.php';

	$db=Connect::DBconnect();
	$placesobj=new PlaceDAO($db);
	$categories=$placesobj->getCategories();
	$place=new Place();
    $validate=new Validate();
	$fields=$validate->getFields();
	$fields->addField('place_title');
	$fields->addField('place_cat');
	$fields->addField('place_desc');
	$fields->addField('place_address');
	$fields->addField('place_contact');
	$fields->addField('place_image');
	//$fields->addField('place_lat');
	//$fields->addField('place_lng');


	if(isset($_POST['add']))
	{
		
		$place->setCid($_POST['place_cat']);
		$place->setTitle($_POST['place_title']);
		$place->setDesc($_POST['place_desc']);
		//$place->setHours($_POST['place_hours']);
		$place->setAddress($_POST['place_address']);
		$place->setContact($_POST['place_contact']);
		$place->setLat($_POST['place_lat']);
		$place->setLng($_POST['place_lng']);

		//$place->setImage("");
		$place->setRating("0");
		$place->setPostedBy($_SESSION['user_id']);
		$place->setPosted(date("Y-m-d H:i:s"));
		$place->setApproved("0");
		$place->setVerified("0");

		$open_hours = array(
			'M_S' => $_POST['place_hours_M_S'], 'M_E' => $_POST['place_hours_M_E'],
			'T_S' => $_POST['place_hours_T_S'], 'T_E' => $_POST['place_hours_T_E'],
			'W_S' => $_POST['place_hours_W_S'], 'W_E' => $_POST['place_hours_W_E'],
			'R_S' => $_POST['place_hours_R_S'], 'R_E' => $_POST['place_hours_R_E'],
			'F_S' => $_POST['place_hours_F_S'], 'F_E' => $_POST['place_hours_F_E'],
			'S_S' => $_POST['place_hours_S_S'], 'S_E' => $_POST['place_hours_S_E'],
			'N_S' => $_POST['place_hours_N_S'], 'N_E' => $_POST['place_hours_N_E'],
			);
		$place->setHours(json_encode($open_hours));
		$open_hours=json_decode($place->getHours());
		////////////////////////////////////////////////////
		$validate->text('place_title',$place->getTitle());
		$validate->text('place_cat',$place->getCid());
		$validate->text('place_desc',$place->getDesc(),true,1,10000);
		$validate->text('place_address',$place->getAddress());
		$validate->text('place_contact',$place->getContact());
		//$validate->text('place_lat',$place->getTitle());
		if($fields->hasErrors())
		{
			require_once 'views/add_place.php';
			return;
		}
		else
		{
			//header('Location: index.php?feature=places&action=viewlist');
		}
		////////////////////////////////////////////////////
		$targetDir = "features/places/images/";
		$targetName = uniqid("place");
		require_once 'features/imageUploadHelper.php';
		$smg = uploadImage($targetDir,$targetName);
		//echo $smg;
		$place->setImage($targetDir.$targetName);
		////////////////////////////////////////////////////


		$placesobj->addPlace($place);
		echo "<div class='box' style='height:300px;text-align: center;'><h2>Added</h2></div>";
	}
	else
	{	
		require_once 'views/add_place.php';
	}
?>