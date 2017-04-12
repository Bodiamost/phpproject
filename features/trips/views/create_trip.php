<?php 

?>
<style type="text/css">
    .selected {background-color: green;}
</style>
<div class="box">
    <div>
        <form id="search_form" action="" method="post">
            <input id="pac-input" name="search_place"  type="text" value="<?php echo $_SESSION['tripinfo']['search_place'];?>" placeholder="Enter a location">
            <fieldset>
                <div>
                    <input type="hidden" id="latInput" name="map_lat" value="<?php echo $_SESSION['tripinfo']['map_lat'];?>" placeholder="">
                    <input type="hidden" id="lngInput" name="map_lng" value="<?php echo $_SESSION['tripinfo']['map_lng'];?>" placeholder="">
                    <input type="hidden" id="zoomInput" name="map_zoom" value="<?php echo $_SESSION['tripinfo']['map_zoom'];?>" placeholder="">
                    <input type="hidden" id="page" name="map_page" value="0" placeholder="">
                </div>
                <div>
                    <label for="trip_start">Start date:</label>
                    <input type="date" name="trip_start" value="<?php echo $_SESSION['tripinfo']['trip_start'];?>" placeholder="" required>
                </div>           
                <div>
                    <label for="trip_end">Start date:</label>
                    <input type="date" name="trip_end" value="<?php echo $_SESSION['tripinfo']['trip_end'];?>" placeholder="" required>
                </div>
            </fieldset>
            <button id="tripitemssearch" type="submit" name="tripgo">Search</button>
        </form>
    </div>
<?php if ($step!='1') {?>
<form id="steps_form" action="" method="post">
    <section id="choosen_items" class="box-body row widget">
    

    </section>
    <input type="hidden" id="items_chosen" name="items_chosen" value="<?php if ($_SESSION['tripinfo']['step']==2) echo $_SESSION['tripinfo']['places']; if ($_SESSION['tripinfo']['step']==3) echo $_SESSION['tripinfo']['events'];if ($_SESSION['tripinfo']['step']==4) echo $_SESSION['tripinfo']['cafes'];?>" placeholder="">
    <input type="hidden" id="step" name="step" value="<?php echo $step;?>" placeholder="">
    <button id="next" type="submit" name="nextstep">NEXT STEP</button>
    <button id="prev" type="submit" name="prevstep">PREV STEP</button>
    <button id="cancel" type="submit" name="cancel">cancel</button>
</form>
    <section id="results" class="box-body row widget">
    

    </section>
<?php };?>
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
        //$( "#search_form" ).submit();
      }
      
        $('#search_form').submit( function(event){
                    <?php if ($step!='1') {?>
                    event.preventDefault();
                    document.getElementById("page").value=0;
                    var header ="<h3>Search result for <?php echo $ajaxdatafeature;?>:</h3>";
                    $('#results').html(header);
                    loadPlaces();
                    <?php };?>                    
                });
        function objectifyForm(formArray) {//serialize data function
              var returnArray = {};
              for (var i = 0; i < formArray.length; i++){
                returnArray[formArray[i]['name']] = formArray[i]['value'];
              }
              return returnArray;
        }

        <?php if ($step!='1') {?>
        $(document).ready(function(){loadPlaces();});
        var bottomreached=false;
        document.getElementById("page").value=0;
        var header ="<h3>Search result for <?php echo $ajaxdatafeature;?>s:</h3>";
        $('#results').html(header);

        $(document).on('click', "div.item:not('.selected')", function(index) {
                console.log($(this).attr( "value" )); 
                var result ='<div class="col-lg-2 col-md-2 col-sm-2 no-padding choosen-item" ';
                result +='value="'+$(this).attr( "value" )+'"';
                result +='>';
                result +='<div class="widget-header">';
                result +=$(this).find( ".widget-header" )[0].innerHTML;
                result +='</div>';
                result +='<div class="widget-content">';
                result +=$(this).find( ".widget-content" )[0].innerHTML;
                result +='</div>';       
                result +='</div>';
                $(this).addClass('selected');
                $('#choosen_items').append(result);
                $('#items_chosen').val($('#items_chosen').val()+','+$(this).attr( "value" ));
            });
        $(document).on('click', "div.item.selected", function(index) {
           
            var itemId=$(this).attr( "value" );
            var inputItems=$('#items_chosen').val().split(",");
            inputItems.forEach(function(element){
                if(element===itemId){
                    inputItems.splice(inputItems.indexOf(element), 1 );
                }
            });
            $('#items_chosen').val(inputItems.join(','));

            $(this).removeClass('selected');
            $('div.choosen-item[value="'+itemId+'"]').remove();

        });
        $(document).on('click', "div.choosen-item", function(index) {

                var itemId=$(this).attr( "value" );
                $("div.item[value='"+itemId+"']").removeClass('selected');
                var inputItems=$('#items_chosen').val().split(",");
                inputItems.forEach(function(element){
                    if(element===itemId){
                        inputItems.splice(inputItems.indexOf(element), 1 );
                    }
                });
                $('#items_chosen').val(inputItems.join(','));
                $(this).remove();
                //$('#choosen_items').append(result);    
            });

        function loadPlaces(){
            var formdata = $('#search_form').serializeArray();
            //formdata.push({name: 'savervw', value: 'true'});
            formdata=objectifyForm(formdata);
            $.post('features/<?php echo $ajaxdatafeature;?>s/index.php?action=get<?php echo $ajaxdataaction;?>sJSON',formdata, function (data) {
                var result ="<div class='row'>";
                if(data.length>0)    
                {    
                    $.each(data, function(index,item){
                        //console.log(place);
                        result +='<div class="col-lg-4 col-md-4 col-sm-4 no-padding item" ';
                        result +='value="'+item.id+'"';
                        result +='>';
                        result +='<div class="widget-header">';
                        result +=item.title;
                        result +='<br/></div>';
                        result +='<div class="widget-content">';
                        result +="<img width='100%' src='"+item.image+"'>";
                        result +='<br/></div>';       
                        result +='</div>';
                    });
                    document.getElementById("page").value=parseInt(document.getElementById("page").value)+1;
                    bottomreached=false;
                }
                else result+="No more data";

                result += "</div>";
                $('#results').append(result);
                displaySelection();
            });
        }

        function displaySelection()
        {
            var choosenItems=$('#items_chosen').val().split(',');
            $.each(choosenItems, function(index,item){
                if(item!=0){
                    
                    var list=$("div.item:not('.selected')[value='"+item+"']");
                    if(list.length)
                    {
                        console.log(item);
                        var result ='<div class="col-lg-2 col-md-2 col-sm-2 no-padding choosen-item" ';
                        result +='value="'+list.attr( "value" )+'"';
                        result +='>';
                        result +='<div class="widget-header">';
                        result +=list.find( ".widget-header" )[0].innerHTML;
                        result +='</div>';
                        result +='<div class="widget-content">';
                        result +=list.find( ".widget-content" )[0].innerHTML;
                        result +='</div>';       
                        result +='</div>';
                        list.addClass('selected');
                        $('#choosen_items').append(result);
                    }
                }
            });
        }
        $(document).scroll(function() {
                if($(window).scrollTop()+window.innerHeight>$('body').height()&&!bottomreached)
                    {
                        bottomreached=true;
                        loadPlaces();
                    }
            });

        <?php };?>    
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrv18VtDMOUV9l_DNUogXpN3xc96kFWks&libraries=geometry,places&callback=initAutocomplete">
    </script>
</div>
