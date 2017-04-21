<?php 
	require_once 'features/connect.php';
	require_once 'features/validate.php';
	require_once 'features/restaurants/models/cafe.php';

	$db=Connect::DBconnect();
	$cafesobj=new CafeDAO($db);
	$categories=$cafesobj->getCategories();
	$cafe=new Cafe();
    $validate=new Validate();
	$fields=$validate->getFields();
	$fields->addField('cafe_title');
	$fields->addField('cafe_cat');
	$fields->addField('cafe_desc');
	$fields->addField('cafe_address');
	$fields->addField('cafe_contact');
	$fields->addField('cafe_image');
	//$fields->addField('cafe_lat');
	//$fields->addField('cafe_lng');


	if(isset($_POST['add']))
	{
		
		$cafe->setCid($_POST['cafe_cat']);
		$cafe->setTitle($_POST['cafe_title']);
		$cafe->setDesc($_POST['cafe_desc']);
		//$cafe->setHours($_POST['cafe_hours']);
		$cafe->setAddress($_POST['cafe_address']);
		$cafe->setContact($_POST['cafe_contact']);
		$cafe->setLat($_POST['cafe_lat']);
		$cafe->setLng($_POST['cafe_lng']);

		//$cafe->setImage("");
		$cafe->setRating("0");
		$cafe->setPostedBy("1");
		$cafe->setPosted(date("Y-m-d H:i:s"));
		$cafe->setApproved("0");
		$cafe->setVerified("0");

		$open_hours = array(
			'M_S' => $_POST['cafe_hours_M_S'], 'M_E' => $_POST['cafe_hours_M_E'],
			'T_S' => $_POST['cafe_hours_T_S'], 'T_E' => $_POST['cafe_hours_T_E'],
			'W_S' => $_POST['cafe_hours_W_S'], 'W_E' => $_POST['cafe_hours_W_E'],
			'R_S' => $_POST['cafe_hours_R_S'], 'R_E' => $_POST['cafe_hours_R_E'],
			'F_S' => $_POST['cafe_hours_F_S'], 'F_E' => $_POST['cafe_hours_F_E'],
			'S_S' => $_POST['cafe_hours_S_S'], 'S_E' => $_POST['cafe_hours_S_E'],
			'N_S' => $_POST['cafe_hours_N_S'], 'N_E' => $_POST['cafe_hours_N_E'],
			);
		$cafe->setHours(json_encode($open_hours));
		$open_hours=json_decode($cafe->getHours());
		////////////////////////////////////////////////////
		$validate->text('cafe_title',$cafe->getTitle());
		$validate->text('cafe_cat',$cafe->getCid());
		$validate->text('cafe_desc',$cafe->getDesc(),true,1,10000);
		$validate->text('cafe_address',$cafe->getAddress());
		$validate->text('cafe_contact',$cafe->getContact());
		//$validate->text('cafe_lat',$cafe->getTitle());
		if($fields->hasErrors())
		{
			require_once 'views/add_cafe.php';
			return;
		}
		else
		{
			//header('Location: index.php?feature=cafes&action=viewlist');
		}
		////////////////////////////////////////////////////
		$targetDir = "features/restaurants/images/";
		$targetName = uniqid("cafe");
		require_once 'features/imageUploadHelper.php';
		$smg = uploadImage($targetDir,$targetName,"cafe");
		//echo $smg;
		$cafe->setImage($targetDir.$targetName);
		////////////////////////////////////////////////////


		$cafesobj->addCafe($cafe);
		echo "<div class='box' style='height:300px;text-align: center;'><h2>Added</h2></div>";
	}
	else
	{	
		require_once 'views/add_cafe.php';
	}
?>