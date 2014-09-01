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

$createdReport = $_GET['created'];

$errorMessage = $_GET['failed'];

$errorMessage = htmlentities($errorMessage);

?>

<?php if ($createdReport == true) { echo "<div class='alert alert-success'><strong>Report Created!</strong> Your report was sucessfully created. You can view your report below.</div>"; } if(!empty($errorMessage)) { echo "<div class='alert alert-danger'><strong>Systemic Failure</strong> Your report was not created. $errorMessage</div>"; } ?>

<h1>My Reports</h1>

<?php

$query = "SELECT * FROM `reports` WHERE `owner`='$userData[email_address]';";

$inc = 0;
if ($result = $socket->query($query)) {
     while ($row = $result->fetch_assoc()) {
        $inc++;
        echo "<p class='pull-right'><a href='./report-view.php?row=" . $row['id'] . "&code=" . $row['classcode'] . "' class='btn btn-default'>View</a> <a href='./archive-report.php?row=" . $row['id'] . "&code=" . $row['classcode'] . "' class='btn btn-default'>Delete</a></p> <p> Report for class <code>" . $row['classcode'] . "</code> created on " . $row['reportcreated'] . ". </p> <hr>";
     }
}
if ($inc <= 0) {
    echo "<p>You haven't created any reports, yet! Archive a class, then create a report to see it here.</p>";   
} else {
    echo "<p class='text-center'><small>Delete and archive actions are final. Be sure you want to commit the action before you continue.</small></p>";
}

create_footer();

?>