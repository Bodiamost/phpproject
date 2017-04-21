<?php
require_once "connect.php";
require_once "showpics.php";


$a_id=$_GET['id'];

$pics=new showpics();
$shwpics=$pics->viewpics($a_id);
/*foreach ($shwpics as $pic)
{
    echo $pic['imgurl'];
}*/




?>

<div class="box">

    <h3>Your Images in this Album are</h3>
    <h2><a href="home.php?feature=album&action=amadd">Create a New Album</a></h2>
    <br/>

    <link rel="stylesheet" href="features/albums/css/lightbox.min.css"/>
    <script type="text/javascript" src="features/albums/js/lightbox.min.js"></script>

    <div class="box-body row widget">
        <?php
        global $shwpics;
        //echo "<table>";
        $i=0;
        foreach ($shwpics as $spic)
        {?>


        <div class="col-lg-6 col-md-6 col-sm-6 no-padding">

            <div class="widget-content">

                <a href=<?php echo "features/albums/uploads/".$spic['imgurl'];?>  data-title=<?php echo $spic['name'];?> data-lightbox="samebox">
                    <img src=<?php echo "features/albums/uploads/".$spic['imgurl'];?> width='100%' height="150px" class="img-rounded"/>
                </a>
                <p><?php echo $spic['name'];?></p>

            </div>

        </div>
        <?php if(++$i % 2 === 0):?> </div><div  class="box-body row widget"><?php endif;?>
        <?php };?>
    </div>
</div>