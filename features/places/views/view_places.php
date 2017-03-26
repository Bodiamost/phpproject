<div class="box">
	<h1 class="box-header">Places</h1>
    <div class="box-body row widget">
        <?php $counter = 0; foreach ($places as $place) {?>
        <div class="col-lg-6 col-md-6 col-sm-6 no-padding">
            <div class="widget-header">
                 <a href='home.php?feature=places&action=viewplace&id=<?php echo($place->getId());?>'><?php echo(  $place->getTitle());?></a><br/>
            </div>
            <div class="widget-content">
                 <a href='home.php?feature=places&action=viewplace&id=<?php echo($place->getId());?>'>
                    <img width="100%" src="<?php echo($place->getImage());?>">
                </a><br/>
            </div>
            <div class="widget-footer">
                <!--<a href='home.php?feature=places&action=editplace&id=<?php echo($place->getId());?>'>Edit</a>
                <a href='home.php?feature=places&action=deleteplace&id=<?php echo($place->getId());?>'>Delete</a>-->
            </div>       
        </div>
        <?php if(++$counter % 3 === 0):?> </div><div class="box-body row widget"><?php endif;?>
        <?php };?>
    </div>
    <div class="box-footer">
        <a href="home.php?feature=places&action=addplace">Add new place</a>
    </div>
</div>