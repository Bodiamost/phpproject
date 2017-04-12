<div class="box">
	<h1>Create new cafe</h1>
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
                <?php echo $fields->getField('cafe_cat')->getHTML();?>
            </div>
            <div>
                <label for="cafe_image">Select image to upload:</label>
                <input type="file" name="cafe_image" id="cafe_image">
                <?php echo $fields->getField('cafe_image')->getHTML();?>
            </div>
            <div>
                <label for="cafe_desc">Description:</label>
                <textarea name="cafe_desc" placeholder=""><?php echo($cafe->getDesc());?></textarea>
                <?php echo $fields->getField('cafe_desc')->getHTML();?>
            </div>   
            <div>
                <label for="cafe_address">Address:</label>
                <input type="text" name="cafe_address" value="<?php echo($cafe->getAddress());?>" placeholder="">
                <?php echo $fields->getField('cafe_desc')->getHTML();?>
            </div>   
            <div>
                <label for="cafe_contact">Contact:</label>
                <input type="text" name="cafe_contact" value="<?php echo($cafe->getContact());?>" placeholder="">
                <?php echo $fields->getField('cafe_contact')->getHTML();?>
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
                    <input type="time" step="900" name="cafe_hours_M_S" value="<?php echo($open_hours->M_S);?>" required>-
                    <input type="time" step="900" name="cafe_hours_M_E" value="<?php echo($open_hours->M_E);?>" required>
                </div>
                <div>
                    <label for="cafe_hours_T_S">Tuesday:</label>
                    <input type="time" step="900" name="cafe_hours_T_S" value="<?php echo($open_hours->T_S);?>" required>-
                    <input type="time" step="900" name="cafe_hours_T_E" value="<?php echo($open_hours->T_E);?>" required>
                    <button type="button" id="hours_T">Same</button>
                </div>
                <div>               
                    <label for="cafe_hours_W_S">Wednesday:</label>
                    <input type="time" step="900" name="cafe_hours_W_S" value="<?php echo($open_hours->W_S);?>" required>-
                    <input type="time" step="900" name="cafe_hours_W_E" value="<?php echo($open_hours->W_E);?>" required>
                    <button type="button" id="hours_W">Same</button>
                </div>
                <div>                  
                    <label for="cafe_hours_R_S">Thursday:</label>
                    <input type="time" step="900" name="cafe_hours_R_S" value="<?php echo($open_hours->R_S);?>" required>-
                    <input type="time" step="900" name="cafe_hours_R_E" value="<?php echo($open_hours->R_E);?>" required>
                    <button type="button" id="hours_R">Same</button>
                </div>
                <div>  
                    <label for="cafe_hours_F_S">Friday:</label>
                    <input type="time" step="900" name="cafe_hours_F_S" value="<?php echo($open_hours->F_S);?>" required>-
                    <input type="time" step="900" name="cafe_hours_F_E" value="<?php echo($open_hours->F_E);?>" required>
                    <button type="button" id="hours_F">Same</button>  
                </div>
                <div>               
                    <label for="cafe_hours_S_S">Saturday:</label>
                    <input type="time" step="900" name="cafe_hours_S_S" value="<?php echo($open_hours->S_S);?>" required>-
                    <input type="time" step="900" name="cafe_hours_S_E" value="<?php echo($open_hours->S_E);?>" required>
                    <button type="button" id="hours_S">Same</button>
                </div>
                <div>                 
                    <label for="cafe_hours_N_S">Sunday:</label>
                    <input type="time" step="900" name="cafe_hours_N_S" value="<?php echo($open_hours->N_S);?>" required>-
                    <input type="time" step="900" name="cafe_hours_N_E" value="<?php echo($open_hours->N_E);?>" required>
                    <button type="button" id="hours_N">Same</button>
                </div>
            </div>   
        </fieldset>
        <?php //echo $fields->getField('cafe_lng')->getHTML();?>
        <div id="map" style="height: 400px; width: 400px;"></div>
        <button type="submit" name="add">Save</button>
    </form>
    
    <a href="home.php?feature=cafes&action=viewlist">Return to list</a>
    <script>
        function initMap() {
            var uluru;
            if(document.getElementById("latInput").value=='0'||document.getElementById("latInput").value['lng']=='0') 
                uluru={lat:43,lng:-79};
            else 
                uluru = {lat: <?php echo($cafe->getLat());?>, lng: <?php echo( $cafe->getLng());?>};      
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 5,
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
        $("#hours_T").bind('click', function() {
                $("input[name*='cafe_hours_T_S']").val($("input[name*='cafe_hours_M_S']").val());
                $("input[name*='cafe_hours_T_E']").val($("input[name*='cafe_hours_M_E']").val());
            });
        $("#hours_W").bind('click', function() {
                $("input[name*='cafe_hours_W_S']").val($("input[name*='cafe_hours_T_S']").val());
                $("input[name*='cafe_hours_W_E']").val($("input[name*='cafe_hours_T_E']").val());
            });
        $("#hours_R").bind('click', function() {
                $("input[name*='cafe_hours_R_S']").val($("input[name*='cafe_hours_W_S']").val());
                $("input[name*='cafe_hours_R_E']").val($("input[name*='cafe_hours_W_E']").val());
            });
        $("#hours_F").bind('click', function() {
                $("input[name*='cafe_hours_F_S']").val($("input[name*='cafe_hours_R_S']").val());
                $("input[name*='cafe_hours_F_E']").val($("input[name*='cafe_hours_R_E']").val());
            });
        $("#hours_S").bind('click', function() {
                $("input[name*='cafe_hours_S_S']").val($("input[name*='cafe_hours_F_S']").val());
                $("input[name*='cafe_hours_S_E']").val($("input[name*='cafe_hours_F_E']").val());
            });
        $("#hours_N").bind('click', function() {
                $("input[name*='cafe_hours_N_S']").val($("input[name*='cafe_hours_S_S']").val());
                $("input[name*='cafe_hours_N_E']").val($("input[name*='cafe_hours_S_E']").val());
            });
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrv18VtDMOUV9l_DNUogXpN3xc96kFWks&callback=initMap">
    </script>
</div>