
<?php

require_once "features/posts/getinfo.php";
require_once "features/posts/getcheckins.php";
$chk=new getcheckins();
$chks=$chk->showChk();
//include('errorhandle.php');
?>
<link rel="stylesheet" href="features/posts/style.css"/>
<script type="text/javascript" src="features/posts/js/jquery.1.11.1.min.js"></script>
<script type="text/javascript" src="features/posts/timeline.js"></script>
<div class="box">
<div class="wrapper">
    <!--content -->
    <div class="content">
        <!--left-content-->
        <div class="center">
            <div class="posts">




                <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
                      rel = "stylesheet">
                <script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
                <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
                <script src = "features/posts/map.js"></script>




                    <div class="post-show">
                        <div class="post-show-inner">
                            <div class="post-header">

                                <div class="post-right-box"></div>
                            </div>

                            <div class="post-body">
                                <div id="results"></div>
                                <div class="pmap">
                                    <p id="lat"></p>
                                    <p id="lng"></p>
                                    <div id="map" style="height: 400px"></div>





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




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>

            </div>

        </div></div></div>
<script>



    function initMap(a,b,mapid) {


        //console.log(lt);

        var uluru = {lat:parseFloat(a) , lng:parseFloat(b)};
        var map = new google.maps.Map(document.getElementById(mapid), {
            zoom: 14,
            center: uluru
        });

        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
        }


</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrv18VtDMOUV9l_DNUogXpN3xc96kFWks&callback=initMap">
</script >
</div>