<div class="box row">
    <h1><?php echo( $trip->getTitle());?></h1>
    <div class="col-md-8 col-sm-8">
        <table>
            <tr>
                <td>Trip to </td>
                <td><?php echo( $trip->getLocation());?></td>
            </tr>        
        </table>
        <p><?php echo( $trip->getDesc());?></p>
    </div>
    <div class="col-md-4 col-sm-4">
        <?php 
            $int=intval($trip->getRating());
            if($int==0) echo "<span>Not rated yet</span>";
            $i=1; 
            for($i=1; $i<$int;$i+=2) 
                echo "<i class=\"fa fa-star fa-2x\" aria-hidden=\"true\"></i>";
            if($i==$int) echo "<i class=\"fa fa-star-half-o fa-2x\" aria-hidden=\"true\"></i>";    

        ?> 
    </div>
    <div class="content-row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#desc">Description</a></li>
              <li><a data-toggle="tab" href="#reviews">Reviews</a></li>
              <li><a data-toggle="tab" href="#location">Map</a></li>
            </ul>

            <div class="tab-content">
              <div id="desc" class="tab-pane fade in active">
                
              </div>
              <div id="reviews" class="tab-pane fade">
                <p>No reviews yet</p>
              </div>
              <div id="location" class="tab-pane fade">
                <div id="map" style="height: 400px;"></div>
              </div>
            </div>
            <div></div>
        </div>
    </div>
    <?php   if($_SESSION['user_id']==$trip->getpostedBy()) :?>
          <a href='home.php?feature=trips&action=deletetrip&id=<?php echo($trip->getId());?>'>Delete</a>
    <?php endif;?>
    <script>
        loadTripInfo();
        var current_user=<?php echo $_SESSION['user_id'];?>;
        function loadTripInfo()
        {
            tripitems=<?php echo json_encode(json_decode($trip->getItems()));?>;

            tripitems['places']=JSON.parse(tripitems['places']);
            tripitems['events']=JSON.parse(tripitems['events']);
            tripitems['cafes']=JSON.parse(tripitems['cafes']);

            var conteiner   = '<h3>Places</h3>';
            conteiner     += "<div id='places' class='row'>";
            conteiner += '<div id="divloading1" style="text-align: center;display: none;"><img src="img/spiffygif_88x88.gif"></div>';
            conteiner += "</div>";
            $('#desc').append(conteiner); 
            $.each(tripitems['places'],function (index,it){
               // console.log(it);
                $('#divloading1').show();
                $.post('features/places/index.php?action=getPlaceJSON&id='+it, function (itemdata) {
                    
                    var result='';
                    if(itemdata)    
                    {    
                        console.log(itemdata);
                        result +='<a href="home.php?feature=places&action=viewplace&id='+itemdata.id+'"><div class="col-lg-4 col-md-4 col-sm-4 no-padding item" ';
                        result +='value="'+itemdata.id+'"';
                        result +='>';
                        result +='<div class="widget-header">';
                        result +=itemdata.title;
                        result +='<br/></div>';
                        result +='<div class="widget-content">';
                        result +="<img width='100%' src='"+itemdata.image+"'>";
                        result +='<br/></div>';       
                        result +='</div></a>';
                    }
                    else result+="Smth wrong with this place";
                     $('#places').append(result);
                    $('#divloading1').hide();
                });  
            });

            conteiner   = '<h3>Events</h3>';
            conteiner     += "<div id='events' class='row'>";
            conteiner += '<div id="divloading2" style="text-align: center;display: none;"><img src="img/spiffygif_88x88.gif"></div>';
            conteiner += "</div>";
            $('#desc').append(conteiner); 
            $.each(tripitems['events'],function (index,it){
               // console.log(it);
                $('#divloading2').show();
                $.post('features/events/index.php?action=getEventJSON&id='+it, function (itemdata) {
                    
                    var result='';
                    if(itemdata)    
                    {    
                        console.log(itemdata);
                        result +='<a href="home.php?feature=events&action=viewevent&id='+itemdata.id+'"><div class="col-lg-4 col-md-4 col-sm-4 no-padding item" ';
                        result +='value="'+itemdata.id+'"';
                        result +='>';
                        result +='<div class="widget-header">';
                        result +=itemdata.title;
                        result +='<br/></div>';
                        result +='<div class="widget-content">';
                        result +="<img width='100%' src='"+itemdata.image+"'>";
                        result +='<br/></div>';       
                        result +='</div></a>';
                    }
                    else result+="Smth wrong with this place";
                     $('#events').append(result);
                    $('#divloading2').hide();
                });  
            });
            
            conteiner   = '<h3>Restaurants</h3>';
            conteiner   += "<div id='cafes' class='row'>";
            conteiner += '<div id="divloading3" style="text-align: center;display: none;"><img src="img/spiffygif_88x88.gif"></div>';
            conteiner += "</div>";
            $('#desc').append(conteiner); 
            $.each(tripitems['cafes'],function (index,it){
               // console.log(it);
                $('#divloading3').show();
                $.post('features/restaurants/index.php?action=getCafeJSON&id='+it, function (itemdata) {
                    
                    var result='';
                    if(itemdata)    
                    {    
                        console.log(itemdata);
                        result +='<a href="home.php?feature=cafes&action=viewcafe&id='+itemdata.id+'"><div class="col-lg-4 col-md-4 col-sm-4 no-padding item" ';
                        result +='value="'+itemdata.id+'"';
                        result +='>';
                        result +='<div class="widget-header">';
                        result +=itemdata.title;
                        result +='<br/></div>';
                        result +='<div class="widget-content">';
                        result +="<img width='100%' src='"+itemdata.image+"'>";
                        result +='<br/></div>';       
                        result +='</div></a>';
                    }
                    else result+="Smth wrong with this place";
                     $('#cafes').append(result);
                    $('#divloading3').hide();
                });  
            });
        }
        function initMap() {
        var uluru = {lat: <?php echo(   $trip->getLat());?>, lng: <?php echo( $trip->getLng());?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
        }
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            initMap();
            //loadTripInfo();    
        });

        $(document).ready(loadReviews);
        function loadReviews(){
            $.getJSON('features/reviews/index.php',{action : 'getreviewsJSON',type: 4, id:<?php echo $trip->getId();?>}, function (data) {
                var result ="<aside><h3>Latest reviews:</h3><div class='panel-group  col-md-12'>";
                //result+="<a href='features/reviews/index.php?action=addreview&id=<?php echo $trip->getId();?>&type=1'>New review</a>";
                result+="<button id='newreview' class='btn btn-blue shiny' type='button'>New review</button>";
                
                $.each(data, function(index,review){
                    result += "<div class='panel panel-primary row'>";
                    result += "<div class='panel-heading col-md-12'><h4 class='pull-left'>" + review.title +"</h4><i class='pull-right'>" + review.date + "</i>  "+"</div>";

                    result += "<div class='panel-body col-md-12'>" + review.description + "</div>";

                    result += "<div class='panel-footer col-md-12'>" ;
                    result += "Author: <a href='index.php?feature=users&action=viewprofile&id="+review.user_id+"'><b>" + review.first_name +" " +review.last_name+"</b></a>";
                    if(current_user==review.user_id)  
                        result += "<button type='button' class='btn btn-xs btn-danger shiny pull-right' name='delete' rid='"+ review.id+"'>Delete</button>";
                    result += "</div>";

                    result += "</div>";
                });
                result += "</div></aside>";

                $('#reviews').html(result);

                $('button[name=delete]').click( function(){
                    var url='features/reviews/index.php?action=deletereview&id='+$(this).attr('rid');
                    var r = confirm("Do you confirm this delete action?");
                    if (r == true) {
                        $.post(url, function (data) {loadReviews(); });
                        
                    } else {
                        loadReviews();
                    }
                   
                });

                $('#newreview').click( function(){
                     $.get('features/reviews/index.php',{action : 'addreviewAJAX',type: 4, id:<?php echo $trip->getId();?>}, function (data) {
                            $('#reviews').html(data);
                        });
                });
            });
        }
    </script>
    <div class="row">
    <div class="col-md-12">
     <a href="home.php?feature=trips&action=viewlist">Return to list</a>
    </div>
    </div>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrv18VtDMOUV9l_DNUogXpN3xc96kFWks&callback=initMap">
    </script>
</div>