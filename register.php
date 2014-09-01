<?php
$ssl = $_GET['ssl'];
$failed = $_GET['failed'];

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
              <li><a href="/">Home</a></li>
              <li><a href="/login.php">Login</a></li>
              <li><a href="/register.php">Register</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
				
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>
    <div class="container">
	<h1 style="color: #ec5945;">Teacher Registration</h1>
    <p>You're on the right track to get started with What are you Doing. Register here to begin!</p>
    <p>Please be aware, you will need an email address ending in @schools.sa.edu.au or @sa.gov.au to use this service. Some other email extensions are listed on <a href="/email_list.php">this page</a>.</p>
    <div style="max-width: 350px; margin-left:auto; margin-right:auto;">
        <?php if($failed ==true) { echo '<br /><div class="alert alert-warning" role="alert"><p><strong>Oops:</strong> something didn\'t work, please try again.</p></div>'; } ?>
        <form action="register_format.php" method="post">
            <p><strong>Site Name:</strong><input type="text" name="decdsite" placeholder="DECD Site" class="form-control" required> <small>If your site has an account we will attempt to attach you to it, don't worry, only data you choose to share will be shared.</small></p>
            <p><strong>Your First Name:</strong><input type="text" name="firstname" placeholder="First Name" class="form-control" required> <small>We only need your first name so we know who to say hello to when you login.</small></p>
            <p><strong>Email Address:</strong><input type="email" name="emailaddress" placeholder="firstname.lastname123@schools.sa.edu.au" class="form-control" required><small>We hate spam as much as you do. You will be able to opt-in to a low-traffic mailing list once your registration is complete. No pesky unwanted messages here!</small></p>
            <p><strong>Password:</strong><input type="password" name="password" placeholder="password123" class="form-control" required> <small>Make it a good one, contrary to popular belief, your password doesn't have to be some crazy assortment of symbols - just long, and unique.</small></p>
            <p class="text-center"><button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-ok"></span> Register</button><div class="clearfix"></div></p>
        </form>
    </div>

	<div class="pull-right"><img src="/resources/NEALS_small_greyscale.jpg" height="32px"></div>
	<p><small>&copy; 2014 Department for Education and Child Development. <a href="mailto:DECD.Tfel@sa.gov.au">Contact</a>. <abbr title="Schools may wish to setup local versions of TfEL sites, you might also need to distribute our apps on multiple iPads, etc.">Developer</abbr> <a href="mailto:aiden.cornelius@sa.gov.au">contact</a>.</small></p>

	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/teacher/js/bootstrap.min.js"></script>
  </body>
</html>
