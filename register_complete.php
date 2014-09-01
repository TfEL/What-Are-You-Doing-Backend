<?php
$ssl = $_GET['ssl'];
$stage = $_GET['ex'];

if ($ssl == false) {
	//header("Location: https://www.tfel.edu.au/?ssl=true");
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>What are you Doing - Basecamp</title>

    <!-- Bootstrap -->
    <link href="/teacher/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style type="text/css">
	<!--
	body {
	  padding-top: 0px;
	  padding-bottom: 20px;
	}
        
    .header  {
      margin-top:0px;
      margin-bottom: 0px;
	  background: #80cac9;
      background-size: contain;
	  height: 150px;
    }
    .header img { 
        max-width:600px;
    }
        
    .navbar { 
        width:100%;
        border:0px;
    }
    .container-fluid {
        max-width: 1220px;  
    }
    .navbar-nav a:hover {
        color: #fdbc3c !important;
    }
	a {
		color: #ec5945;
	}
	-->
	</style>

  </head>
  <body>
    <div class="header">
        <div class="container-fluid">
            <img src="/resources/wrud_banner.png">
        </div>
      </div>
	<div class="navbar navbar-default" role="navigation"> 
        <div class="container-fluid">
	<div class="navbar-right"></div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="https://wrud.tfel.edu.au/">Home</a></li>
              <li><a href="https://wrud.tfel.edu.au/login.php">Login</a></li>
              <li><a href="https://wrud.tfel.edu.au/register.php">Register</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
				
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>
    <div class="container">
	<h1 style="color: #ec5945;">Registering, next steps...</h1>
    <?php if ($stage == ":nil") { ?> <p><strong>You're ready to go!</strong> Your account has been sucesfully activated, and you can now log in.</p> <p class="text-center"><a href="/login.php" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-log-in"></span> Log In</a></p> <?php } else { ?> <p><strong>Great!</strong> You've completed step one of the registration process.</p> <p>Now head to your <a href="//www.outlook.com" target="_blank">LearnLink</a> or <a href="https://statemail.sa.gov.au/OWA" target="_blank">State Mail</a> inbox and click the verification link we just sent you.</p> <p>If you don't get the message, make sure to check your spam folder.</p> <p>If it has been more than 30 minutes and you still haven't heard anything, try registering again, or, <a href="mailto:DECD.Tfel@sa.gov.au">contact us</a>.</p> <p>You can safely close this page, your progress so far is saved.</p> <?php } ?>    
	<div class="pull-right"><img src="/resources/NEALS_small_greyscale.jpg" height="32px"></div>
	<p><small>&copy; 2014 Department for Education and Child Development. <a href="mailto:DECD.Tfel@sa.gov.au">Contact</a>. <abbr title="Schools may wish to setup local versions of TfEL sites, you might also need to distribute our apps on multiple iPads, etc.">Developer</abbr> <a href="mailto:aiden.cornelius@sa.gov.au">contact</a>.</small></p>

	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/teacher/js/bootstrap.min.js"></script>
  </body>
</html>
