<div class="box row">
	<h1><?php echo(	$place->getTitle());?></h1>
    <div class="col-md-8 col-sm-8">
        <img width="100%" src="<?php echo($place->getImage());?>">
        <table>
            <tr>
                <td>Address: </td>
                <td><?php echo(	$place->getAddress());?></td>
            </tr>        
            <tr>
                <td>Contact: </td>
                <td><?php echo(	$place->getContact());?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-4 col-sm-4">
        <?php 
            $int=intval($place->getRating());
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
        <a href='home.php?feature=places&action=editplace&id=<?php echo($place->getId());?>'>Edit</a>
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
                <p><?php echo( $place->getDesc());?></p>
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
        var uluru = {lat: <?php echo(   $place->getLat());?>, lng: <?php echo( $place->getLng());?>};
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
    </script>
    <div class="row">
    <div class="col-md-12">
     <a href="home.php?feature=places&action=viewlist">Return to list</a>
    </div>
    </div>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrv18VtDMOUV9l_DNUogXpN3xc96kFWks&callback=initMap">
    </script>
</div>