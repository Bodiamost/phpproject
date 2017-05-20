<div class="box row">
	<h1><?php echo(	$cafe->getTitle());?></h1>
    <div class="col-md-8 col-sm-8">
        <img width="100%" src="<?php echo($cafe->getImage());?>">
        <table>
            <tr>
                <td>Address: </td>
                <td><?php echo(	$cafe->getAddress());?></td>
            </tr>        
            <tr>
                <td>Contact: </td>
                <td><?php echo(	$cafe->getContact());?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-4 col-sm-4">
        <?php 
            $int=intval($cafe->getRating());
            if($int==0) echo "<span>Not rated yet</span>";
            $i=1; 
            for($i=1; $i<$int;$i+=2) 
                echo "<i class=\"fa fa-star fa-2x\" aria-hidden=\"true\"></i>";
            if($i==$int) echo "<i class=\"fa fa-star-half-o fa-2x\" aria-hidden=\"true\"></i>";    

        ?> 
        <h4>Open hours</h4>
         <table>
            <tr>
                <td>Mon: </td>
                <td><?php echo( $open_hours->M_S);?>-<?php echo( $open_hours->M_E);?></td>
            </tr>
            <tr>
                <td>Tue: </td>
                <td><?php echo( $open_hours->T_S);?>-<?php echo( $open_hours->T_E);?></td>
            </tr>
            <tr>
                <td>Wed: </td>
                <td><?php echo( $open_hours->W_S);?>-<?php echo( $open_hours->W_E);?></td>
            </tr>
            <tr>
                <td>Thu: </td>
                <td><?php echo( $open_hours->R_S);?>-<?php echo( $open_hours->R_E);?></td>
            </tr>
            <tr>
                <td>Fri: </td>
                <td><?php echo( $open_hours->F_S);?>-<?php echo( $open_hours->F_E);?></td>
            </tr>
            <tr>
                <td>Sat: </td>
                <td><?php echo( $open_hours->S_S);?>-<?php echo( $open_hours->S_E);?></td>
            </tr>
            <tr>
                <td>Sun: </td>
                <td><?php echo( $open_hours->N_S);?>-<?php echo( $open_hours->N_E);?></td>
            </tr>
        </table>
        <?php   if($_SESSION['user_id']==$cafe->getpostedBy()) : ?><a href='home.php?feature=cafes&action=editcafe&id=<?php echo($cafe->getId());?>'>Edit</a><?php endif;?>
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
                <p><?php echo( $cafe->getDesc());?></p>
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
    <script>
      function initMap() {
        var uluru = {lat: <?php echo(   $cafe->getLat());?>, lng: <?php echo( $cafe->getLng());?>};
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
        
        });

        $(document).ready(loadReviews);
        var current_user=<?php echo $_SESSION['user_id'];?>;
        function loadReviews(){
            $.getJSON('features/reviews/index.php',{action : 'getreviewsJSON',type: 3, id:<?php echo $cafe->getId();?>}, function (data) {
                var result ="<aside><h3>Latest reviews:</h3><div class='panel-group  col-md-12'>";
                //result+="<a href='features/reviews/index.php?action=addreview&id=<?php echo $cafe->getId();?>&type=1'>New review</a>";
                result+="<button id='newreview' class='btn btn-blue shiny' type='button'>New review</button>";
                
                $.each(data, function(index,review){
                    result += "<div class='panel panel-primary row'>";
                    result += "<div class='panel-heading col-md-12'><h4 class='pull-left'>" + review.title +"</h4><i class='pull-right'>" + review.date + "</i>  ";
                    var int=parseInt(review.rating);
                    var i=1;
                    result += "<div class='pull-left'>";
                    for(i=1; i<int;i+=2)
                        result +="<i class=\"fa fa-star\" aria-hidden=\"true\"></i>";
                    if(i==int) result +="<i class=\"fa fa-star-half-o\" aria-hidden=\"true\"></i>";
                    result += "</div></div>";

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
                     $.get('features/reviews/index.php',{action : 'addreviewAJAX',type: 3, id:<?php echo $cafe->getId();?>}, function (data) {
                            $('#reviews').html(data);
                        });
                });
            });
        }
    </script>
    <div class="row">
    <div class="col-md-12">
     <a href="home.php?feature=cafes&action=viewlist">Return to list</a>
    </div>
    </div>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrv18VtDMOUV9l_DNUogXpN3xc96kFWks&callback=initMap">
    </script>
</div>