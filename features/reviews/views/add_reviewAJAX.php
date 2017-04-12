<div class="box">
	<h1>Create new review</h1>
    <form id="newreview" action="" method="post" >
        <?php if ($type_id!=4) : ?>
        <fieldset title="visit details">
            <legend>Visit details:</legend>
            <div>
                <label for="visit_time">Date of visit:</label>
                <input type="datetime-local" name="visit_time" value="<?php echo $visit->date;?>" placeholder="" required>
            </div>
            <div>
                <label for="visit_loadness">Number of visitors:</label>
                <input type="number" name="visit_loadness" value="<?php echo $visit->loadness;?>" min="1" max="10" required>
            </div>
            <div>
                <label for="visit_duration">Visit duration(in min):</label>
                <input type="number" name="visit_duration" value="<?php echo $visit->duration;?>" min="1" max="2000" required>
            </div>
        </fieldset>
    <?php endif;?>
        <fieldset>
            <legend>Review:</legend>
            <div>
                <label for="review_title">Title:</label>
                <input type="text" name="review_title" value="<?php echo $review->title;?>" placeholder="">
                <?php echo $fields->getField('review_title')->getHTML();?>
            </div>
            <div>
                <label for="review_desc">Description:</label>
                <textarea name="review_desc" placeholder=""><?php echo $review->description;?></textarea>
                <?php echo $fields->getField('review_desc')->getHTML();?>
            </div>   
            <div>
                <label for="review_rating">Rating:</label>
                <input type="number" name="review_rating" value="<?php echo $review->rating;?>" placeholder="" min="1" max="2000" required>
            </div>   
        </fieldset>   
        <button id="savervw" type="submit" name="savervw">Save</button>
    </form>
    
    <script>
        $(document).ready(function(){ 
            $('#newreview').submit( function(event){
                    event.preventDefault();
                    var formdata = $('#newreview').serializeArray();
                    formdata.push({name: 'savervw', value: 'true'});
                    formdata=objectifyForm(formdata);
                    $.post('features/reviews/index.php?action=addreviewAJAX&type=<?php echo $type_id;?>&id=<?php echo $id;?>',formdata, function (data) {
                            $('#reviews').html(data);
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
    <button type="button" onclick="loadReviews()">Cancel</button>
</div>