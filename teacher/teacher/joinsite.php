<?php

require '../teacher/include/autoinclude.php'; 

autoinclude();

$userData = login_verify($_COOKIE);

if($userData['groupmember'] == true) { create_header(true);  } else { create_header(); }

$successmessage = false;

$successmessage =  $_GET['success'];
$prefill = $_GET['prefill'];
$prefillfor = $_GET['prefillfor'];

if ($successmessage == true) { echo '<div class="alert alert-success" role="alert"><p><strong>Success:</strong> you are now a member of that site.</p></div>'; }

if ($prefill == true) {
    if (!empty($prefillfor)) {
        if ($prefillfor == "flinders") {
            $pf = true;
            $pfv = "f328d117-45ec-4c77-b7d6-2d3d6ff3cdec";
        }
        if ($prefillfor == "tls") {
            $pf = true;
            $pfv = "f780c197-3bb4-4deb-8776-54bc4820a4e4";
        }
        if ($prefillfor == "bisp") {
            $pf = true;
            $pfv = "4b05793d-0085-4f37-970d-1a2cfbdc3921";
        }
    }
}
?>

<h1>Join Your Site</h1>

<p><?php if ($successmessage == false) {?>Enter your Site code below, if you don't have one – request one <a href="mailto:aidan.cornelius@sa.gov.au">here</a>.</p>

<form method="post" action="joinsite_format.php">
    <input type="hidden" name="emailaddress" value="<?=$userData['email_address']?>"></input>
    <p><input type="text" name="sitecode" class="form-control" placeholder="aa00a000-0aa0-0aaa-0000-00aa0000a0a0 " <?php if ($pf == true) { ?> value="<?=$pfv?>" <?php } ?>></input></p>
    <p><button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Join Site</button><?php } ?></p>
</form>

<?php

create_footer();

?>