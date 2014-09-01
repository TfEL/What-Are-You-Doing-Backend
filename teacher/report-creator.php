<?php

// REPORT DATA REAPER
// © 2014 Department for Education and Child Development

$theRow = $_GET['row'];

$classCode = $_GET['code'];

require '../teacher/include/autoinclude.php'; 

autoinclude();

$userData = login_verify($_COOKIE);

if (!function_exists('configure_active_database')) {
    require '../api/settings.php';
    require '../api/api.fnc.php';
        
    $socket = ConnectToDatabase(configure_active_database()) or die("<strong>Error:</strong> couldn't find database! Try again in a few moments.");
} else {
    $socket = ConnectToDatabase(configure_active_database()) or die("<strong>Error:</strong> couldn't find database! Try again in a few moments.");
}

$theRow = $socket->real_escape_string(filter_var($theRow, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
$classCode = $socket->real_escape_string(filter_var($classCode, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
$owner = $userData[email_address];

if ($userData[groupmember] == true) {
    $groupmem = true;
    $groupcode = $userData[groupcode];
} else {
    $groupmem = false;
    $groupcode = null;
}

// @ Functions

// BUILD STUDENT FUNCTION - PRAGMA MARK ================================================================
// Example Usage build_student($row['studentIdentification'], "1", $row['submittedKey'], $studentarray);
// Returns: $student, {'student_identification':'rand','1':'1:4','2':'3:5', ...} 
function build_student($studentid, $appendtimer, $theresult, $student = null) {
    if (empty($studentid) || empty($theresult)) {
        return false;   
    }
    // Determine some stuff,
    if (is_null($student) || empty($student)) { 
        // New student
        //var_dump($student);
        $student[$studentid] = array( $appendtimer => $theresult, );
    } else { 
        // Existing student
        //var_dump($student);
        $student[$studentid][$appendtimer] = $theresult;
    }
    return $student;
}
// BUILD STUDENT FUNCTION - PRAGMA MARK ================================================================

// CONVERT TO NUMERIC - PRAGMA MARK ====================================================================
function convert_to_numeric($array) { 
    $inc=0;
    $return = array();
    foreach ($array as $key => $val) {
        $return[$inc] = $val;
        $inc++;
    }
    return $return;
}
// CONVERT TO NUMERIC - PRAGMA MARK ====================================================================

// STRETCH TIME FUNC - PRAGMA MARK ====================================================================
function stretch_time ($timeArray) { 
    $return = array();
    $ix = 0;
    $i = 0;
    foreach ($timeArray as $key => $value) {
        if ($i == 1) {
            $to = $value;
            $return[$ix]['from'] = $previous;
            $return[$ix]['to'] = $to;
            $i--;
            $ix++;
        }
        if ($i == 0) {
            $previous = $value;
            if (empty($previous)) { 
                echo "1";   
            }
            $i++;
        }
        $to = $value;
    }
    
    $return = array_reverse($return, false);
    
    $ss = $ix - 1;
    
    $return[$ix]['from'] = "2014-01-01 12:00:00"; 
    $return[$ix]['to'] = $return[$ss]['from'];
    
    $ix++;
        
    $return = array_reverse($return, false);
    
    $ss = $ix - 1;
    
    $return[$ix]['from'] = $return[$ss]['to'];
    $return[$ix]['to'] = date("Y-m-d H:i:s", time()+3600);
    
    return $return;
}
// STRETCH TIME FUNC - PRAGMA MARK ====================================================================


function return_gracefully_failed($error = false) {
    if($error != false) {
        $em = htmlentities($error);
    } else { 
        $em = false;
    }
    header("Location: /teacher/results.php?failed=$em");
    die($error);
}

function fix_time($timeString) {
    if ( empty($timeString) ) {
        return false;   
    }
    try {
        $correctTimeStamp = date("Y-m-d H:i:s", strtotime($timeString));
    } catch (Exception $e) { 
        return_gracefully_failed();
    }
    return $correctTimeStamp;
}

function foreach_any($array, $function) { 
    $i = 0;
    foreach ($array as $key => $value) {
        $return[$i] = call_user_func($function, $value);
        $i++;
    }
    return $return;
}


function get_results_for_times($timesArray, $classCode, $owner, $socket) {
    $i = 0;
    $students = array();
    foreach ($timesArray as $key=>$value) {        
        // Build a query
        $query = "SELECT * FROM `studentlist` WHERE `classcode`='$classCode' AND `teacherOwner`='$owner' AND `created` BETWEEN '$value[from]' AND '$value[to]';";
        // Make a query
        $result = MakeDatabaseQuery($query, $socket);
        
        while ($row = $result->fetch_assoc()) {
            $studentid = $row["studentIdentification"];
            $appendtimer = $value[from];
            $theresult = $row["submittedKey"];
            $students = build_student($studentid, $appendtimer, $theresult, $students);
            $i++;
        }
    }
    return $students;
}

// @ Query One - This info just needs to 'exist'

//This gets the class from the `classlist` table
$query = "SELECT * FROM `classlist` WHERE `classcode`='$classCode' AND `id`='$theRow' AND `owner`='$owner';";
$classResult = MakeDatabaseFetch(MakeDatabaseQuery($query, $socket));

// Now we have: id, owner, created, classcode, (ARRS) groupOneText, groupTwoText, groupThreeText, timersGroup, archived

// Arbritrarily throw out bad query
if ($classResult['archived'] == 0) {
    return_gracefully_failed("That class isn't archived or doesn't exist.");
}

//Turn our groups into actuals
$groupOneArray = json_decode($classResult[groupOneText], true);
$groupTwoArray = json_decode($classResult[groupTwoText], true);
$groupThreeArray = json_decode($classResult[groupThreeText], true);

// Turn timers back into survey times
$surveyTimesArray = convert_to_numeric(json_decode($classResult[timersGroup], true));
//$surveyTimesArray = $surveyTimesArray['timer'];

foreach ($surveyTimesArray as $key => $value) { 
    $surveyTimesArray = $value;   
}

// Now we have: groupOne[0-6], groupTwo[0-6], groupThree[0-6], surveyTimes[0-9].

// Fix-er-upper the time (not that it should be wrong anyway, but verification)
$surveyTimesArray = foreach_any($surveyTimesArray, "fix_time");

// Stretch time.... #timetravel #yolo
$surveyTimesArray = stretch_time($surveyTimesArray);

// Now we have results for 'times' ranges (aren't we fancy!)
$students = get_results_for_times($surveyTimesArray, $classCode, $owner, $socket);

// Make some arrays json...
$students = json_encode($students);
$groupOneArray = json_encode($groupOneArray);
$groupTwoArray = json_encode($groupTwoArray);
$groupThreeArray = json_encode($groupThreeArray);
$reportcreated = date("Y-m-d H:i:s", time());

// Construct a query for the reports table...
$query = "INSERT INTO `wrud`.`reports` (`id`, `owner`, `classcode`, `reportcreated`, `isshared`, `withgroup`, `studentsarray`, `groupOneArray`, `groupTwoArray`, `groupThreeArray`) VALUES (NULL, '$owner', '$classCode', '$reportcreated', '0', '$groupcode', '$students', '$groupOneArray', '$groupTwoArray', '$groupThreeArray');";

$return = MakeDatabaseQuery($query, $socket);

if (!$return) {
    die();
    return_gracefully_failed("Database query failed.");
}

// Cleanup time...
$return = MakeDatabaseQuery("DELETE FROM `studentlist` WHERE `classcode`='$classCode';", $socket);
if (!$return) { return_gracefully_failed("Database query failed on cleanup."); }
$return = MakeDatabaseQuery("DELETE FROM `classlist` WHERE `classcode`='$classCode';", $socket);
if (!$return) { return_gracefully_failed("Database query failed on cleanup."); }

header("Location: /teacher/results.php?created=true");

?>