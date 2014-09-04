<?php

require "authentication_header.fnc.php";

$array = array( array("id" => "1", 
		"classcode" => "8883cc34"), 
		array("id" => "2", 
		"classcode" => "828f2c23"), );


echo json_encode($array);
