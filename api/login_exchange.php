<?php

// Teacher Registration for WruD
// © 2014 Department for Education and Child Development

// @Requries - uses the settings from the API for centralisation
require 'settings.php';
require 'api.fnc.php';
require "authentication_header.fnc.php";

// @Headers
date_default_timezone_set("Australia/Adelaide");

// @Setters
$db = configure_active_database();
$socket = ConnectToDatabase($db) or die("<strong>Error:</strong> couldn't find database! Try again in a few moments.");

// @Getters
$cleanData = array();
$cleanData['emailaddress'] = $socket->real_escape_string(filter_var($_POST['emailaddress'], FILTER_VALIDATE_EMAIL));
$cleanData['password'] = $socket->real_escape_string(filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));

// @Inref Functions
function return_failed($message = "Login failed, please check your details and try again.") {
    if (!is_null(message)) {
        $return = array( "message" => "$message", "return" => "fail" );
    } else {
        $return = array( "return" => "fail" );
    }
    echo json_encode($return, JSON_PRETTY_PRINT);
    die();   
}
function fix_time($timeString) {
    try {
        // COOKIE TIME FIXER!!!!!
        $correctTimeStamp = date("l, d-M-Y H:i:s T", $timeString);
    } catch (Exception $e) { 
        return_failed();
    }
    return $correctTimeStamp;
}

// @Build Query

$safeQuery = "SELECT * FROM `teachers` WHERE `emailaddress`='$cleanData[emailaddress]' AND `password`='$cleanData[password]';";

// @Insert New User

try {
    $result = MakeDatabaseQuery($safeQuery, $socket) or return_failed();
    
    $isRows = $result->num_rows;
    
    if ($isRows == 0) { 
        // Nothing came back in the query.
        return_failed();
    } else {
        // There was a result...
        $returnKeys = MakeDatabaseFetch($result, $socket);
        if ($returnKeys[emailaddress] == $cleanData[emailaddress]) {
            if ($returnKeys[password] == $cleanData[password]) {
                // Vaid user.
                
                $time = fix_time(time()+9000);
                
                $return = array( "emailAddress" =>  $returnKeys[emailaddress],
 								 "firstName" => $returnKeys[firstname],
 								 "password" => $returnKeys[password], );
				echo json_encode($return, JSON_PRETTY_PRINT);
				
            } else {
                return_failed();
            }
        } else {
            return_failed();
        }
    }
    
    if (!result) {
        return_failed();
        die();
    }
} catch (Exception $e) {
    return_failed();
    die();
} 
