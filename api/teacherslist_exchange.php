<?php

require "authentication_header.fnc.php";

$array = array( array("id" => "1", 
		"email" => "example@example.com",
		"password" => "example"), 
		array("id" => "2", 
		"email" => "example2@example.com", 
		"password" => "password2"), );


echo json_encode($array);
