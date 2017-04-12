<div class="box">
	<h2>Are you sure to delete <?php echo(	$cafe->getTitle());?></h2>
    <form action="" method="post">
            <button type="submit" name="delete">Yes</button>
    </form>
    <a href="home.php?feature=cafes&action=viewlist">
        <button type="submit">NO</button>
    </a>
</div>