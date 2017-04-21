<?php
ini_set('session.save_path',getcwd(). '/../../tmp');
session_start();
if(isset($_SESSION['sessData']['userLoggedIn']) && ($_SESSION['sessData']['userLoggedIn'] == true) ) {

    $username = $_SESSION['sessData']['userName'];
    $userId = $_SESSION['sessData']['userID'];

} else {
    echo "Please Login ";
    exit();
    die();
}

?>
<?php

require_once "dbconnect.php";
require_once "faqdb.php";
$id = $_GET['id'];

$db=connect::dbConnect();
$pics=new Faq($db);

if( (isset($_GET['action'])) && ($_GET['action'] == "CLIKE") && (isset($_GET['id']) != "") && (is_numeric($_GET['id'])) ) {

    $pics->usersLike($_GET['id']);

 header('Location: community_profile.php?id='.$_REQUEST['id']);



}


if(isset($_POST['upd'])){
    $user_post = $_POST['user_post'];
    $id = $_GET['id'];
    $curdate=date("Y-m-d");

    $user_posts=new Faq($db);
    $update_post=$user_posts->updatePost($id,$user_post,$curdate,$userId,$username);
    header('Location: community_profile.php?id='.$id);
}
if(isset($_POST['updcomment'])){
    $user=$_POST['user'];
   echo $user;
    date_default_timezone_set('Canada/Eastern');

    $comment = $_POST['user_comment'];
    $post_id = $_POST['post_id'];
    $curdate=date("Y-m-d");
    $curtime = date("H:i:s");
    $user_posts=new Faq($db);
    $update_post=$user_posts->usersComments($post_id,$comment,$curdate,$curtime,$userId,$username);
    header('Location: community_profile.php?id='.$id);
}


if(isset($_POST['addpic']))
{

    for($i=0; $i<count($_FILES['pic']['name']); $i++){
        $user_id = $_POST['id'];
        $file=$_FILES['pic']['name'][$i];
        $file_type=$_FILES['pic']['type'][$i];
        $file_tmp=$_FILES['pic']['tmp_name'][$i];
        $user_id=$_POST['id'];
        $random_name=rand();


        $upic=new Faq($db);
        $id = $upic->multipleImages($user_id,$random_name,$file_tmp);
        header('Location: community_profile.php?id='.$_REQUEST['id']);

    }

}
if(isset($_POST['addvideo']))
{
    $user_id=$_POST['id'];
    $file=$_FILES['pic']['name'];
    $file_type=$_FILES['pic']['type'];
    $file_size=$_FILES['pic']['size'];
    $file_tmp=$_FILES['pic']['tmp_name'];

    $random_name=rand();

    $upic=new Faq($db);
    $id = $upic->userVideos($user_id,$file,$file_tmp);
    header("Location: community_profile.php?id=".$user_id);
}

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" href="img/favicon.png">
    <title>Network</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/timeline.css" rel="stylesheet">
    <link href="css/cover.css" rel="stylesheet">
    <link href="css/forms.css" rel="stylesheet">
    <link href="css/buttons.css" rel="stylesheet">
    <script src="js/jquery.1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>

    $(document).ready(function(){


        $('#show-pic').hover(function(){
            $('#edit-pic').show();
        },function(){
            $('#edit-pic').hide();
        });

        $('#cover-photo-show').hover(function(){
            $('#edit-cover-pic').show();
        },function(){
            $('#edit-cover-pic').hide();
        });



    });


    </script>
    <script>

        function myFunction() {
                document.getElementById("write-post").placeholder= "What's on your mind?";
                document.getElementById("write-post").style.color = "grey";
                document.getElementById("write-post").style.fontSize = "20px";
            }
            function myFunctionn0() {
                var x=document.getElementsByClassName("animated fadeIn");
                x[0].style.backgroundColor="#e9eaed";
            }
            function myFunctionn() {
                var x=document.getElementsByClassName("animated fadeIn");
                x[0].style.backgroundColor="#ff336b";
            }
            function myFunctionn2() {
                var x=document.getElementsByClassName("animated fadeIn");
                x[0].style.backgroundColor="#33e6ff";
            }
            function myFunctionn3() {
                var x=document.getElementsByClassName("animated fadeIn");
                x[0].style.backgroundColor="#33ff80";
            }
            function myFunction4() {
                document.getElementById("#comment").showPopup();

            }




        </script>
    <style>

        /*GROW*/
        .grow img {
            width:110px;
            height:110px;
            padding:5px;



            -webkit-transition: all 1s ease;
            -moz-transition: all 1s ease;
            -o-transition: all 1s ease;
            -ms-transition: all 1s ease;
            transition: all 1s ease;
        }

        .grow img:hover {
            width: 150px;
            height: 150px;
        }


    </style>

</head>

<div>
    <select >
        <option onclick="myFunctionn0()">Change Background</option>
        <option onclick="myFunctionn()">Red</option>
        <option onclick="myFunctionn2()">Blue</option>
        <option onclick="myFunctionn3()">Green</option>

    </select>
</div>
<body class="animated fadeIn">


<!-- Begin page content -->
<div class="container page-content ">


    <div class="row">

        <!-- left links -->
        <div class="col-md-3">

            <div class="profile-nav">
                <div class="widget">
                    <div class="widget-body">
                        <?php


                        $id=$_REQUEST['id'];
                        $showpics=$pics->viewPics($id);


                        ?>

                        <!-- Modal to edit profile photo-->
                        <div class="modal fade" id="myModalp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"></h4>
                                    </div>
                                    <div class="modal-body">

                                 <?php require_once 'updateprofile.php'?>



                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="">

                            <div id="edit-pic" style="display:none">
                            <form action="updateprofile.php" method="POST">
                                <input type="hidden" value="<?php echo $_REQUEST['id']?>" name="id"/>
                            <b><a href="" style=" font-size= 28px;position: absolute;margin-left:50px;margin-top:20px;" data-toggle="modal" data-target="#myModalp">
                                <i class="glyphicon glyphicon-picture"></i>
                                <input style="border:none;width:40px;height:20px;background-color:transparent;" type="submit" value="Edit" name="update" />

                            </a>
                            </b>
                            </form>
                            </div>
                             <div id="show-pic">
                            <?php
                        foreach($showpics as $list){

    echo "
  
    
<img src='uploads/". $list->picture . "' class='img-circle'  style='width:230px;height:230px;'/>";


                       ?>

                            <?php } ?>
                             </div>
                            <h1>
                                <?php
                                foreach($showpics as $list){

                                    echo "
  

                    $list->category_name ";
                                }
                                ?></h1>
                            <p><?php
                                foreach($showpics as $list){

                                    echo "$list->product_name ";
                                }
                                ?></p>

                        </div>

                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="http:/PHP/phpproject/home.php"> <i class="fa fa-user"></i> Home</a></li>
                            <li>
                                <a href="#" onclick="myFunction()">
                                    <i class="glyphicon glyphicon-pencil"></i> Post</a></li>
                            <li><a href="" data-toggle="modal" data-target="#myModal"> <i class="glyphicon glyphicon-picture"></i> Images</a></li>
                            <li><a href="" data-toggle="modal" data-target="#myModal2"> <i class="glyphicon glyphicon-facetime-video"></i> Videos</a></li>






                                <h4>People You May Know</h4>
                                <div id="playground">
                                        <p>

                                            <input id="keywords" type="text" name="search" value="<?php if( (isset($_GET['search'])) && (trim($_GET['search'] )!= "") ) { echo $_GET['search']; }?>">
                                            <button  style="background:white;"> <i class="glyphicon glyphicon-search"></i></button>
                                    <p>

                                        <?php
                                        require_once 'dbconnect.php';
                                        require_once 'faqdb.php';

                                        $db = Connect::dbConnect();
                                        $mylist =  new Faq($db);



                                        if( (isset($_GET['action'])) && ($_GET['action'] == "LIKE") && (isset($_GET['id']) != "") && (is_numeric($_GET['id'])) ) {
                                            $mylist->Like($_GET['id']);

                                        }

                                        if( (isset($_GET['search'])) && (trim($_GET['search'] )!= "") ) {
                                            $search = $_GET['search'];
                                        } else {
                                            $search = false;
                                        }


                                        $shownames = $pics->usersInvites($search,$_GET['id']);


                                        if($shownames) {
                                            foreach($shownames as $list) {



                                                echo "

  <div class='panelContainer'>";
                                        echo "$list->first_name " ;
if($list->inv_status == 'not_invited') {
    echo "<a class='label label-success' style='float:right;background-color:rgb(45, 195, 232);' href='users.php?page_id=" . $_REQUEST['id'] . "&action=INVITE&id=" . $list->id . "' class='btn btn-submit'> <i class='glyphicon glyphicon-share-alt'></i> Invite </a>";
} else {

    echo "<label style='float:right'class='label label-success'>Invited</label>";
}

echo "</p>";
                                            }

                                        } else{
                                            echo "No Results Found";
                                        }

                                        ?>


                                    </p>

                                </div>

                                <script type="text/javascript" src="js/hilitor.js"></script>
                                <script type="text/javascript">

                                    var myHilitor2;

                                    document.addEventListener("DOMContentLoaded", function(e) {
                                        myHilitor2 = new Hilitor("playground");
                                        myHilitor2.setMatchType("left");
                                    }, false);

                                    document.getElementById("keywords").addEventListener("keyup", function(e) {
                                        myHilitor2.apply(this.value);
                                    }, false);

                                </script>






                            </li>





                        </ul>
                    </div>
                </div>



            </div>
        </div><!-- end left links -->


        <!-- center posts -->
        <div class="col-md-6">
            <div class="bx" style='height:800px;width:900px'>
             <div class="" style='width:900px;height:200px;'>
                 <!-- Modal to edit cover photo-->
                 <div class="modal fade" id="myModalcover" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                     <div class="modal-dialog" role="document">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                 <h4 class="modal-title" id="myModalLabel"></h4>
                             </div>
                             <div class="modal-body">

                                 <?php require_once 'updatecover.php'?>



                             </div>

                         </div>
                     </div>
                 </div>
                 <div id="edit-cover-pic" style="display:none;">
                     <form action="updateprofile.php" method="POST">
                         <input type="hidden" value="<?php echo $_REQUEST['id']?>" name="id"/>
                         <b><a href="" style="font-size= 38px;position: absolute;margin-left:50px;margin-top:20px;" data-toggle="modal" data-target="#myModalcover">
                             <i class="glyphicon glyphicon-picture"></i>
                             <input style="border:none;width:40px;height:20px;background-color:transparent;" type="submit" value="Edit" name="update" />

                         </a>
                         </b>
                     </form>
                 </div>
                 <?php
                 foreach($showpics as $list){

                     echo "
  

                   <img id='cover-photo-show' src='cover-photo-uploads/". $list->cover_picture . "'style='width:900px;height:300px;'/>";
                 }
                 ?>
             </div>
                 <div style="margin-top:130px;">
                        <div style="float:left">
                        <div style="width:300px;padding:20px;background-color:white;">
                            <div style=""><i class="glyphicon glyphicon-picture"></i> Photos</div>
                            <div class="grow pic">
                         <?php

                         $id = $_REQUEST['id'];
                         $showpicsmultiple=$pics->viewmultiplePics($id);

                                 foreach($showpicsmultiple as $list){
                                     echo "<img src='multiple-users-uploads/". $list->picture . "'/>";

                                 }


                             ?>
                            </div>


                        </div>
                            <div style="width:300px;padding:20px;background-color:white;margin-top:10px;">
                                <div style=""><i class="glyphicon glyphicon-facetime-video"></i> Videos</div>
                                <?php

                                $id = $_REQUEST['id'];
                                $showvideos=$pics->viewVideos($id);

                                foreach($showvideos as $list){

                                    echo  "<video width='260' height='260' controls> <source src=".'uploads-videos/'.$list->user_video." type='video/mp4'>Your browser does not support the video tag.</source></video>";


                                }


                                ?>

                            </div>
                        </div>



                     <div style="float:right;width:580px;height:180px;background:white;">
                         <div style="width:580px;height:30px;padding:10px;>
                         <table">
                             <tr>
                                 <td><a href="#" id="show-post" style="padding-right:20px;color:grey;" onclick="myFunction()">
                                         <i class="glyphicon glyphicon-pencil"></i> Post</a></td>
                                 <td>  <a href="" style="padding-right:20px;color:grey;" data-toggle="modal" data-target="#myModal"> <i class="glyphicon glyphicon-picture"></i> Images</a>

                                     <!-- Modal -->
                                     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                         <div class="modal-dialog" role="document">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                     <h4 class="modal-title" id="myModalLabel">ADD POST</h4>
                                                 </div>
                                                 <div class="modal-body">

                                                     <h3>Now You Can Add multiple Photos</h3>
                                     <form method="post" action="community_profile.php" enctype="multipart/form-data">
                                         <div class="form-group">
                                             <input type="hidden" value="<?php echo $_REQUEST['id'];?>" name="id">
                                             <input type="file" id="exampleInputFile" name="pic[]" multiple/>
                                             <input type="submit" class="btn btn-primary"  name="addpic" class="btn btn-default" value="ADD"/>
                                             <button type="button" class="btn btn-primary"  data-dismiss="modal">Close</button>
                                         </div>
                                     </form>
                                                 </div>

                                             </div>
                                         </div>
                                         </div>
                                 </td>
                                 <td><a href="" style="padding-right:20px;color:grey;"  data-toggle="modal" data-target="#myModal2"> <i class="glyphicon glyphicon-facetime-video"></i> Videos</a>

                                     <!-- Modal for video-->
                                     <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                         <div class="modal-dialog" role="document">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                     <h4 class="modal-title" id="myModalLabel">ADD Video</h4>
                                                 </div>
                                                 <div class="modal-body">
                                     <form method="post" action="community_profile.php" enctype="multipart/form-data">
                                         <div class="form-group">
                                             <input type="hidden" value="<?php echo $_REQUEST['id'];?>" name="id">
                                             <input type="file" id="exampleInputFile" name="pic"/>
                                             <input type="submit" name="addvideo" class="btn btn-primary" value="ADD Video"/>
                                             <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                         </div>
                                     </form>
                                                 </div>

                                             </div>
                                         </div>



                                 </td>

                             </tr>
                         </table>
                         </div>
                         <div style="padding: 10px;">
                                     <form action="community_profile.php?id=<?php echo $id; ?>" method="post">
                                         <textarea id='write-post' style="width:540px;height:100px;" name="user_post" value="" placeholder=""></textarea><br />


                                         <input style="float:right;margin-top:2px;" class="btn btn-primary" type="submit" value="Post" name="upd" />

                                     </form>

                         </div>

                         <div style="background:white;width:570px;padding:10px;margin-top:40px; " >
                             <div>
                             <div style="float:left;width:80px;height:80px;">
                                 <?php
                                 foreach($showpics as $list){

                                     echo "<img src='uploads/". $list->picture . "' class='img-square' style='width:80px;height:80px;'/>";

                                 }
                                 ?>
                             </div>
                             </div>


                             <div style="float:right;font-size:26px;color:rgb(74, 144, 226);width:450px;height:80px;">
                              <?php   echo "$list->product_name"; ?>
                             </div>

                                <div style="padding-top:20px;clear:both;">


                             <?php
                             $id_post=$_REQUEST['id'];
                             $showposts = $pics->viewPost($id_post);
                             foreach($showposts as $list){
                                 echo "<div style='padding-top:5px; color:rgb(45, 195, 232);font-size:28px; font-weight: bold'><i style='padding-right:5px;color:dimgrey;font-size:20px;'class='glyphicon glyphicon-user'></i>"."$list->posted_by_name"."</div>";
                                 echo "<div style='color:grey'> "."$list->curdate"."</div>";
                                 echo "<div style='padding-top:5px;font-size:28px;'>"."$list->user_post"."</div><hr>";


                                 echo "<a href='community_profile.php?action=CLIKE&id=".$id_post."'> $list->likes <i class='glyphicon glyphicon-thumbs-up'></i> Likes </a><hr>";

                                $a = $list->post_id;

                                 $showcomment = $pics->viewComment($a);
                                 foreach($showcomment as $sh  )
                                 {

                                     echo "$sh->user_name".":&nbsp;&nbsp;";
                                     echo "$sh->comment";
                                    require_once "current.php";
                                    $get=new currenttime();
                                    echo "<div style='color:dimgrey';>".$get->curTime($sh->curtime)."</br></div>";
                                 }


                             ?>



                               <div id="comment">
                                 <form action="community_profile.php?id=<?php echo $id; ?>" method="post">
                                     <input type="text" id='write-post' style="width:490px;padding:10px;height:32px;" name="user_comment" value="" placeholder="Comment Here..."/>
                                      &nbsp;<input type="hidden" name="post_id" value="<?php echo $list->post_id?>"/>

                                    <input type="hidden" value="" name="user" value="<?php echo $_REQUEST['user_id']?>">
                                     <input style="float:right" class="btn btn-primary" type="submit" value="Send" name="updcomment" /><hr>

                                 </form>
                               </div>
                                    <?php } ?>
                                </div>
                         </div>
                     </div>


            </div>

            </div>
        </div><!-- end  center posts -->



    </div>
</div>


</body>
</html>


