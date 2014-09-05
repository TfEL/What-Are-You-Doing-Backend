<?php

// © 2014 Department for Education and Child Development

// Private API, so call the authentication header...
require "authentication_header.fnc.php";

// @Content-Types
header("Content-Type: application/json");
date_default_timezone_set("Australia/Adelaide");

// @Requires
require 'settings.php';
require 'api.fnc.php';

// @Inbound getters
$teacherIdentifier = $_GET['challenge'];  // *** Unused at this time, needs fixing.
$administrationMode = $_GET['allclasses'];

// @Inbound cleanup
$teacherIdentifier = filter_var($teacherIdentifier, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
$administrationMode = filter_var($administrationMode, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

// @Inref Functions
function return_failed($message = null) {
    if (!is_null(message)) {
		// We don't need the message if we're not debugging, but hey just echo $message;.
		die();
	} else {
		die();
	}
}

// Begin the features of this exchange...

try { 
	$db = configure_active_database();
	$socket = ConnectToDatabase($db);
	$result = MakeDatabaseQuery("SELECT * FROM `classlist` WHERE `archived`='0';", $socket) or return_failed();
} catch (Exception $e) {
    return_failed("(DB Exception) $e");
}

$i = 0;

$array = array();

foreach ($result as $key => $value) { 
	array_push($array, array ("id" => $i,
	 						"classcode" => $value["classcode"]));
	$i++;
}

echo json_encode($array);
