<div class="box">
	<h1>Create new review</h1>
    <form id="newreview" action="" method="post" >
        <?php if ($type_id!=4) : ?>
        <fieldset class="col-md-12">
            <legend>Visit details:</legend>
            <div class="form-group row">
                <label for="visit_time" class="col-md-4 col-form-label">Date of visit:</label>
                <div class="col-md-8">
                    <input class="form-control" type="datetime-local" name="visit_time" value="<?php echo $visit->date;?>" placeholder="" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="visit_loadness" class="col-md-4 col-form-label">Rate loadness:</label>

                <div class="col-md-8">
                    <span class="rating">
                        <input type="radio" class="rating-input"
                               id="rating-input-1-5" name="visit_loadness" value="10"
                            <?php if(isset($_POST['visit_loadness'])&&$_POST['visit_loadness']==10) echo ' checked '?>
                        />
                        <label for="rating-input-1-5" class="rating-star"></label>
                        <input type="radio" class="rating-input"
                               id="rating-input-1-4" name="visit_loadness" value="8"
                            <?php if(isset($_POST['visit_loadness'])&&$_POST['visit_loadness']==8) echo ' checked '?>
                        />
                        <label for="rating-input-1-4" class="rating-star"></label>
                        <input type="radio" class="rating-input"
                               id="rating-input-1-3" name="visit_loadness" value="6"
                            <?php if(isset($_POST['visit_loadness'])&&$_POST['visit_loadness']==6) echo ' checked '?>
                        />
                        <label for="rating-input-1-3" class="rating-star"></label>
                        <input type="radio" class="rating-input"
                               id="rating-input-1-2" name="visit_loadness" value="4"
                            <?php if(isset($_POST['visit_loadness'])&&$_POST['visit_loadness']==4) echo ' checked '?>
                        />
                        <label for="rating-input-1-2" class="rating-star"></label>
                        <input type="radio" class="rating-input"
                               id="rating-input-1-1" name="visit_loadness" value="2"
                            <?php if(isset($_POST['visit_loadness'])&&$_POST['visit_loadness']==2) echo ' checked '?>
                        />
                        <label for="rating-input-1-1" class="rating-star"></label>
                    </span>
                    <?php echo $fields->getField('visit_loadness')->getHTML();?>
                </div>
            </div>
            <div class="form-group row">
                <label for="visit_duration" class="col-md-4 col-form-label">Time spend:</label>
                <div class="col-md-8">
                    <select name="visit_duration">
                        <option value="7" <?php if(isset($_POST['visit_duration'])&&$_POST['visit_duration']=='7')echo ' selected ';?>>Less than 15 min</option>
                        <?php
                        foreach (range(15,120,15) as $curInt)
                        {
                            if(isset($_POST['visit_duration'])&& $_POST['visit_duration']==$curInt)
                            {
                                echo '<option selected value="'.$curInt.'">Around '.$curInt.' min</option>';
                            }
                            else
                            {
                                echo '<option value="'.$curInt.'">Around '.$curInt.' min</option>';
                            }
                        }
                        ?>
                        <option value="150" <?php if(isset($_POST['visit_duration'])&&$_POST['visit_duration']=='150')echo ' selected ';?>>More than 2 hours</option>
                    </select>
                    <?php echo $fields->getField('visit_duration')->getHTML();?>
                </div>
            </div>
        </fieldset>
    <?php endif;?>
        <fieldset class="col-md-12">
            <legend>Review:</legend>
            <div class="form-group row">
                <label for="review_title" class="col-md-4 col-form-label">Title:</label>
                <div class="col-md-8">
                    <input class="form-control" type="text" name="review_title" value="<?php echo $review->title;?>" placeholder="">
                    <?php echo $fields->getField('review_title')->getHTML();?>
                </div>
            </div>
            <div class="form-group row">
                <label for="review_desc" class="col-md-4 col-form-label">Description:</label>
                <div class="col-md-8">
                    <textarea  class="form-control" name="review_desc" placeholder=""><?php echo $review->description;?></textarea>
                    <?php echo $fields->getField('review_desc')->getHTML();?>
                </div>
            </div>   
            <div class="form-group row">
                <label for="review_rating" class="col-md-4 col-form-label">Rate:</label>
                <div class="col-md-8">
                     <span class="rating">
                        <input type="radio" class="rating-input"
                               id="rating-input-1-51" name="review_rating" value="10"
                               <?php if(isset($_POST['review_rating'])&&$_POST['review_rating']==10) echo ' checked '?>
                        />
                        <label for="rating-input-1-51" class="rating-star"></label>
                        <input type="radio" class="rating-input"
                               id="rating-input-1-41" name="review_rating" value="8"
                            <?php if(isset($_POST['review_rating'])&&$_POST['review_rating']==8) echo ' checked '?>
                        />
                        <label for="rating-input-1-41" class="rating-star"></label>
                        <input type="radio" class="rating-input"
                               id="rating-input-1-31" name="review_rating" value="6"
                            <?php if(isset($_POST['review_rating'])&&$_POST['review_rating']==6) echo ' checked '?>
                        />
                        <label for="rating-input-1-31" class="rating-star"></label>
                        <input type="radio" class="rating-input"
                               id="rating-input-1-21" name="review_rating" value="4"
                            <?php if(isset($_POST['review_rating'])&&$_POST['review_rating']==4) echo ' checked '?>
                        />
                        <label for="rating-input-1-21" class="rating-star"></label>
                        <input type="radio" class="rating-input"
                               id="rating-input-1-11" name="review_rating" value="2"
                            <?php if(isset($_POST['review_rating'])&&$_POST['review_rating']==2) echo ' checked '?>
                        />
                        <label for="rating-input-1-11" class="rating-star"></label>
                    </span>
                    <?php echo $fields->getField('review_rating')->getHTML();?>
                </div>
            </div>
        </fieldset>
        <button type="button" class="btn btn-danger shiny pull-left" onclick="loadReviews()">Cancel</button>
        <button id="savervw" class="btn btn-blue shiny pull-right" type="submit" name="savervw">Save</button>
    </form>
    
    <script>
        $(document).ready(function(){ 
            $('#newreview').submit( function(event){
                    event.preventDefault();
                    var formdata = $('#newreview').serializeArray();
                    formdata.push({name: 'savervw', value: 'true'});
                    formdata=objectifyForm(formdata);
                    $.post('features/reviews/index.php?action=addreviewAJAX&type=<?php echo $type_id;?>&id=<?php echo $id;?>',formdata, function (data) {
                            $('#reviews').html(data);if(data==='')loadReviews();
                        });
                    
                });
        });
        function objectifyForm(formArray) {//serialize data function
              var returnArray = {};
              for (var i = 0; i < formArray.length; i++){
                returnArray[formArray[i]['name']] = formArray[i]['value'];
              }
              return returnArray;
        }
    </script>
    <!--<a href="home.php?feature=<?php echo $featuresdata[$type_id];?>s&action=view<?php echo $featuresdata[$type_id];?>&id=<?php echo $id;?>">Return</a>-->

</div>