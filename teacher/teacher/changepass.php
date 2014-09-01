<?php

require '../teacher/include/autoinclude.php'; 

autoinclude();

$userData = login_verify($_COOKIE);

if($userData['groupmember'] == true) { create_header(true);  } else { create_header(); }

?>

<h1>Change Password</h1>

<p>Enter your new password below, an email will be sent to you for confirmation.</p>

<form method="post" action="changepass_format.php">
    <input type="hidden" name="emailaddress" value="<?=$userData['email_address']?>">
    <p><input type="text" name="password" class="form-control" placeholder="yournewpassword123"></p>
    <p><button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Change Password</button></p>
</form>

<?php

create_footer();

?>