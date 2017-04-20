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
                    <input class="form-control" type="number" name="visit_loadness" value="<?php echo $visit->loadness;?>" min="1" max="10" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="visit_duration" class="col-md-4 col-form-label">Time spend(in min):</label>
                <div class="col-md-8">
                    <input class="form-control" type="number" name="visit_duration" value="<?php echo $visit->duration;?>" min="1" max="2000" required>
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
                    <input class="form-control" type="number" class="col-md-4 col-form-label" name="review_rating" value="<?php echo $review->rating;?>" placeholder="" min="1" max="10" required>
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