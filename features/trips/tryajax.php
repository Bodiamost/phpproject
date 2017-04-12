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
 	<div style="height:40px;">
        <form id="search_form" action="" method="post">
            <input id="pac-input" name="search_place"  type="text" value="" placeholder="Enter a location">
            <fieldset>
                <div>
                    <input type="hidden" id="latInput" name="map_lat" value="" placeholder="">
                    <input type="hidden" id="lngInput" name="map_lng" value="" placeholder="">
                    <input type="hidden" id="zoomInput" name="map_zoom" value="" placeholder="">
                    <input type="hidden" id="page" name="map_page" value="0" placeholder="">
                </div>
            </fieldset>
        </form>
    </div>

	<section id="results" class="box-body row widget">
	

	</section>
    <script>
		var autocomplete;

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('pac-input')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        $( "#search_form" ).keypress(function (e) {
                 var key = e.which;
                 if(key == 13)  // the enter key code
                  {
                    return false;  
                  }
                });   
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
    
        document.getElementById("latInput").value = place.geometry.location.lat();
        document.getElementById("lngInput").value = place.geometry.location.lng(); 
        //console.log(place.geometry.viewport);
        var point1=new google.maps.LatLng(place.geometry.viewport.f.f,place.geometry.viewport.b.f);
        var point2=new google.maps.LatLng(place.geometry.viewport.f.b,place.geometry.viewport.b.b);
         
        document.getElementById("zoomInput").value = google.maps.geometry.spherical.computeDistanceBetween(point1,point2)/2;
        $( "#search_form" ).submit();
      }
    	$('#search_form').submit( function(event){
                    event.preventDefault();
	                document.getElementById("page").value=0;
	               
       				var header ="<h3>Search result:</h3>";
        			$('#results').html(header);
                  	loadPlaces();                    
                });
    	function objectifyForm(formArray) {//serialize data function
              var returnArray = {};
              for (var i = 0; i < formArray.length; i++){
                returnArray[formArray[i]['name']] = formArray[i]['value'];
              }
              return returnArray;
        }
        $(document).ready(loadPlaces);
        var bottomreached=false;
        var header ="<h3>Search result:</h3>";
        $('#results').html(header);
        function loadPlaces(){
        	var formdata = $('#search_form').serializeArray();
            //formdata.push({name: 'savervw', value: 'true'});
            formdata=objectifyForm(formdata);
            $.post('../../features/restaurants/index.php?action=getCafesJSON',formdata, function (data) {
	            var result ="<div class='row'>";
	            if(data.length>0)    
	            {    
	                $.each(data, function(index,item){
						//console.log(place);
						result +='<div class="col-lg-6 col-md-6 col-sm-6 no-padding">';
						result +='<div class="widget-header">';
						result +="<a href='../../home.php?feature="+item.item_title+"s&action=view"+item.item_title+"&id="+item.id+"'>"+item.title;
						result +='</a><br/></div>';
						result +='<div class="widget-content">';
						result +="<a href='../../home.php?feature="+item.item_title+"s&action=view"+item.item_title+"&id="+item.id+"'><img width='100%' src='../../"+item.image+"'>";
						result +='</a><br/></div>';       
						result +='</div>';
	                });
	                document.getElementById("page").value=parseInt(document.getElementById("page").value)+1;
	                bottomreached=false;
	            }
	            else result+="No more data";

                result += "</div>";
                $('#results').append(result);
            });
            
         	
		}
		$(document).scroll(function() {
				if($(window).scrollTop()+window.innerHeight>$('body').height()&&!bottomreached)
					{
					 	bottomreached=true;
					 	loadPlaces();
					}
			});
    </script>
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrv18VtDMOUV9l_DNUogXpN3xc96kFWks&libraries=geometry,places&callback=initAutocomplete">
	</script>
</div>
</body>
</html>
