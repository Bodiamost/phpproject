<div class="box">
	<h1><?php echo(	$cafe->getTitle());?></h1>
    <form action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <div>
                <label for="cafe_title">Title:</label>
                <input type="text" name="cafe_title" value="<?php echo($cafe->getTitle());?>" placeholder="">
                <?php echo $fields->getField('cafe_title')->getHTML();?>
            </div>
            <div>
                <label for="cafe_cat">Category:</label>
                <select name="cafe_cat">
                    <?php
                    foreach ($categories as $cat)
                    {
                        if($cat->id==$cafe->getCid())
                        {
                            echo '<option selected value="'.$cat->id.'">'.$cat->title.'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$cat->id.'">'.$cat->title.'</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <img width="50%" src="<?php echo($cafe->getImage());?>">
            <div>
                <label for="cafe_image">Select new image to upload:</label>
                <input type="file" name="cafe_image" id="cafe_image">
            </div>
            <div>
                <label for="cafe_desc">Description:</label>
                <textarea name="cafe_desc" placeholder=""><?php echo($cafe->getDesc());?></textarea>
            </div>   
            <div>
                <label for="cafe_address">Address:</label>
                <input type="text" name="cafe_address" value="<?php echo($cafe->getAddress());?>" placeholder="">
            </div>   
            <div>
                <label for="cafe_contact">Contact:</label>
                <input type="text" name="cafe_contact" value="<?php echo($cafe->getContact());?>" placeholder="">
            </div>
            <div>
                <input type="hidden" id="latInput" name="cafe_lat" value="<?php echo($cafe->getLat());?>" placeholder="">            
                <input type="hidden" id="lngInput" name="cafe_lng" value="<?php echo($cafe->getLng());?>" placeholder="">
            </div>        
        </fieldset>
        <fieldset>
            <div>
                <label>Working hours:</label>
                <div>
                    <label for="cafe_hours_M_S">Monday:</label>
                    <input type="time" step="900" name="cafe_hours_M_S" value="<?php echo($open_hours->M_S);?>">-
                    <input type="time" step="900" name="cafe_hours_M_E" value="<?php echo($open_hours->M_E);?>">
                </div>
                <div>
                    <label for="cafe_hours_T_S">Tuesday:</label>
                    <input type="time" step="900" name="cafe_hours_T_S" value="<?php echo($open_hours->T_S);?>">-
                    <input type="time" step="900" name="cafe_hours_T_E" value="<?php echo($open_hours->T_E);?>">
                </div>
                <div>               
                    <label for="cafe_hours_W_S">Wednesday:</label>
                    <input type="time" step="900" name="cafe_hours_W_S" value="<?php echo($open_hours->W_S);?>">-
                    <input type="time" step="900" name="cafe_hours_W_E" value="<?php echo($open_hours->W_E);?>">
                </div>
                <div>                  
                    <label for="cafe_hours_R_S">Thursday:</label>
                    <input type="time" step="900" name="cafe_hours_R_S" value="<?php echo($open_hours->R_S);?>">-
                    <input type="time" step="900" name="cafe_hours_R_E" value="<?php echo($open_hours->R_E);?>">
                </div>
                <div>  
                    <label for="cafe_hours_F_S">Friday:</label>
                    <input type="time" step="900" name="cafe_hours_F_S" value="<?php echo($open_hours->F_S);?>">-
                    <input type="time" step="900" name="cafe_hours_F_E" value="<?php echo($open_hours->F_E);?>">  
                </div>
                <div>               
                    <label for="cafe_hours_S_S">Saturday:</label>
                    <input type="time" step="900" name="cafe_hours_S_S" value="<?php echo($open_hours->S_S);?>">-
                    <input type="time" step="900" name="cafe_hours_S_E" value="<?php echo($open_hours->S_E);?>">
                </div>
                <div>                 
                    <label for="cafe_hours_N_S">Sunday:</label>
                    <input type="time" step="900" name="cafe_hours_N_S" value="<?php echo($open_hours->N_S);?>">-
                    <input type="time" step="900" name="cafe_hours_N_E" value="<?php echo($open_hours->N_E);?>">
                </div>
            </div>   
        </fieldset>
         <div id="map" style="height: 400px; width: 400px;"></div>
            <button type="submit" name="edit">Save</button>
    </form>
    
    <a href="home.php?feature=cafes&action=viewlist">Return to list</a>
    <script>
        function initMap() {
            var uluru = {lat: <?php echo(   $cafe->getLat());?>, lng: <?php echo( $cafe->getLng());?>};
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 14,
              center: uluru
            });
            var geocoder = new google.maps.Geocoder;
            var infowindow = new google.maps.InfoWindow;

            var marker = new google.maps.Marker({
              position: uluru,
              map: map,
              draggable:true,
              title:"Change location!"
            });
            google.maps.event.addListener(marker, 'dragend', function (evt) {
                document.getElementById("latInput").value = evt.latLng.lat().toFixed(6);
                document.getElementById("lngInput").value = evt.latLng.lng().toFixed(6);
            });
        }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrv18VtDMOUV9l_DNUogXpN3xc96kFWks&callback=initMap">
    </script>
</div>