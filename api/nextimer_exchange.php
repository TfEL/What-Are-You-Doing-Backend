<?php



// © 2014 Department for Education and Child Development
// This exchanges the INITIAL SETUP of the xyz client.

// @Content-Types
header("Content-Type: application/json");
date_default_timezone_set("Australia/Adelaide");

die("{\"Deprecated September 2014\"}");

// @Requires
require 'settings.php';
require 'api.fnc.php';

// @Inbound getters
$classcodeUnclean = $_GET['challenge'];
$forNotification = $_GET['notification'];
$outputAsSeconds = $_GET['convertseconds']; // Hook for iOS8

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
        return_failed();
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
    return_failed();
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
if (is_null($result)) { return_failed(); }

// End Try block
} catch (Exception $e) {
    return_failed();
}

// Build the return

$timersArray = json_decode($result['timersGroup'], true);
foreach ($timersArray as $key => $value) {
    $timersArray = $value;
}

$i = 0;
$found = 0;
foreach ($timersArray as $key => $value) {
    $timer[$i] = $value;
    if (time() < strtotime($value) && $found != 1) {
        if ($forNotification == true) {
            $return = date("Y-m-d H:i:s", strtotime($value) - 2 * 58);
        } else {
            $return = $value;
        }
        $found = 1;
    }
    $i ++;
}

if (time() > strtotime(end($timer))) {
    return_failed("All the timers for this class are in the past.");
} else {

    if($outputAsSeconds == "true") {
        $seconds = strtotime($return) - time();
    }
    
$groupOneArray = json_decode($result['groupOneText'], true);
$groupTwoArray = json_decode($result['groupTwoText'], true);
$groupThreeArray = json_decode($result['groupThreeText'], true);

if ($outputAsSeconds == "true") {
    $return = array( "classcode" => $result['classcode'], 
                "nexttime" => $return, 
                "nextinsec" => $seconds,
                "message" => null,
                "return" => "success", ); 
} else {
$return = array( "classcode" => $result['classcode'], 
                "nexttime" => $return, 
                "message" => null,
                "return" => "success", );
}

echo json_encode($return, JSON_PRETTY_PRINT);

}
   
die();