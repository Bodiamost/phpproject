<?php 
//session_start();/////
	require_once 'features/connect.php';
	require_once 'features/validate.php';
	require_once 'features/trips/models/trip.php';

    $step=0;

    if(isset($_POST['cancel']))
    {
        $_SESSION['tripinfo']['step'] = 1; 
        $_SESSION['tripinfo']['places'] = '0';
        $_SESSION['tripinfo']['events'] = '0';
        $_SESSION['tripinfo']['cafes'] = '0';  
    }

    if(isset($_POST['prevstep']))
    {
        $_SESSION['tripinfo']['step'] -= 1;   
    }
    if(isset($_SESSION['tripinfo']['step'])) $step=$_SESSION['tripinfo']['step']; 
    else $step=filter_input(INPUT_GET, 'step');

	if(empty($step)||$step==0)
	{
		$_SESSION['tripinfo']['step'] = 1;
        $step=1;
		//session_unset($_SESSION['tripinfo']);
		$_SESSION['tripinfo']['search_place'] = '';
		$_SESSION['tripinfo']['map_lat'] = '';
		$_SESSION['tripinfo']['map_lng'] = '';
		$_SESSION['tripinfo']['map_zoom'] = '';
		$_SESSION['tripinfo']['trip_start'] = '';
		$_SESSION['tripinfo']['trip_end'] = '';
        $_SESSION['tripinfo']['places'] = '0';
        $_SESSION['tripinfo']['events'] = '0';
        $_SESSION['tripinfo']['cafes'] = '0';
	}
	if ($step===1)
    {
    	if (isset($_POST['tripgo']))
    	{
            $_SESSION['tripinfo']['step'] = 2;
            $step=2;
    		$_SESSION['tripinfo']['search_place'] = $_POST['search_place'];
    		$_SESSION['tripinfo']['map_lat'] = $_POST['map_lat'];
    		$_SESSION['tripinfo']['map_lng'] = $_POST['map_lng'];
    		$_SESSION['tripinfo']['map_zoom'] = $_POST['map_zoom'];
    		$_SESSION['tripinfo']['trip_start'] = $_POST['trip_start'];
    		$_SESSION['tripinfo']['trip_end'] = $_POST['trip_end'];

            //header('Location: home.php?feature=trips&action=new_trip&step=2');
            $ajaxdatafeature='place';
            $ajaxdataaction='Place';
            require_once 'views/create_trip.php';
    	}
    	else
    		require_once 'views/create_trip.php';
    }
    if ($step===2)
    {

    	if (isset($_POST['nextstep']))
    	{
            $_SESSION['tripinfo']['step'] = 3;
    		$_SESSION['tripinfo']['places'] = $_POST['items_chosen'];

    		//header('Location: index.php?action=new_trip&step=3');
            $ajaxdatafeature='event';
            $ajaxdataaction='Event';
            require_once 'views/create_trip.php';
    	}
    	else
    	{
        	$ajaxdatafeature='place';
        	$ajaxdataaction='Place';
        	require_once 'views/create_trip.php';
       	}
    }
    else if ($step===3)
    {
    	if (isset($_POST['nextstep']))
    	{
            $_SESSION['tripinfo']['step'] = 4;
    		$_SESSION['tripinfo']['events'] = $_POST['items_chosen'];

    		//header('Location: index.php?action=new_trip&step=4');
            $ajaxdatafeature='restaurant';
            $ajaxdataaction='Cafe';
            require_once 'views/create_trip.php';
    	}
    	else
    	{
	        $ajaxdatafeature='event';
	        $ajaxdataaction='Event';
	        require_once 'views/create_trip.php';
	    }
    }  
    else if ($step===4)
    {
    	if (isset($_POST['nextstep']))
    	{
            $_SESSION['tripinfo']['step'] = 5;
    		$_SESSION['tripinfo']['cafes'] = $_POST['items_chosen'];

            $db=Connect::DBconnect();
            $tripsobj=new TripDAO($db);
            $categories=$tripsobj->getCategories();
            $trip=new Trip();
            $validate=new Validate();
            $fields=$validate->getFields();
            $fields->addField('trip_title');
            $fields->addField('trip_cat');
            $fields->addField('trip_desc');
            $placesIds=explode(",", $_SESSION['tripinfo']['places']);
            $eventsIds=explode(",", $_SESSION['tripinfo']['events']);
            $cafesIds=explode(",", $_SESSION['tripinfo']['cafes']);
            array_shift($placesIds);
            array_shift($eventsIds);
            array_shift($cafesIds);

            $items = array(
            'places' => json_encode($placesIds,JSON_NUMERIC_CHECK), 
            'events' => json_encode($eventsIds,JSON_NUMERIC_CHECK), 
            'cafes' => json_encode($cafesIds,JSON_NUMERIC_CHECK)
            );
            $trip->setItems(json_encode($items));

    		require_once 'views/add_trip_final_step.php';
    	}
    	else
    	{
	        $ajaxdatafeature='restaurant';
	        $ajaxdataaction='Cafe';
	        require_once 'views/create_trip.php';
	    }
    } 
    else if ($step===5)
    {

        $db=Connect::DBconnect();
        $tripsobj=new TripDAO($db);
        $categories=$tripsobj->getCategories();
        $trip=new Trip();
        $validate=new Validate();
        $fields=$validate->getFields();
        $fields->addField('trip_title');
        $fields->addField('trip_cat');
        $fields->addField('trip_desc');

        $placesIds=explode(",", $_SESSION['tripinfo']['places']);
        $eventsIds=explode(",", $_SESSION['tripinfo']['events']);
        $cafesIds=explode(",", $_SESSION['tripinfo']['cafes']);
        array_shift($placesIds);
        array_shift($eventsIds);
        array_shift($cafesIds);

        $items = array(
        'places' => json_encode($placesIds,JSON_NUMERIC_CHECK), 
        'events' => json_encode($eventsIds,JSON_NUMERIC_CHECK), 
        'cafes' => json_encode($cafesIds,JSON_NUMERIC_CHECK)
        );
        $trip->setItems(json_encode($items));

        if (isset($_POST['tripsave']))
        {
            $trip->setCid($_POST['trip_cat']);
            $trip->setTitle($_POST['trip_title']);
            $trip->setDesc($_POST['trip_desc']);

            $trip->setLocation($_SESSION['tripinfo']['search_place']);
            $trip->setLat($_SESSION['tripinfo']['map_lat']);
            $trip->setLng($_SESSION['tripinfo']['map_lng']);
            $trip->setDateStart($_SESSION['tripinfo']['trip_start']);            
            $trip->setDateEnd($_SESSION['tripinfo']['trip_end']);

            $trip->setRating("0");
            $trip->setPostedBy($_SESSION['user_id']);
            $trip->setPosted(date("Y-m-d H:i:s"));
            $trip->setStatus("0");

            ////////////////////////////////////////////////////
            $validate->text('trip_title',$trip->getTitle());
            $validate->text('trip_cat',$trip->getCid());
            $validate->text('trip_desc',$trip->getDesc(),true,1,10000);

            if($fields->hasErrors())
            {
                require_once 'views/add_trip_final_step.php';
                return;
            }
            else
            {
                $step+=1; //header('Location: index.php?feature=places&action=viewlist');
            }
           
            //header('Location: index.php?action=new_trip&step=6');
            $tripsobj->addTrip($trip);
            $_SESSION['tripinfo']['step'] = 1;
            $_SESSION['tripinfo']['places'] = '0';
            $_SESSION['tripinfo']['events'] = '0';
            $_SESSION['tripinfo']['cafes'] = '0';
            echo "<div class='box' style='height:300px;text-align: center;'><h2>Added</h2></div>";
        }
        else
        {
            require_once 'views/add_trip_final_step.php';
        }
    }
    
?>