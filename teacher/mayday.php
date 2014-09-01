<?php

require '../teacher/include/autoinclude.php';

autoinclude();

$userData = login_verify($_COOKIE);

$mode = $_GET['mode'];

if($userData['groupmember'] == true) { create_header(true);  } else { create_header(); }

if ($mode == "edit") {
    $edit = true;
    $instruction = $_GET['instruction'];
}

if (!function_exists('configure_active_database')) {
    require '../api/settings.php';
    require '../api/api.fnc.php';

    $socket = ConnectToDatabase(configure_active_database()) or die("<strong>Error:</strong> couldn't find database! Try again in a few moments.");
} else {
    $socket = ConnectToDatabase(configure_active_database()) or die("<strong>Error:</strong> couldn't find database! Try again in a few moments.");
}

?>

<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>

<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
</script>

<h1>Mayday</h1>
<p>Mayday is an integrated help and support system, allowing teachers to get support in their use of What are you Doing.</p>

<div class="well well-sm">Client Communication Issues &mdash; Ticket submitted 17/07/2014 &mdash; One answer available.</div>

<form method="post" action="topic_format.php" enctype="application/x-www-form-urlencoded">
    <input type="hidden" name="publishinguser" value="<?=$userData[email_address]?>">
    <input type="hidden" name="editing" value="false">
<p><strong>Title</strong> <br>
<input type="text" name="title" placeholder="Title" class="form-control"></p>
<p><strong>Topic</strong> <br>
<select name="topic" class="form-control"><option value="">Client Support (iOS App)</option><option value="">Teacher Interface Support</option><option value=""></option><option value=""></option></select></p>
<p><strong>Attach a screenshot</strong> <br>
<input name="screenshot" type="file"></p>
<p><strong>Body</strong>
<textarea name="body" placeholder="Body text"></textarea> </p>

<p>We will also attach information such as your email address, your DECD Site, and your current classes.<br>If you wish to remain anonymous, and submit this ticket for feedback purposes only, check here: <input name="anonymous" type="checkbox"></p>

<button type="submit" class="btn btn-success">Send Request</button>

</form>

<?php

create_footer();

?>
