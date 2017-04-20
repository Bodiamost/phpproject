<div class="box"> 
    <div class="row">
        <form id="search_form" action="" method="post" >
            <fieldset class="col-md-12">
                <div class="form-group">
                    <label for="trip_title" class="col-md-4 col-form-label">Title:</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="trip_title" value="<?php echo($trip->getTitle());?>" placeholder="">
                        <?php echo $fields->getField('trip_title')->getHTML();?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="trip_cat" class="col-md-4 col-form-label">Category:</label>
                    <div class="col-md-8">
                        <select name="trip_cat"  class="form-control" >
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
                </div>
                <div class="form-group">
                    <label for="trip_desc" class="col-md-4 col-form-label">Description:</label>
                    <div class="col-md-8">
                        <textarea  class="form-control"  name="trip_desc" placeholder=""><?php echo($trip->getDesc());?></textarea>
                        <?php echo $fields->getField('trip_desc')->getHTML();?>
                    </div>
                </div>        
            </fieldset>
            <div id="desc" class="col-md-12"></div>
            <div class="col-md-12">
                <button id="tripisave" type="submit" class="btn btn-success shiny pull-right" name="tripsave">SAVE</button>
                <button id="prev" type="submit" class="btn btn-blue shiny pull-right" name="prevstep">PREV STEP</button>
                <button id="cancel" type="submit" class="btn btn-danger shiny pull-left" name="cancel">Cancel</button>
            </div>
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

            var conteiner   = '<div class="row"><div class="col-md-12"><h3>Places</h3></div>';
            conteiner     += "<div id='places' class='col-md-12' >";
            conteiner += '<div id="divloading1" style="text-align: center;display: none;"><img src="img/spiffygif_88x88.gif"></div>';
            conteiner += "</div></div";
            $('#desc').append(conteiner); 
            $.each(tripitems['places'],function (index,it){
                $('#divloading1').show();
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

                    $('#divloading1').hide();
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

            conteiner   = '<div class="row"><div class="col-md-12"><h3 >Events</h3></div>';
            conteiner     += "<div id='events' class='col-md-12 '>";
            conteiner += '<div id="divloading2" style="text-align: center;display: none;"><img src="img/spiffygif_88x88.gif"></div>';
            conteiner += "</div></div>";
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
            
            conteiner   = '<div class="row"><div class="col-md-12"><h3>Restaurants</h3></div>';
            conteiner   += "<div id='cafes' class='col-md-12'>";
            conteiner += '<div id="divloading3" style="text-align: center;display: none;"><img src="img/spiffygif_88x88.gif"></div>';
            conteiner += "</div></div>";
            $('#desc').append(conteiner); 
            $.each(tripitems['cafes'],function (index,it){
               // console.log(it);
                $('#divloading3').show();
                $.post('features/restaurants/index.php?action=getCafeJSON&id='+it, function (itemdata) {
                    
                    var result='';
                    if(itemdata)    
                    {    
                        console.log(itemdata);
                        result +='<a href="home.php?feature=cafe    s&action=viewcafe&id='+itemdata.id+'"><div class="col-lg-4 col-md-4 col-sm-4 no-padding item" ';
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
    </script>    
</div>
