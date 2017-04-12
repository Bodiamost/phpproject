<aside>
	<h3>Latest reviews:</h3>
	<div class="panel-group">
	<?php foreach ($reviews as $r) { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4><?php echo $r->title;?></h4>
				<i><?php echo $r->date;?></i>  
			</div>
			<div class="panel-body">
				<?php echo $r->description;?>
			</div>
			<div class="panel-footer">Author: 
				<a href="index.php?feature=users&amp;action=viewprofile&amp;id<?php echo $r->user_id;?>"><b><?php echo $r->first_name.' '.$r->last_name;?></b>
				</a>
			</div>
		</div>
	<?php };?>	
	</div>
</aside>