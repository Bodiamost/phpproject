<?php 

?>
<!doctype <!DOCTYPE html>
<html>
<head>
    <title>FSss</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" href="img/favicon.png">
    <title>WorldLink</title>
    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/font-awesome.min.css" rel="stylesheet">
    <link href="../../css/animate.min.css" rel="stylesheet">
    <link href="../../css/timeline.css" rel="stylesheet">
    <link href="../../css/cover.css" rel="stylesheet">
    <link href="../../css/forms.css" rel="stylesheet">
    <link href="../../css/buttons.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="features/chat/style.css" type="text/css" media="screen" /><!-- FOR Chat!!!!-->
    <link rel='stylesheet' type='text/css' href='../../features/albums/style.css'/><!--FOR albums-->
    <link rel='stylesheet' type='text/css' href='../../features/places/style.css'/><!--FOR places search -->

    
    <script src="../../js/jquery.1.11.1.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

</head>
<body>
<div>
    <div>
        <form id="search_form" action="" method="post">
            <input id="pac-input" name="search_place"  type="text" value="" placeholder="Enter a location">
            <fieldset>
                <div>
                    <input type="hidden" id="latInput" name="map_lat" value="" placeholder="">
                    <input type="hidden" id="lngInput" name="map_lng" value="" placeholder="">
                    <input type="hidden" id="zoomInput" name="map_zoom" value="" placeholder="">
                    <input type="hidden" id="page" name="map_page" value="0" placeholder="">
                </div>
                <div>
                    <label for="trip_start">Start date:</label>
                    <input type="date" name="trip_start" value="" placeholder="" required>
                </div>           
                <div>
                    <label for="trip_end">Start date:</label>
                    <input type="date" name="trip_end" value="" placeholder="" required>
                </div>
            </fieldset>
            <button id="tripitemssearch" type="submit" name="tripgo">Save</button>
        </form>
    </div>

   
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrv18VtDMOUV9l_DNUogXpN3xc96kFWks&libraries=geometry,places&callback=initAutocomplete">
    </script>
</div>
</body>
</html>
