

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
            <a class="navbar-brand" href="index.html"><b>Network</b></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="actives"><a href="home.html">Profile</a></li>
                <li><a href="home.html">Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Images<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="home.html">Explore</a></li>
                        <li><a href="home.html">Albums</a></li>
                        <li><a href="home.html">Images</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Trips<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="home.html">Places</a></li>
                        <li><a href="home.html">Events</a></li>
                        <li><a href="home.html">Restaurants</a></li>
                        <li><a href="home.html">View trips</a></li>
                        <li><a href="home.html">Plan a trip</a></li>
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
                            <a href="#">
                                <img src="img/guy-3.jpg" alt="">
                            </a>
                            <h1>John Breakgrow</h1>
                            <p>@username</p>
                        </div>

                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="#"> <i class="fa fa-user"></i> News feed</a></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-envelope"></i> Messages
                                    <span class="label label-info pull-right r-activity">9</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-users"></i> People
                                    <span class="label label-info pull-right r-activity">10</span>
                                </a>
                            </li>
                            <li><a href="#"> <i class="fa fa-image"></i> Images</a></li>
                            <li><a href="#"> <i class="fa fa-folder-open"></i> Albums</a></li>
                            <li><a href="#"> <i class="fa fa-group"></i> Communities</a></li>
                            <li><a href="#"> <i class="fa fa-comment"></i> Polls</a></li>
                        </ul>
                    </div>
                </div>

                <div class="widget">
                    <div class="widget-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"> <i class="fa fa-map"></i>  Places</a></li>
                            <li><a href="#"> <i class="fa fa-calendar"></i> Events</a></li>
                            <li><a href="#"> <i class="fa fa-glass"></i> Restaurants</a></li>
                            <li><a href="#"> <i class="fa fa-car"></i> Trips</a></li>
                            <li><a href="#"> <i class="fa fa-tasks"></i> Plan your trip</a></li>
                        </ul>
                    </div>
                </div>

                <div class="widget">
                    <div class="widget-body">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"> <i class="fa fa-globe"></i> Contact us</a></li>
                            <li><a href="#"> <i class="fa fa-question-circle"></i> FAQ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!-- end left links -->


        <!-- center posts -->
        <div class="col-md-6">
            <div class="box" style=''>
                <?php include 'userfaq.php';?>


            </div>


        </div><!-- end  center posts -->

        <!-- right posts -->

    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="text-muted">  </p>
    </div>
</footer>
</body>
</html>
