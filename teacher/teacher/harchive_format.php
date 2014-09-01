<?php

$theRow = $_GET['row'];

require '../teacher/include/autoinclude.php'; 

autoinclude();

$userData = login_verify($_COOKIE);

if($userData['groupmember'] == true) { create_header(true);  } else { create_header(); }

if (!function_exists('configure_active_database')) {
    require '../api/settings.php';
    require '../api/api.fnc.php';
        
    $socket = ConnectToDatabase(configure_active_database()) or die("<strong>Error:</strong> couldn't find database! Try again in a few moments.");
} else {
    $socket = ConnectToDatabase(configure_active_database()) or die("<strong>Error:</strong> couldn't find database! Try again in a few moments.");
}

$theRow = $socket->real_escape_string(filter_var($theRow, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));

?>

<?php if ($createdClass == true) { echo "<div class='alert alert-success'><strong>Class Created!</strong> Your class was sucessfully added, you can see a list of your classes below.</div>"; } ?>

<h1>Delete Topic</h1> 

<?php

$query = "DELETE FROM `wrud`.`helptopics` WHERE `helptopics`.`id` = $theRow;";

$return = MakeDatabaseQuery($query, $socket);

if (!$return) { 
    echo "<div class='alert alert-warning' role='alert'><p><strong>Oops</strong> couldn't delete that at this time, maybe it's already deleted?</p></div> <p class='text-center'><a href='instructions.php' class='btn btn-lg btn-warning'><span class='glyphicon glyphicon-remove'></span> Back to Help Topics</a></p>";
} else {
    echo "<div class='alert alert-success' role='alert'><p><strong>Deleted successfully.</strong> No further action required.</p></div> <p class='text-center'><a href='instructions.php?archives=detail' class='btn btn-lg btn-success'><span class='glyphicon glyphicon-ok'></span> Back to Help Topics</a></p>"; 
}

create_footer();

?>