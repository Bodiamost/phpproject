<?php 
$feature='home';
//$action='view';
if(isset($_GET['feature']))
{
  $feature=filter_input(INPUT_GET, 'feature');
  echo $feature;
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
    <title>Network Admin</title>
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
  </head>

  <body class="animated fadeIn">

    <!-- Fixed navbar -->
    <nav class="navbar navbar-white navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="admin.php"><b>Network Admin</b></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="actives"><a href="index.php">Website</a></li>
            <li><a href="admin.php">Admin panel</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Images<span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="admin.php">Explore</a></li>
                <li><a href="admin.php">Albums</a></li>
                <li><a href="admin.php">Images</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Trips<span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="admin.php?feature=places$action=viewlist">Places</a></li>
                <li><a href="admin.php">Events</a></li>
                <li><a href="admin.php">Restaurants</a></li>
                <li><a href="admin.php">View trips</a></li>
                <li><a href="admin.php">Plan a trip</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Begin page content -->
    <div class="container page-content ">
 
      <div class="row">
        <!-- left links -->
        <div class="col-md-2">
          <div class="profile-nav">
            <div class="widget">
              <div class="widget-body">

                <ul class="nav nav-pills nav-stacked">                 
                  <li>
                    <a href="#"> 
                      <i class="fa fa-users"></i> Users
                      <span class="label label-info pull-right r-activity">10</span>
                    </a>
                  </li>
                  <li>
                    <a href="#"> 
                      <i class="fa fa-envelope"></i> Messages
                    </a>
                  </li>
                  <li><a href="#"> <i class="fa fa-image"></i> Images</a></li>
                  <li><a href="#"> <i class="fa fa-folder-open"></i> Albums</a></li>
                  <li><a href="#"> Image sliders</a></li>
                  <li><a href="#"> <i class="fa fa-group"></i> Groups</a></li>                  
                  <li><a href="#"> <i class="fa fa-comment"></i> Polls</a></li>                 
                  <li><a href="#"> Posts(Admin panel CRUD)</a></li>                 
                  <li><a href="#"> <i class="fa fa-comment"></i> Polls</a></li>
                </ul>
              </div>
            </div>

            <div class="widget">
              <div class="widget-body">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="admin.php?feature=places&action=viewlist"> <i class="fa fa-map"></i>  Places</a></li>
                  <li><a href="admin.php?feature=events&action=viewlist"> <i class="fa fa-calendar"></i> Events</a></li>
                  <li><a href="admin.php?feature=cafes&action=viewlist"> <i class="fa fa-glass"></i> Restaurants</a></li>
                  <li><a href="admin.php?feature=trips&action=viewlist"> <i class="fa fa-car"></i> Trips</a></li>
                  <li><a href="#"> <i class="fa fa-tasks"></i> Plan trip</a></li>
                </ul>
              </div>
            </div>

            <div class="widget">
              <div class="widget-body">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="#"> <i class="fa fa-globe"></i> Contact us</a></li>
                  <li><a href="admin.php?feature=faq  "> <i class="fa fa-question-circle"></i> FAQ</a></li>
                  <li><a href="#"> Alerts</a></li>
                  <li><a href="#"> Social sharing</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div><!-- end left links -->


        <!-- center posts -->
        <div class="col-md-10">
           <?php 
            if($feature==='home'){}
            else if ($feature==='places') 
            {
              require_once 'features/places/adminController.php';
            } else if ($feature==='events')
            {
                require_once 'features/events/adminController.php';
            } else if ($feature==='cafes')
            {
                require_once 'features/restaurants/adminController.php';
            } else if ($feature==='trips')
            {
                require_once 'features/trips/adminController.php';
            } else if ($feature==='faq')
            {

              echo '<div class="box" style="height:1200px;">';
              require_once 'features/faq/listfaq.php';
              echo "</div>";
            }
          else echo "Content not found";
          ?>
        </div><!-- end  center posts -->

      </div>
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted"> Copyright &copy; Network - All rights reserved </p>
      </div>
    </footer>
  </body>
</html>
