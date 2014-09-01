<?php

$showArchives = $_GET['archives'];

$createdClass = $_GET['created'];

$error = $_GET['failed'];

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

<?php if ($createdClass == true) { echo "<div class='alert alert-success'><strong>Class Created!</strong> Your class was sucessfully added, you can see a list of your classes below.</div>"; } ?>

<?php if ($error == true) { echo "<div class='alert alert-danger'><strong>Class creation failed.</strong> Please try again. If this keeps happening, try using Google Chrome or an iPad to setup a class.</div>"; } ?>


<p class="pull-right"><a class="btn btn-success" href="create-class.php">Create Class</a> <?php if ($showArchives == "detail") { ?> <a href="classes.php" class="btn btn-info">Show Current</a> <?php } else { ?> <a href="classes.php?archives=detail" class="btn btn-info">Show Archives</a> <?php } ?></p>

<h1>My Classes</h1>  <div class="clearfix"></div>

<?php

if ($showArchives == true) {
    $query = "SELECT * FROM `classlist` WHERE `owner`='$userData[email_address]';";
} else {
    $query = "SELECT * FROM `classlist` WHERE `owner`='$userData[email_address]' AND `archived`='0';";
}

$inc = 0;
if ($result = $socket->query($query)) {
    
     while ($row = $result->fetch_assoc()) {
         $inc++;
         if ($row['archived'] == true) { 
             $stunumquery = "SELECT * FROM `classmeta` WHERE `classcode`='$row[classcode]';";
             $snuminc = 0;
             if ($stunumresult = $socket->query($stunumquery)) {
                while ($student = $stunumresult->fetch_assoc()) {
                    $snuminc++;
                }
             }
             
             
                          echo "<p class='pull-right'><a href='./detail-view.php?row=" . $row['id'] . "&code=" . $row['classcode'] . "' class='btn btn-default' class='btn btn-default'>Details</a> <a href='./report-creator.php?row=" . $row['id'] . "&code=" . $row['classcode'] . "' class='btn btn-default' class='btn btn-default'>Create Report</a></p> <p style='color:#ccc'> Class on " . $row['created'] . ". Code <code>" . $row['classcode'] . "</code>. <span class=\"label label-default\"><abbr title=\"Students\">$snuminc</abbr></span><hr>";

         } else {
             $query = "SELECT * FROM `classmeta` WHERE `classcode`='$row[classcode]';";
             $qOut = MakeDatabaseQuery($query, $socket);
             $fetch = MakeDatabaseFetch($qOut);
             
             echo "<p class='pull-right'><a href='./detail-view.php?row=" . $row['id'] . "&code=" . $row['classcode'] . "' class='btn btn-default'>Details</a> <a href='./archive-view.php?row=" . $row['id'] . "&code=" . $row['classcode'] . "' class='btn btn-default'>Archive</a></p> <p> Class on " . $fetch['classdate'] . ". " . $fetch['classname'] . ".  Code <code>" . $row['classcode'] . "</code><hr>";
         }
     }
}
if ($inc <= 0) {
    echo "<p>You don't have any classes, yet! Create one above.</p>";   
} else {
    echo "<p class='text-center'><small>Delete and archive actions are final. Be sure you want to commit the action before you continue.</small></p>";
}

create_footer();

?>