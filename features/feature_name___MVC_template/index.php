<?php 
$action=filter_input(INPUT_GET, 'action'); //render an action

if ($action==='viewlist')//if matches an action
{
    require_once 'features/connect.php'; // include connect to database (on your localhost just replace only this file)
    require_once 'features/places/models/place.php';// include model

    //GET data thought model from database to PHP and make calculations
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
        $places=$placesobj->getApprovedPlaces();

    require_once 'views/view_places.php';//include appropriate view to present received data
}
else if ($action==='viewplace' && isset($_GET['id']))//Anouther oprion
{
    require_once 'features/places/viewPlaceController.php';// include specific action controller
    /* In features/places/viewPlaceController.php file:
    require_once 'features/connect.php'; // include connect to database (on your localhost just replace only this file)
    require_once 'features/places/models/place.php';// include model

    //GET data thought model from database to PHP and make calculations
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
        $places=$placesobj->getApprovedPlaces();

    require_once 'views/view_places.php';//include appropriate view to present received data
     */
}
?>