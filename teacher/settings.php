<?php

$errormessage = $_GET['failed'];
$changemessage =  $_GET['register'];
$successmessage =  $_GET['success'];


require '../teacher/include/autoinclude.php'; 
autoinclude();

$userData = login_verify($_COOKIE);

if($userData['groupmember'] == true) { create_header(true);  } else { create_header(); }

if ($errormessage == true) { echo '<div class="alert alert-warning" role="alert"><p><strong>Oops:</strong> something went wrong. Please try again.</p></div>'; }
if ($changemessage == true) { echo '<div class="alert alert-success" role="alert"><p><strong>Success:</strong> please check your email to confirm your password change.</p></div>'; }
if ($successmessage == true) { echo '<div class="alert alert-success" role="alert"><p><strong>Success:</strong> your password has been changed.</p></div>'; }

?>

<h1>My Account</h1>

<p><strong>First Name:</strong> <?=$userData["first_name"]?></p>
<p><strong>DECD Site:</strong> <?=$userData["site_school"]?></p>
<?php if($userData['groupmember'] == true) { ?><p><strong>Verified Group:</strong> <?=$userData["groupcode"]?> <span class="glyphicon glyphicon-ok"></span></p><?php } ?>
<p><strong>Email Address:</strong> <?=$userData["email_address"]?></p>
<p><strong>Password:</strong> <?php  echo substr($userData["user_password"], 0, -6) . "&middot;&middot;&middot;&middot;"; ?></p>

<p><?php if ($userData['groupmember'] == false) { ?><a href="joinsite.php" class="btn btn-default">Join your Site</a><?php } else { ?> <a href="group.php" class="btn btn-default">Share Class Data</a><?php } ?> <a href="changepass.php" class="btn btn-default">Change Password</a></p>

<?php

create_footer();

?>