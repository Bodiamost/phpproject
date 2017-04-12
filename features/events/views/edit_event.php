<div class="box">
	<h1><?php echo(	$event->getTitle());?></h1>
    <form action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <div>
                <label for="event_title">Title:</label>
                <input type="text" name="event_title" value="<?php echo($event->getTitle());?>" placeholder="">
                <?php echo $fields->getField('event_title')->getHTML();?>
            </div>
            <div>
                <label for="event_cat">Category:</label>
                <select name="event_cat">
                    <?php
                    foreach ($categories as $cat)
                    {
                        if($cat->id==$event->getCid())
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
            <img width="50%" src="<?php echo($event->getImage());?>">
            <div>
                <label for="event_image">Select new image to upload:</label>
                <input type="file" name="event_image" id="event_image">
            </div>
            <div>
                <label for="event_desc">Description:</label>
                <textarea name="event_desc" placeholder=""><?php echo($event->getDesc());?></textarea>
            </div>   
            <div>
                <label for="event_address">Address:</label>
                <input type="text" name="event_address" value="<?php echo($event->getAddress());?>" placeholder="">
            </div>   
            <div>
                <label for="event_contact">Contact:</label>
                <input type="text" name="event_contact" value="<?php echo($event->getContact());?>" placeholder="">
            </div>
            <div>
                <input type="hidden" id="latInput" name="event_lat" value="<?php echo($event->getLat());?>" placeholder="">            
                <input type="hidden" id="lngInput" name="event_lng" value="<?php echo($event->getLng());?>" placeholder="">
            </div>        
        </fieldset>
        <fieldset>           
            <div>
                <label>Event hours:</label>
                <div>
                    <label for="event_start">Start:</label>
                    <input type="datetime-local" name="event_start" value="<?php echo($event->getStart());?>" required>
                </div>
                <div>
                    <label for="event_end">End:</label>
                    <input type="datetime-local" name="event_end" value="<?php echo($event->getEnd());?>" required>
                </div>
            </div>   
        </fieldset>
         <div id="map" style="height: 400px; width: 400px;"></div>
            <button type="submit" name="edit">Save</button>
    </form>
    
    <a href="home.php?feature=events&action=viewlist">Return to list</a>
    <script>
        function initMap() {
            var uluru = {lat: <?php echo(   $event->getLat());?>, lng: <?php echo( $event->getLng());?>};
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