<?php
$ssl = $_GET['ssl'];

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
	<h1 style="color: #ec5945;">Site Version</h1>
        <p>There is a site version available to allow schools to set up a WruD basecamp spoke on their intranet. This means that younger students, or students that do not have internet access may still use the app. Consult with your network administrator to determine if this is possible on your site.</p>
        <h2>Network Administrators</h2>
        <p>Requirements for WruD spoke:</p>
        <ul><li>Either: Mac OS X 10.6+ OR Linux k2.4+ OR Windows 2008+</li>
            <li>Or: an appliance/server with PHP-CGI 5.4+ or Rails 4+</li>
            <li>A dedicated (static) intranet IP</li>
            <li>At least one free port - usually :8000</li>
            <li>Access outbound port 3306 and ext-silk02.aueast.tfel.edu.au</li>
            <li>For updates, access to https (443) access to spokeupdate.wrud.tfel.edu.au</li>
        </ul>
        <p>Executing the server - Linux / Mac:</p>
        <ul><li><code>php -S my-ip-address-or-hostname:8000</code></li>
            <li><code>rails server -p 8000</code> a webrick proxy is required</li></ul>
        <p>Executing the server - Windows:</p>
        <ul><li>Open PowerShell in the `dist` folder <code>php -S my-ip-address-or-hostname:8000</code></li>
            <li>Execute <code>rails_bundle.exe</code></li></ul>
        <p>We have found it is most useful for sites to use PHP, as the PHP server doesn't require a proxy (via Apache, etc). At this time the server you choose must have unrestricted access to ext-silk02.aueast.tfel.edu.au:3306 in order to communicate with your spoke database. </p>
        <p>Existing spoke users: <a href="/spoke_administrator/" class="btn btn-sm btn-success">Log In</a> <small>(this is not the same as your WruD login)</small></p>
        <p>To obtain a copy of the WruD basecamp spoke please contact <a href="mailto:aidan.cornelius@sa.gov.au">aidan.cornelius@sa.gov.au</a>.</p>
	<div class="pull-right"><img src="/resources/NEALS_small_greyscale.jpg" height="32px"></div>
	<p><small>&copy; 2014 Department for Education and Child Development. <a href="mailto:DECD.Tfel@sa.gov.au">Contact</a>. <abbr title="Schools may wish to setup local versions of TfEL sites, you might also need to distribute our apps on multiple iPads, etc.">Developer</abbr> <a href="mailto:aiden.cornelius@sa.gov.au">contact</a>.</small></p>

	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/teacher/js/bootstrap.min.js"></script>
  </body>
</html>
