<?php

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

?>

<h1><?=$userData["site_school"]?></h1>

<p>Welcome to the <?=$userData["site_school"]?> group. Invite people from your site to join this group using this code <code><?=$userData["groupcode"]?></code>.</p>

<h3>Shared Reports</h3>
<?php

$query = "SELECT * FROM `reports` WHERE `isshared`='1' AND `withgroup`='$userData[groupcode]';";


$inc = 0;
if ($result = $socket->query($query)) {
    
     while ($row = $result->fetch_assoc()) {
         $inc++;
         echo "<p>Report from $row[owner]. Created $row[reportcreated]. <a href='https://wrud.tfel.edu.au/teacher/report-view.php?row=$row[id]&code=$row[classcode]'>View?</a></p>";
     }
}

if ($inc == 0){ 
?>   

<p>No one in your group has shared any reports yet.</p>

<?php
}
create_footer();

?>