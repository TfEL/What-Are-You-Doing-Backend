<?php

require '../teacher/include/autoinclude.php'; 
autoinclude();
$userData = login_verify($_COOKIE);

// @Headers
date_default_timezone_set("Australia/Adelaide");

// @Database
if (!function_exists('configure_active_database')) {
    require '../api/settings.php';
    require '../api/api.fnc.php';
    $socket = ConnectToDatabase(configure_active_database()) or die("<strong>Error:</strong> couldn't find database! Try again in a few moments.");
} else {
    $socket = ConnectToDatabase(configure_active_database()) or die("<strong>Error:</strong> couldn't find database! Try again in a few moments.");
}

// @Inref Functions
function form_return_failed() {
    echo '<script type="text/javascript"> window.location="https://wrud.tfel.edu.au/teacher/create-class.php?failed=true"; </script>';
}

function fix_time($timeString) {
    try {
        $timeString = strtotime($timeString);
        $correctTimeStamp = date("Y-m-d H:i:s", $timeString);
    } catch (Exception $e) { 
        return_failed();
    }
    return $correctTimeStamp;
}

function checkUIDIsUnique($UniqueID, $socket) {

$query = "SELECT * FROM `classlist` WHERE `id`='$UniqueID'";

$return = MakeDatabaseQuery($query, $socket);

$isRows = $result->num_rows;

    if ($isRows == 0) {
        return true;
    } else {
        return false;
    }
}

// @Getters
$dataIn = $_POST;

// @Setters
$dataClean = array();

$dataClean['publishinguser'] = $socket->real_escape_string(filter_var($dataIn['publishinguser'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES)); 
$dataClean['editing'] = $socket->real_escape_string(filter_var($dataIn['editing'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES)); 
$dataClean['topicid'] = $socket->real_escape_string(filter_var($dataIn['topicid'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES)); 
$dataClean['author'] = $socket->real_escape_string(filter_var($dataIn['author'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES)); 
$dataClean['topicid'] = $socket->real_escape_string(filter_var($dataIn['topicid'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES)); 
$dataClean['publishinguser'] = $socket->real_escape_string(filter_var($dataIn['publishinguser'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES)); 
$dataClean['title'] = $socket->real_escape_string(filter_var($dataIn['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES)); 
$dataClean['body'] = $socket->real_escape_string($dataIn['body']); 


$timeOfEntry = date("Y-m-d H:i:s", time()+4);
$email = $userData['email_address'];
$rand = UUID::v4();

if (empty($dataClean)) { form_return_failed(); }

if ($dataClean['editing'] == "true") {
    $query = "UPDATE `wrud`.`helptopics` SET `author` = '$dataClean[author]', `title` = '$dataClean[title]', `body` = '$dataClean[body]' WHERE `topicid`='$dataClean[topicid]';";
        
    $qOut = MakeDatabaseQuery($query, $socket) or die("Query error. $socket->error");
    
    if (!$qOut) { 
    form_return_failed();
    } else {
        echo '<script type="text/javascript"> window.location="https://wrud.tfel.edu.au/teacher/instructions.php?edited=true"; </script>';
    }
}

if ($dataClean['editing'] == "false") {
    $query = "INSERT INTO `wrud`.`helptopics` (`id`, `owner`, `created`, `topicid`, `author`, `title`, `body`) VALUES (NULL, '$email', '$timeOfEntry', '$rand', '$dataClean[author]', '$dataClean[title]', '$dataClean[body]');";
    
    $qOut = MakeDatabaseQuery($query, $socket) or die("Query error.");
    
    if (!$qOut) { 
    form_return_failed();
    } else {
        echo '<script type="text/javascript"> window.location="https://wrud.tfel.edu.au/teacher/instructions.php?created=true"; </script>';
    }
    
}


?>