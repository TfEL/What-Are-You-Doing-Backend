<?php

$theRow = $_GET['row'];

$classCode = $_GET['code'];

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
$classCode = $socket->real_escape_string(filter_var($classCode, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));

?>

<?php if ($createdClass == true) { echo "<div class='alert alert-success'><strong>Class Created!</strong> Your class was sucessfully added, you can see a list of your classes below.</div>"; } ?>

<p class="pull-right"><a class="btn btn-success" href="classes.php">My Classes</a> 
<h1>Details</h1> 

<?php

$query = "SELECT * FROM `classlist` WHERE `owner`='$userData[email_address]' AND `id`='$theRow' AND `classcode`='$classCode';";

if ($result = $socket->query($query)) {
    
     while ($row = $result->fetch_assoc()) {
         
         $timerGroups = json_decode($row['timersGroup'], true);
         
        echo "<p>Class on: " . $row['created'] . ".</p><p>Code: <code>" . $row['classcode'] . "</code></p><p>Group One:<pre>" . $row['groupOneText'] . "</pre></p><p>Group Two:<pre>" . $row['groupTwoText'] . "</pre></p><p>Group Three:<pre>" . $row['groupThreeText'] . "</pre></p>"; 
         
         $i = 1;
         
         foreach ($timerGroups[timer] as $key => $value) {
            echo "<p>Timer $i: " . $value . "</p>"; $i++;
         }
     }
    
}

create_footer();

?>