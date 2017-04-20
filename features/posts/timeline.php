
<?php
require_once "connect.php";
require_once "features/posts/disPosts.php";
require_once "features/posts/getinfo.php";
require_once "features/posts/newPost.php";

//include('errorhandle.php');
$obj=new getinfo();
$fname=$obj->getfname();
$pic=$obj->getpic();

$p=new disPosts();

$result=$p->disPosts();
//var_dump($result);
if(isset($_POST['add']))
{

    if(empty($_FILES['post_image']))
    {
        $random_name=Null;
        $$file_tmp=Null;
    }
    else
    {
    $id=12;
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
        $result=$p->disPosts();
    echo $record ."inserted";
    echo $timest;
    }

}
//var_dump($result);*/
?>

<link rel="stylesheet" href="features/posts/style.css"/>
<script type="text/javascript" src="js/jquery.1.11.1.min.js"></script>
<script type="text/javascript" src="features/posts/timeline.js"></script>

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
                                    <li style="border-right:none;"><img src="features/posts/img/icon3.png"></img><a href="#">Update Status</a></li>
                                    <li><input type="file"  onchange="readURL(this);" style="display:none;" name="post_image" id="uploadFile"></li>
                                    <li><img src="features/posts/img/icon1.png"></img><a href="#" id="uploadTrigger">Add Photos/Video</a></li>
                                    <li style="border: none;"><img src="features/posts/img/icon2.png"></img><a href="home.php?feature=album&action=amadd">Create Photo Album</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="c-body">
                            <div class="body-left">
                                <div class="img-box">
                                    <img src=<?php echo "features/log_signup/images/".$pic->prflpic;?>></img>

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
                                    <li><img src="features/albums/images/6cDGi.png" id="loc"  style="width:25px;height: 25px;"/></li>
                                    <li><input type="submit" name="add" value="Post" class="btn2"/></li>
                                </ul>
                            </div>

                    </form>
                    <div id = "dialog-5" title = "Dialog Title!">
                        <form id="search_form" action="" method="post">
                            <input id="pac-input" name="search_place"  type="text" value="" placeholder="Enter a location">
                            <fieldset>
                                <div>
                                    <input id="latInput" type="hidden" name="map_lat" value="" placeholder="">
                                    <input id="lngInput" type="hidden" name="map_lng" value="" placeholder="">
                                    <input id="zoomInput" type="hidden" name="map_zoom" value="" placeholder="">
                                    <input type="submit" value="Add">
                                </div>
                            </fieldset>
                        </form>

                    </div>
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
            <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
                  rel = "stylesheet">
            <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
            <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
            <style>
                .ui-widget-header,.ui-state-default, ui-button {
                    background:#b9cd6d;
                    border: 1px solid #b9cd6d;
                    color: #FFFFFF;
                    font-weight: bold;
                }
            </style>
            <script type = "text/javascript">
                $(function() {
                    $("#loc").click(function() {

                        ($("#dialog-5").dialog("isOpen") == false) ? $(
                                "#dialog-5").dialog("open") : $("#dialog-5").dialog("close") ;
                        });
                    $("#dialog-5").dialog({autoOpen: false});
                    $("#dialog-5").dialog({ position: [($(window).width() / 8) - ($("#dialog-5").width / 8), 150] });

                });
            </script>






            <script>
                // This example displays an address form, using the autocomplete feature
                // of the Google Places API to help users fill in the information.

                // This example requires the Places library. Include the libraries=places
                // parameter when you first load the API. For example:
                // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

                var autocomplete;

                function initAutocomplete() {
                    // Create the autocomplete object, restricting the search to geographical
                    // location types.
                    autocomplete = new google.maps.places.Autocomplete(
                        /** @type {!HTMLInputElement} */(document.getElementById('pac-input')),
                        {types: ['geocode']});

                    // When the user selects an address from the dropdown, populate the address
                    // fields in the form.
                    $( "#search_form" ).keypress(function (e) {
                        var key = e.which;
                        if(key == 13)  // the enter key code
                        {
                            return false;
                        }
                    });
                    autocomplete.addListener('place_changed', fillInAddress);
                }

                function fillInAddress() {
                    // Get the place details from the autocomplete object.
                    var place = autocomplete.getPlace();

                    document.getElementById("latInput").value = place.geometry.location.lat();
                    document.getElementById("lngInput").value = place.geometry.location.lng();
                    //console.log(place.geometry.viewport);
                    var point1=new google.maps.LatLng(place.geometry.viewport.f.f,place.geometry.viewport.b.f);
                    var point2=new google.maps.LatLng(place.geometry.viewport.f.b,place.geometry.viewport.b.b);

                    document.getElementById("zoomInput").value = google.maps.geometry.spherical.computeDistanceBetween(point1,point2)/2;
                    //$( "#search_form" ).submit();
                    //return false;
                }
                $("#search_form").submit(function (e) {
                    e.preventDefault();
                    //alert("working");
                    var lati=$("#latInput").val();
                    var lang=$("#lngInput").val();
                    var zi=$("#zoomInput").val();
                    //console.log(lati);
                    //
                    $.post("locpost.php",{lat:lati,lng:lang,zm:zi},function (data) {
                        //alert(data);
                        console.log(data);
                        window.location.replace("checkins.php");
                    });
                    return false;
                });


            </script>
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrv18VtDMOUV9l_DNUogXpN3xc96kFWks&libraries=geometry,places&callback=initAutocomplete">
            </script>


            <!--
                        <script>
                            $(document).ready(function(){
                                var prfl="";
                                var unmae="";
                                var st="";
                                var st_img="";
                                //var st_loc="";
                                $.getJSON("getposts.php",function (data) {
                                    //console.log(data);
                                    $.each(data,function (index,dt) {
                                        prfl=dt.prflpic;
                                        unmae=dt.fname;
                                        st=dt.status;
                                        st_img=dt.status_img;
                                        $("#prfl").attr('src',"profile/"+prfl);
                                        $("#unmae").html(unmae);
                                        $("#st").html(st);
                                        $("#pimg").attr('src',"post_img/"+st_img);

                                    });


                                });

                            });


                        </script>-->
            <!--
            <script>

                $("#post").submit(function () {

                    var id=1;
                    var status=$("#st").val();
                    var img=$("uploadFile").files[0].val();
                    var name=img.name.val();
                    var type=img.type;
                    var tmp=img.temp_name.val();
                    var randnm=rand();
                    var loc="abc";
                    //var dt=new Date().getDate();
                    //alert("hi"+dt);
                    //console.log(loc);
                    //var t=new Date().getTime();
                    $.post("add.php",{id:id,st:status,nm:name,loc:loc,temp:tmp},function (data) {

                     console.log(data);

                    });





                });
            </script>-->


            <script>
                $("#cform").submit(function () {
                    var pid=$("#pid").val();
                    var uid=1;
                    var cmnt=$("#cbox").val();

                    $.post("addComments.php",{p:pid,u:uid,c:cmnt},function (data) {

                    alert(data);
                    });

                });

            </script>

            <?php
            //global $result;
            //global $fname;
            //global $pic;
            //$ctime=date("h:i:sa");
            foreach ($result as $rs)
            {?>
                <div class="post-show">
                    <div class="post-show-inner">
                        <div class="post-header">
                            <div class="post-left-box">
                                <div class="id-img-box"><img id="prfl" src=<?php echo "features/log_signup/images/".$pic->prflpic;?>></div>
                                <div class="id-name">
                                    <ul>
                                        <li><a id="uname" href="#"><?php echo $fname->first_name;?></a></li>
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
                                <img id="pimg" src=<?php echo "features/posts/post_img/".$rs['status_img'];?>>
                            </div>
                            <div class="post-footer">
                                <div class="post-footer-inner">
                                    <ul>
                                        <li><a href="#">Like</a></li>
                                        <li><a class="btncmnt" href="#">Comment</a></li>
                                        <li><a href="#">Share</a></li>
                                    </ul>
                                </div>

                                <div class="post-footer-inner">
                                    <form method="post">
                                    <input class="cmnt" type="text" placeholder="Write a comment here.."/><input type="button" class="add" onclick="" value="add comment"/>
                                    <p class="hidden pid"><?php echo $rs['Id'];?></p>
                                    </form>
                                    <div class="an" style="width: 300px;">

                                    <?php
                                    require_once "features/posts/getComments.php";
                                    $obj=new GetComments();
                                    $cmnts=$obj->showCmnts(intval($rs['Id']));

                                    //var_dump($cmnts);

                                    foreach ($cmnts as $c)
                                    {?><div>
                                        <img src=<?php echo "features/log_signup/images/".$c['prflpic'];?> style="float:left;height:45px;width:45px"/>
                                        <a href="#"><?php echo $c['first_name']; ?></a>
                                        <div style="background-color: lightcyan;"><?php echo $c['cmnt'];?></div><br/> <hr/>
                                        </div>
                                        <?php };?>
                                    </div>



                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
            <?php };?>
        </div>

    </div>
</div>
</div>
