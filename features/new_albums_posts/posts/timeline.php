
<?php
require_once "connect.php";
require_once "disPosts.php";
require_once "getinfo.php";
require_once "newPost.php";
$obj=new getinfo();
$fname=$obj->getfname();
$pic=$obj->getpic();

$p=new disPosts();

$result=$p->disPosts();

if(isset($_POST['add']))
{

    if(empty($_FILES['post_image']))
    {
        $random_name=Null;
        $$file_tmp=Null;
    }
    else
    {
        $id=1;
        $status=$_POST['status'];
        $file=$_FILES['post_image']['name'];
        $file_type=$_FILES['post_image']['type'];
        $file_size=$_FILES['post_image']['size'];
        $file_tmp=$_FILES['post_image']['tmp_name'];
        //date_default_timezone_set("Canada/Toronto");
        $random_name=rand();
        $loc="abc";
        $datest=date("Y/m/d");
        date_default_timezone_set('Canada/Eastern');
        $timest = date('m/d/Y h:i:s a', time());


        $post=new newPost();
        $record=$post->addPost($id,$status,$random_name,$file_tmp,$loc,$timest,$datest);

        echo $record ."inserted";
        echo $timest;
    }

}
//var_dump($result);*/
?>
<link rel="stylesheet" href="style.css"/>
<script type="text/javascript" src="jquery.1.11.1.min.js"></script>


<div class="wrapper">
    <!--content -->
    <div class="content">
        <!--left-content-->
        <div class="center">
            <div class="posts">
                <div class="create-posts">
                    <form id="post" action="" method="post" enctype="multipart/form-data">
                        <div class="c-header">
                            <div class="c-h-inner">
                                <ul>
                                    <li style="border-right:none;"><img src="img/icon3.png"></img><a href="#">Update Status</a></li>
                                    <li><input type="file"  onchange="readURL(this);" style="display:none;" name="post_image" id="uploadFile"></li>
                                    <li><img src="img/icon1.png"></img><a href="#" id="uploadTrigger">Add Photos/Video</a></li>
                                    <li style="border: none;"><img src="img/icon2.png"></img><a href="#">Create Photo Album</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="c-body">
                            <div class="body-left">
                                <div class="img-box">
                                    <img src=<?php echo "profile/".$pic->prflpic;?>></img>

                                </div>
                            </div>
                            <div class="body-right">
                                <textarea class="text-type" name="status" placeholder="What's on your mind?"></textarea>
                            </div>
                            <div id="body-bottom">
                                <img src="#"  id="preview"/>
                            </div>
                        </div>
                        <div class="c-footer">
                            <div class="right-box">
                                <ul>
                                    <li><input type="submit" name="add" value="Post" class="btn2"/></li>
                                </ul>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <script type="text/javascript">
                //Image Preview Function
                $("#uploadTrigger").click(function(){
                    $("#uploadFile").click();
                });
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#body-bottom').show();
                            $('#preview').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }


            </script>


            <?php
            global $result;
            global $fname;
            global $pic;
            //$ctime=date("h:i:sa");
            foreach ($result as $rs)
            {?>
                <div class="post-show">
                    <div class="post-show-inner">
                        <div class="post-header">
                            <div class="post-left-box">
                                <div class="id-img-box"><img id="prfl" src=<?php echo "profile/".$pic->prflpic;?>></img></div>
                                <div class="id-name">
                                    <ul>
                                        <li><a id="uname" href="#"><?php echo $fname->fname;?></a></li>
                                        <li><small><?php require_once "timeago.php"; $get=new timeago(); echo $get->getTime($rs['timest']);?></small></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="post-right-box"></div>
                        </div>

                        <div class="post-body">
                            <div id="st" class="post-header-text">
                                <?php echo $rs['status'];?>
                            </div><div class="post-img">
                                <img id="pimg" src=<?php echo "post_img/".$rs['status_img'];?>></img>
                            </div>
                            <div class="post-footer">
                                <div class="post-footer-inner">
                                    <ul>
                                        <li><a href="#">Like</a></li>
                                        <li><a id="cmnt" href="#">Comment</a></li>
                                        <li><a href="#">Share</a></li>
                                    </ul>
                                </div>


                                <div class="post-footer-inner">
                                    <form id="cform" action="" method="post">
                                        <input type="text"  name="pid" id="pid" value=<?php echo $rs['Id']?>> </input>
                                        <input name="cbox" id="cbox" type="text" placeholder="Write a Comment"/>
                                        <div class="input_fields_wrap">
                                        </div>
                                        <input name="addc" type="submit" value="Comment"/>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
            <?php };?>
        </div>
