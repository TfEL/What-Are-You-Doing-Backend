<?php

// © 2014 Department for Education and Child Development
// This exchanges the INITIAL SETUP of the xyz client.

// @Content-Types
header("Content-Type: text/plain");
date_default_timezone_set("Australia/Adelaide");

// @Requires
require 'settings.php';
require 'api.fnc.php';

// @Inbound getters
$classcodeUnclean = $_GET['challenge'];

// @Inref Functions
function return_failed($message = null) {
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
        $correctTimeStamp = date("Y-m-d H:i:s", $timeString);
    } catch (Exception $e) { 
        return_failed("Couldn't adjust the time for that timer. Your teacher may need to set up this class again.");
    }
    return $correctTimeStamp;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

// Classcode Base Check
if (empty($classcodeUnclean)) { 
    return_failed("Class code has unsafe data. Please enter it again.");
} else {
    $classcode = filter_var($classcodeUnclean, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
}

// Try block
try { 

// @Configures
$db = configure_active_database();

// @Database hooks
$socket = ConnectToDatabase($db);

// @Query
$query = MakeDatabaseQuery("SELECT * FROM `classlist` WHERE `classcode`=\"$classcode\" AND `archived`='0';", $socket) or return_failed();

// @Result
$result = MakeDatabaseFetch($query);

// Make sure there IS a result...
if (is_null($result)) { return_failed("No class matched that key, try typing it again."); }

// End Try block
} catch (Exception $e) {
    return_failed("No class matched that key. (DB Exception)");
}

// Build the return

$timersArray = json_decode($result['timersGroup'], true);
foreach ($timersArray as $key => $value) {
    $timersArray = $value;
}

$i = 0;
foreach ($timersArray as $key => $value) {
    $timer[$i] = $value;
    $i ++;
}

if (time() > strtotime($timer[0])) {
    return_failed("This class has already started. Your teacher needs to set up a new class.");
} else {

$groupOneArray = json_decode($result['groupOneText'], true);
$groupTwoArray = json_decode($result['groupTwoText'], true);
$groupThreeArray = json_decode($result['groupThreeText'], true);

$return = array( "classcode" => $result['classcode'], 
                "groupOneText" => "A: $groupOneArray[0] \nB: $groupOneArray[1] \nC: $groupOneArray[2] \nD: $groupOneArray[3] \nE: $groupOneArray[4] \nF: $groupOneArray[5] \nG: $groupOneArray[6]", 
                "groupTwoText" => "A: $groupTwoArray[0] \nB: $groupTwoArray[1] \nC: $groupTwoArray[2] \nD: $groupTwoArray[3] \nE: $groupTwoArray[4] \nF: $groupTwoArray[5] \nG: $groupTwoArray[6]", 
                "groupThreeText" => "A: $groupThreeArray[0] \nB: $groupThreeArray[1] \nC: $groupThreeArray[2] \nD: $groupThreeArray[3] \nE: $groupThreeArray[4] \nF: $groupThreeArray[5] \nF: $groupThreeArray[6]",                 
                "firstTimer" => $timer[0],
                "studentIdentification" => generateRandomString(),
                "message" => null,
                "return" => "success", );

echo json_encode($return, JSON_PRETTY_PRINT);

}
   
die();