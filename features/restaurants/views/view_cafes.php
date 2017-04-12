<div class="box">
	<h1 class="box-header">Cafes</h1>


    <div style="height:40px;">
        <form id="search_form" action="" method="post">
            <input id="pac-input" name="search_place"  type="text" value="<?php echo $search_place;?>" placeholder="Enter a location">
            <fieldset>
                <div>
                    <input type="hidden" id="latInput" name="map_lat" value="" placeholder="">
                    <input type="hidden" id="lngInput" name="map_lng" value="" placeholder="">
                    <input type="hidden" id="zoomInput" name="map_zoom" value="" placeholder="">
                </div>
            </fieldset>
        </form>
    </div>

    <div class="box-body row widget">
        <?php if(count($cafes)==0)  echo "No cafes at that location yet."; ?>
        <?php $counter = 0; foreach ($cafes as $cafe) {?>
        <div class="col-lg-6 col-md-6 col-sm-6 no-padding">
            <div class="widget-header">
                 <a href='home.php?feature=cafes&action=viewcafe&id=<?php echo($cafe->getId());?>'><?php echo(  $cafe->getTitle());?></a><br/>
            </div>
            <div class="widget-content">
                 <a href='home.php?feature=cafes&action=viewcafe&id=<?php echo($cafe->getId());?>'>
                    <img width="100%" src="<?php echo($cafe->getImage());?>">
                </a><br/>
            </div>
            <div class="widget-footer">
                <!--<a href='home.php?feature=cafes&action=editcafe&id=<?php echo($cafe->getId());?>'>Edit</a>
                <a href='home.php?feature=cafes&action=deletecafe&id=<?php echo($cafe->getId());?>'>Delete</a>-->
            </div>       
        </div>
        <?php if(++$counter % 2 === 0):?> </div><div class="box-body row widget"><?php endif;?>
        <?php };?>
    </div>
    <div class="box-footer">
        <a href="home.php?feature=cafes&action=addcafe">Add new cafe</a>
    </div>
</div>
   <script>
      // This example displays an address form, using the autocomplete feature
      // of the Google Places API to help users fill in the information.

      // This example requires the Places library. Include the libraries=cafes
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=cafes">

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
        // Get the cafe details from the autocomplete object.
        var place = autocomplete.getPlace();
    
        document.getElementById("latInput").value = place.geometry.location.lat();
        document.getElementById("lngInput").value = place.geometry.location.lng(); 
        //console.log(cafe.geometry.viewport);
        var point1=new google.maps.LatLng(place.geometry.viewport.f.f,place.geometry.viewport.b.f);
        var point2=new google.maps.LatLng(place.geometry.viewport.f.b,place.geometry.viewport.b.b);
         
        document.getElementById("zoomInput").value = google.maps.geometry.spherical.computeDistanceBetween(point1,point2)/2;
        $( "#search_form" ).submit();
      }
      
    </script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrv18VtDMOUV9l_DNUogXpN3xc96kFWks&libraries=geometry,places&callback=initAutocomplete">
</script>