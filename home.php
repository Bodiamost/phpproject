<?php 
//ini_set('session.save_path',getcwd(). '\tmp'); //for winhost
ini_set('session.save_path',getcwd(). '/tmp'); //for my laptop
ini_set('session.gc_probability', 1);

session_start();
$_SESSION['user_id']=isset($_SESSION['sessData']['userID'])? $_SESSION['sessData']['userID'] : 1;
$_SESSION['user_name']=isset($_SESSION['sessData']['userName'])?$_SESSION['sessData']['userName'] :'Demo User';
$feature='home';
//$action='view';
if(isset($_GET['feature']))
{
  $feature=filter_input(INPUT_GET, 'feature');
}
/*
if ($feature==='faq')
{
    header('Location: features/community/userfaq.php');
}

if ($feature==='polls')
{
    header('Location: features/polls/index.php');
}
if ($feature==='newalbums')
{
    header('Location: features/new_albums_posts/album/?feature=album');
}
if ($feature==='posts')
{
    header('Location: features/new_albums_posts/posts/?feature=posts');
}*/
?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" href="img/favicon.png">
    <title>WorldLink</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/timeline.css" rel="stylesheet">
    <link href="css/cover.css" rel="stylesheet">
    <link href="css/forms.css" rel="stylesheet">
    <link href="css/buttons.css" rel="stylesheet">
    <link rel='stylesheet' type='text/css' href='css/styleForSearch.css'/><!--FOR location search -->
      <?php if($feature=='chat') : ?>
          <link rel="stylesheet" href="features/chat/style.css" type="text/css" media="screen" />
      <?php endif;?>
      <?php if($feature=='album') : ?>
        <link rel='stylesheet' type='text/css' href='features/albums/style.css'/><!--FOR albums-->
      <?php endif;?>
      <?php if($feature=='rssfeed') : ?>
        <link rel='stylesheet' type='text/css' href='features/rssfeed/css/style.css'/>
      <?php endif;?>
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
          <a class="navbar-brand" href="index.php"><b>Network</b></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
	    <li><a href="admin.php">Admin</a></li>
            <li class="actives"><a href="index.php">Profile</a></li>
            <li><a href="home.php">Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Images<span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="home.php?feature=album&action=view">Albums</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Trips<span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="home.php?feature=places&action=viewlist">Places</a></li>
                <li><a href="home.php?feature=events&action=viewlist">Events</a></li>
                <li><a href="home.php?feature=cafes&action=viewlist">Restaurants</a></li>
                <li><a href="home.php?feature=trips&action=viewlist">View trips</a></li>
                <li><a href="home.php?feature=trips&action=new_trip">Plan a trip</a></li>
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
                  <a href="home.php">
                      <img src="img/guy-3.jpg" alt="">
                  </a>
                  <h1><?php echo $_SESSION['user_name'];?></h1>
                </div>

                <ul class="nav nav-pills nav-stacked">
                  <li class="active"><a href="home.php?feature=posts&action=view"> <i class="fa fa-user"></i> News feed</a></li>
                  <li>
                    <a href="home.php?feature=chat"> 
                      <i class="fa fa-envelope"></i> Messages 
                      <span class="label label-info pull-right r-activity">9</span>
                    </a>
                  </li>
                  <li><a href="home.php?feature=album&action=view"> <i class="fa fa-folder-open"></i> Albums</a></li>
                  <li><a href="home.php?feature=community"> <i class="fa fa-group"></i> Communities</a></li>
                  <li><a href="home.php?feature=pollsystem"> <i class="fa fa-comment"></i> Polls</a></li>
                </ul>
              </div>
            </div>

            <div class="widget">
              <div class="widget-body">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="home.php?feature=places&action=viewlist"> <i class="fa fa-map"></i>  Places</a></li>
                  <li><a href="home.php?feature=events&action=viewlist"> <i class="fa fa-calendar"></i> Events</a></li>
                  <li><a href="home.php?feature=cafes&action=viewlist"> <i class="fa fa-glass"></i> Restaurants</a></li>
                  <li><a href="home.php?feature=trips&action=viewlist"> <i class="fa fa-car"></i> Trips</a></li>  
                  <li><a href="home.php?feature=trips&action=new_trip"> <i class="fa fa-tasks"></i> Plan your trip</a></li>
                </ul>
              </div>
            </div>

            <div class="widget">
              <div class="widget-body">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="features/Contact_form/indexnew.php"> <i class="fa fa-globe"></i> Contact us</a></li>
                  <li><a href="home.php?feature=faq"> <i class="fa fa-question-circle"></i> FAQ</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div><!-- end left links -->


        <!-- center posts -->
        <div class="col-md-6">
          <?php 
            if($feature==='home'){}
            else if ($feature==='places') 
	          {
      		    require_once 'features/places/index.php';
      	    } 
            else if ($feature==='events') 
            {
              require_once 'features/events/index.php';
            } 
            else if ($feature==='cafes') 
            {
              require_once 'features/restaurants/index.php';
            } 
            else if ($feature==='trips') 
            {
              require_once 'features/trips/index.php';
            } 
            else if ($feature==='faq') 
	          {
              echo '<div class="box" style="height:2200px;">';
      		    require_once 'features/community/userfaq.php';
              echo '</div>';
      	    }
            else if ($feature==='community')
            {

                require_once 'features/community/community.php';
            }
            else if ($feature==='chat') 
            {
              echo '<div class="box" style="min-height:700px;">';
              require_once 'features/chat/chatindex.php';
              echo '</div>';
            }
            else if ($feature==='album') 
            {
              echo '<div class="box" style="height:1600px;">';
              require_once 'features/albums/index.php';
              echo '</div>';
            }
            else if ($feature==='posts')
            {
                require_once 'features/posts/timeline.php';
            }
            else if ($feature==='rssfeed')
            {
                require_once 'features/rssfeed/index.php';
            }
            else if ($feature==='pollsystem')
            {
                echo '<div class="box" style="min-height:700px;">';
                require_once 'features/pollsystem/index.php';
                echo '</div>';
            }

            else echo "Content not found";
          ?>
        </div><!-- end  center posts -->




        <!-- right posts -->
        <div class="col-md-3">
          <div class="box" style="height:800px;"><h3>Check out around the world:</h3>
            <?php require_once 'features/rssfeed/create_feed.php';?>
          </div>
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
