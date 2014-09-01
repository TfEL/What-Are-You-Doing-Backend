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

$groupOne = "";
$groupTwo = "";
$groupThree = "";

$in = 0;
$io = 0;
$it = 0;
$cn = 0;
// @Cleaning - Sorry, this is a clusterf* - Basically data goes in, for each data it's sorted, times are corrected, and out comes clean data, grouped according to the DB tables.
foreach ($dataIn as $key => $value) {
    if (empty($value)) {
        echo "Null";
    } elseif ($key[0] == t) {
        $key = substr($key, 0, -1);
        // Hardcoding this – it's too difficult otherwise
        if ($cn == 0) {
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 1) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 2) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 3) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 4) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 5) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 6) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 7) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 8) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 9) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 11) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 12) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 13) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 14) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 15) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 16) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 17) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 18) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 19) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        } elseif ($cn == 20) { 
            $dataClean["timer"][$cn] = fix_time($value);
            $cn++;
        }
    } elseif (substr($key, 0, -2) == g1) {
        $groupOne[$in] = $socket->real_escape_string(filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES)); 
        $in++;
    } elseif (substr($key, 0, -2) == g2) {
        $groupTwo[$io] = $socket->real_escape_string(filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
        $io++;
    } elseif (substr($key, 0, -2) == g3) {
        $groupThree[$it] = $socket->real_escape_string(filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
        $it++;
    } else { 
        echo "Null";
    }
}

// @Query for code conflict
$UniqueID = UUID::v4();
$UniqueID = substr($UniqueID, 0, 8);

while (checkUIDIsUnique($UniqueID, $socket) == false) {
    $UniqueID = UUID::v4();
    $UniqueID = substr($UniqueID, 0, 8);
}
    
// @Logic...

if (empty($dataClean)) { form_return_failed(); }

$timeOfEntry = date("Y-m-d H:i:s", time()+4);
$classcodeRand = $UniqueID;
$timersJson = json_encode($dataClean);
$groupOne = json_encode($groupOne);
$groupTwo = json_encode($groupTwo);
$groupThree = json_encode($groupThree);
$email = $userData['email_address'];

$classOnName = $socket->real_escape_string(filter_var($dataIn[className], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
$classOnDate = $socket->real_escape_string(filter_var($dataIn[classDate], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));

$queryMeta = "INSERT INTO `classmeta` (`id`, `timecreated`, `classcode`, `classname`, `classdate`) VALUES (NULL, '$timeOfEntry', '$classcodeRand', '$classOnName', '$classOnDate');";

$qOut = MakeDatabaseQuery($queryMeta, $socket) or die("Query error.");

if (!$qOut) { 
    echo 'Couldn\'t create metadata';
}

$query = "INSERT INTO `classlist` (`id`, `owner`, `created`, `classcode`, `groupOneText`, `groupTwoText`, `groupThreeText`, `timersGroup`) VALUES (NULL, '$email', '$timeOfEntry', '$classcodeRand', '$groupOne', '$groupTwo', '$groupThree', '$timersJson');";    

$qOut = MakeDatabaseQuery($query, $socket) or die("Query error.");

if (!$qOut) { 
    form_return_failed();
} else {
    echo '<script type="text/javascript"> window.location="https://wrud.tfel.edu.au/teacher/classes.php?created=true"; </script>';
}

?>