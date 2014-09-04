<?php

require "authentication_header.fnc.php";

$array = array( 1 => array("id" => "1", 
		"email" => "example@example.com",
		"password" => "example"), 
		2 => array("id" => "2", 
		"email" => "example2@example.com", 
		"password" => "password2"), );


echo json_encode($array);
