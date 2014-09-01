<?php

require '../teacher/include/autoinclude.php'; 
autoinclude();

$userData = login_verify($_COOKIE);

if($userData['groupmember'] == true) { create_header(true);  } else { create_header(); }

?>

<h1>Welcome, <?=$userData["first_name"]?>.</h1>

<p>Thank you for registering for What are you Doing. Above you can select classes, or results.</p>

<p>To dive right in to using What are you Doing in your classroom, create a class to get a code for the app.</p>

<p>When your class is done, come back here and view the report.</p>

<p><a class="btn btn-default" href="create-class.php">Create Class</a> <a class="btn btn-default" href="results.php">View Reports</a> <a class="btn btn-default" href="settings.php">My Account</a> <a class="btn btn-default" href="../logout_format.php">Log out</a></p>

<?php

create_footer();

?>