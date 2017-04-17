<?php 
$feature='home';
$action='view';
if(isset($_GET['feature']))
{
  $feature=$_GET['feature'];
  $action=$_GET['action'];
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/animate.min.css" rel="stylesheet">
    <link href="../css/timeline.css" rel="stylesheet">
    <link href="../css/cover.css" rel="stylesheet">
    <link href="../css/forms.css" rel="stylesheet">
    <link href="../css/buttons.css" rel="stylesheet">
    <link href="../css/lightbox.min.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="style.css"/>
    <script src="../js/jquery.1.11.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/lightbox.min.js"></script>

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
          <a class="navbar-brand" href="index.php"><b>Network</b></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="actives"><a href="index.php">Profile</a></li>
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Images<span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="index.php">Explore</a></li>
                <li><a href="index.php">Albums</a></li>
                <li><a href="index.php?feature=upload">Images</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Trips<span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="index.php?feature=places&action=viewlist">Places</a></li>
                <li><a href="index.php">Events</a></li>
                <li><a href="index.php">Restaurants</a></li>
                <li><a href="index.php">View trips</a></li>
                <li><a href="index.php">Plan a trip</a></li>
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
        <div class="col-md-3">
          <div class="profile-nav">
            <div class="widget">
              <div class="widget-body">
                <div class="user-heading round">
                  <a href="index.php">
                      <img src="../posts/img/guy-3.jpg" alt="">
                  </a>
                  <h1>John Breakgrow</h1>
                  <p>@username</p>
                </div>

                <ul class="nav nav-pills nav-stacked">
                  <li class="active"><a href="index.php?feature=post"> <i class="fa fa-user"></i> News feed</a></li>
                  <li>
                    <a href="index.php"> 
                      <i class="fa fa-envelope"></i> Messages 
                      <span class="label label-info pull-right r-activity">9</span>
                    </a>
                  </li>
                  <li>
                    <a href="index.php"> 
                      <i class="fa fa-users"></i> People
                      <span class="label label-info pull-right r-activity">10</span>
                    </a>
                  </li>
                  <li><a href="index.php"> <i class="fa fa-image"></i> Images</a></li>
                  <li><a href="index.php?feature=album"> <i class="fa fa-folder-open"></i> Albums</a></li>
                  <li><a href="index.php"> <i class="fa fa-group"></i> Communities</a></li>                  
                  <li><a href="index.php"> <i class="fa fa-comment"></i> Polls</a></li>
                </ul>
              </div>
            </div>

            <div class="widget">
              <div class="widget-body">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="index.php?feature=place"> <i class="fa fa-map"></i>  Places</a></li>
                  <li><a href="index.php"> <i class="fa fa-calendar"></i> Events</a></li>
                  <li><a href="index.php"> <i class="fa fa-glass"></i> Restaurants</a></li>
                  <li><a href="index.php"> <i class="fa fa-car"></i> Trips</a></li>  
                  <li><a href="index.php"> <i class="fa fa-tasks"></i> Plan your trip</a></li>
                </ul>
              </div>
            </div>

            <div class="widget">
              <div class="widget-body">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="index.php"> <i class="fa fa-globe"></i> Contact us</a></li>
                  <li><a href="index.php"> <i class="fa fa-question-circle"></i> FAQ</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div><!-- end left links -->


        <!-- center posts -->
        <div class="col-md-6">
          <?php 
            if($_GET['feature']===''){}
            else if ($_GET['feature']==='album')
	          {
      		    require_once 'dispalbm1.php';
      	    }
            else if ($_GET['feature']==='upload')
            {
                require_once 'multi1.php';
            }
            else if ($_GET['feature']==='pics')
            {
                require_once 'dispics1.php';
            }
            else if ($_GET['feature']==='amadd')
            {
                require_once 'album.php';
            }
            else if ($_GET['feature']==='post')
            {
                require_once 'post1.php';
            }
            else if($_GET['feature']==='timeline')
            {
                require_once 'timeline.php';
            }
          else echo "Content not found";
          ?>
        </div><!-- end  center posts -->




        <!-- right posts -->
        <div class="col-md-3">
          <div class="box" style="height:800px;"><h1>Another Feature content</h1></div>
        </div><!-- end right posts -->
      </div>
    </div>

    <footer class="footer">
      <div class="container">
        <p class="text-muted"> Copyright &copy; Network - All rights reserved </p>
      </div>
    </footer>
  </body>
</html>
