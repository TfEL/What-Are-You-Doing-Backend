<?php

// © 2014 Department for Education and Child Development
// This exchanges the INITIAL SETUP of the xyz client.

// @Content-Types
header("Content-Type: application/json");
date_default_timezone_set("Australia/Adelaide");

// @Requires
require 'settings.php';
require 'api.fnc.php';

// @Inbound getters
$classcodeUnclean = $_GET['classcode'];
$studentidUnclean = $_GET['studentid'];
$submitteddataUnclean = $_GET['submission'];

// @Inref Functions
function return_failed($message = "Internal Error") {
    $return = array( "message" => "$message", "return" => "fail" );
    echo json_encode($return, JSON_PRETTY_PRINT);
    die();   
}

function fix_time($timeString) {
    try {
        $correctTimeStamp = date("Y-m-d H:i:s", $timeString);
    } catch (Exception $e) { 
        return_failed();
    }
    return $correctTimeStamp;
}

// Classcode Base Check
if (empty($classcodeUnclean)) { 
    return_failed("Data Missing");
} if (empty($studentidUnclean)) { 
    return_failed("Data Missing");
} if (empty($submitteddataUnclean)) { 
    return_failed("Data Missing");
} else {
    $classcode = filter_var($classcodeUnclean, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
    $studentid = filter_var($studentidUnclean, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
    $submitteddata = filter_var($submitteddataUnclean, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
}

// Try block
try { 

// @Configures
$db = configure_active_database();

// @Database hooks
$socket = ConnectToDatabase($db);

// @Query Phase One
    
// We need to figure out whether or not there is existing data (aka, this was round two from this student)    
$query = MakeDatabaseQuery("SELECT * FROM `studentlist` WHERE `classcode`=\"$classcode\" AND `studentIdentification`=\"$studentid\";", $socket) or return_failed("Internal Error: Q1");

$result = MakeDatabaseFetch($query);

if (is_null($result)) { $firstTimeEntrant = true; } else { $firstTimeEntrant = false; }
 
// @Query Phase Two

// We need to determine who's class the user is a member of, among other things from the classlist table

$query = MakeDatabaseQuery("SELECT * FROM `classlist` WHERE `classcode`=\"$classcode\" AND `archived`=\"0\"", $socket) or return_failed("Internal Error: Q2");

$result = MakeDatabaseFetch($query);

if (is_null($result)) { return_failed("Survey Error: Class has closed."); }

// Set variables we need, that we can't get from the client...
$teacherOwner = $result["owner"];
$timeSubmitted = fix_time(time()+80);

// @Query Phase Three (Build query)
$query = "INSERT INTO `wrud`.`studentlist` (`id`, `created`, `teacherOwner`, `classcode`, `studentIdentification`, `submittedKey`) VALUES (NULL, '$timeSubmitted', '$teacherOwner', '$classcode', '$studentid', '$submitteddata');";

$result = MakeDatabaseQuery($query, $socket);

if (is_null($result)) { return_failed(); }

// End Try block
} catch (Exception $e) {
    return_failed();
}

// Build the return
$return = array("message" => null, "return" => "success",);

echo json_encode($return, JSON_PRETTY_PRINT);

die();