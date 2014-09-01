<?php

require './api/settings.php';
require './api/api.fnc.php';

if(isset($_COOKIE['loginStamped'])) { header("Location: https://wrud.tfel.edu.au/teacher/"); }

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
	<h1 style="color: #ec5945;">What are you Doing Basecamp</h1>
	<p class='lead' style="color: #fdbc3c;">Login or signup to use What are you Doing below</p>
    <p>First things first, <strong>register for an account</strong>, then, once you've logged in sucessfully you'll be able to view the instructions for setting up.</p>
	<p>What are you Doing is an application designed to arbitrarily measure student engagement in TfEL classrooms.</p>
    <h3>Requirements</h3>
    <ul>
        <li>At least one iPad 2 (or above)</li>
        <li>Running iOS 7.1 (or above)</li>
        <li>An <abbr title="Special exceptions can be made, please contact us below for help.">approved email address</abbr> see <a href="email_list.php">the list here</a></li>
        <li>A computer running Mac OS X 10.5+ or Windows XP+ or an iPad</li>
        <li>Reccomended: Google Chrome 30+, Apple Safari 6+</li>
        <li>Network access to https://wrud.tfel.edu.au, or a <a href="https://wrud.tfel.edu.au/site_version.php">SPOKE server</a></li>
    </ul>
    <h3>Actions</h3>
	<ul><li><a href="https://wrud.tfel.edu.au/register.php">Register</a></li>
	    <li><a href="https://wrud.tfel.edu.au/login.php">Login</a></li>
        <li><a href="https://wrud.tfel.edu.au/site_version.php">Site Version</a></li></ul>
	<div class="pull-right"><img src="/resources/NEALS_small_greyscale.jpg" height="32px"></div>
	<p><small>&copy; 2014 Department for Education and Child Development. <a href="mailto:DECD.Tfel@sa.gov.au">Contact</a>. <abbr title="Schools may wish to setup local versions of TfEL sites, you might also need to distribute our apps on multiple iPads, etc.">Developer</abbr> <a href="mailto:aiden.cornelius@sa.gov.au">contact</a>.</small></p>

	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/teacher/js/bootstrap.min.js"></script>
  </body>
</html>
