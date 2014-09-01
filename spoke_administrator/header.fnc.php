<?php

function create_header() {

echo <<<EOF

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TfEL WruD Basecamp</title>

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
	  padding-top: 20px;
	  padding-bottom: 20px;
	}

	.navbar {
	  margin-bottom: 20px;
	  background: url("/resources/header-left.gif") no-repeat #000;
	  height: 150px;
	}
	
	.navbar-right {
	   width:100%;
	   max-width: 480px;
	   height: 100%;
	   max-height: 150px;
	   right: 0px;
	   background: url("/resources/header-right.png") top right;
	   background-repeat: no-repeat;
	}
	
	.navbar-nav {
	   position: absolute;
	   bottom: 0px;
	   
	}
	
	.navbar-nav li { 
	   color: #fff;
	   max-height: 20px;
	   bottom: +14px;
	}
	.navbar-nav li a:visited, .navbar-nav li a:link { 
	   margin-left: -20px;
	   color: #fff;
	}
	a {
		color: #AF0C17;
	}
    .form-control {
        display: initial;
        max-width: 60%;
    }
	-->
	</style>

  </head>
  <body>

	<div class="container">

	<div class="navbar navbar-default" role="navigation"> 
        <div class="container-fluid">
	<div class="navbar-right"></div>
          <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
				
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>

EOF;
    
}
