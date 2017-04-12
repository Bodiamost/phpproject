<div class="box"> 
    <div>
        <form id="search_form" action="" method="post">
            <fieldset>
                <div>
                    <label for="trip_title">Title:</label>
                    <input type="text" name="trip_title" value="<?php echo($trip->getTitle());?>" placeholder="">
                    <?php echo $fields->getField('trip_title')->getHTML();?>
                </div>
                <div>
                    <label for="trip_cat">Category:</label>
                    <select name="trip_cat">
                        <?php
                        foreach ($categories as $cat)
                        {
                            if($cat->id==$trip->getCid())
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
                    <?php echo $fields->getField('trip_cat')->getHTML();?>
                </div>
                <div>
                    <label for="trip_desc">Description:</label>
                    <textarea name="trip_desc" placeholder=""><?php echo($trip->getDesc());?></textarea>
                    <?php echo $fields->getField('trip_desc')->getHTML();?>
                </div>        
            </fieldset>
            <div id="desc" class="row"></div>
            <button id="tripisave" type="submit" name="tripsave">Save</button>
            <button id="prev" type="submit" name="prevstep">PREV STEP</button>
            <button id="cancel" type="submit" name="cancel">cancel</button>
        </form>
    </div>
    <script type="text/javascript">
        function loadReviews()
        {

        }
        loadTripInfo();
        function loadTripInfo()
        {
            tripitems=<?php echo json_encode(json_decode($trip->getItems()));?>;

            tripitems['places']=JSON.parse(tripitems['places']);
            tripitems['events']=JSON.parse(tripitems['events']);
            tripitems['cafes']=JSON.parse(tripitems['cafes']);

            var conteiner   = '<h3>Places</h3>';
            conteiner     += "<div id='places' class='col-md-12' >";
            conteiner += "</div>";
            $('#desc').append(conteiner); 
            $.each(tripitems['places'],function (index,it){
                
                $.post('features/places/index.php?action=getPlaceJSON&id='+it, function (itemdata) {
                    
                    var result='';
                    if(itemdata)    
                    {    
                        console.log(itemdata);
                        result +='<div class="col-lg-4 col-md-4 col-sm-4 no-padding item" ';
                        result +='value="'+itemdata.id+'"';
                        result +='><a href="home.php?feature=places&action=viewplace&id='+itemdata.id+'">';
                        result +='<div class="widget-header">';
                        result +=itemdata.title;
                        result +='<br/></div>';
                        result +='<div class="widget-content">';
                        result +="<img width='100%' src='"+itemdata.image+"'>";
                        result +='<br/></div>';       
                        result +='</a></div>';

                    }
                    else result+="Smth wrong with this place";
                    
                    $('#places').append(result);
                    $('#newreview'+itemdata.id+'_1').click( function(){
                        $(this).addClass('hidden');
                        $('#cancelreview'+itemdata.id+'_1').removeClass('hidden');
                        $.get('features/reviews/index.php',{action : 'addreviewAJAXtrip',type: 1, id:itemdata.id}, function (data) {
                            $('#reviews'+itemdata.id+'_1').html(data);
                        });
                    });
                    $('#cancelreview'+itemdata.id+'_1').click( function(){
                        $('#reviews'+itemdata.id+'_1').html('');                        
                        $(this).addClass('hidden');
                        $('#newreview'+itemdata.id+'_1').removeClass('hidden');
                    });  
                });  
            });

            conteiner   = '<h3>Events</h3>';
            conteiner     += "<div id='events' class='col-md-12'>";
            conteiner += "</div>";
            $('#desc').append(conteiner); 
            $.each(tripitems['events'],function (index,it){
               // console.log(it);
                
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
                });  
            });
            
            conteiner   = '<h3>Restaurants</h3>';
            conteiner   += "<div id='cafes' class='col-md-12'>";
            conteiner += "</div>";
            $('#desc').append(conteiner); 
            $.each(tripitems['cafes'],function (index,it){
               // console.log(it);
                
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
                });  
            });
        }
    </script>    
</div>
