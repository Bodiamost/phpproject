<?php
require_once "connect.php";
require_once "showalbum.php";
$shwalbm=new showalbum();
$results=$shwalbm->viewalbms();
//var_dump($results);
?>

<div class="box">
    <h1 class="box-header">Albums</h1>
    <div class="box-body row widget">
        <?php $i = 0;foreach ($results as $albm) {?>


        <div class="col-lg-6 col-md-6 col-sm-6 no-padding">
            <div class="widget-header">
                <a href="home.php?id=<?php echo $albm['id'];?> &amp; feature=album&action=pics"><?php echo $albm['name'];?> </a><br/>
            </div>
            <div class="widget-content">

                <img src=<?php echo "features/albums/album_covers/".$albm['cover_photo'];?> width='100%' height="150px"/><br/>

            </div>

        </div>
        <?php if(++$i % 2 === 0):?> </div><div  class="box-body row widget"><?php endif;?>
        <?php };?>
    </div>
    <div class="box-footer">
        <a href="home.php?feature=album&action=amadd">Add new Album</a>
    </div>
</div>