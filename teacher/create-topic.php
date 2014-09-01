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

$result = MakeDatabaseQuery("SELECT * FROM `topicadministrators` WHERE `emailaddress`='$userData[email_address]';", $socket);

if (!$result) { 
    
} else {
   $return = MakeDatabaseFetch($result);
    if($return[isadministrator] == true) { 
        if($return[administrationlevel] == 9) {
            $topicadmin = 9;   
        } if($return[administrationlevel] == 1) {
            $topicadmin = 1;
        }
    } else {
        header("Location: /teacher/");   
    }
} 

?>

<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>

<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
</script>


<?php
if ($edit == true) { 
    
    $query = "SELECT * FROM `helptopics` WHERE `topicid`='$instruction';";

    if ($result = $socket->query($query)) {
       while ($row = $result->fetch_assoc()) {
?>
<h1>Edit a topic</h1>

<p class='text-center'><em><q>With great power there must also come -- great responsibility!</q></em> &mdash; Stan Lee.</p>
<p>You are editing a help topic on the live website. If you make a mistake, chances are, someone will see it. Make very sure that you check everything before publication.</p>

<form method="post" action="topic_format.php" enctype="application/x-www-form-urlencoded">
    <input type="hidden" name="publishinguser" value="<?=$userData[email_address]?>">
    <input type="hidden" name="editing" value="true">
    <input type="hidden" name="topicid" value="<?=$row[topicid]?>">
<p><strong>Title</strong> <br>
<input type="text" name="title" placeholder="<?=$row[title]?>" value="<?=$row[title]?>" class="form-control"></p>
<p><strong>Author</strong> <br>
<input type="text" name="author" placeholder="<?=$row[author]?>" value="<?=$row[author]?>" class="form-control"></p>
<p><strong>Body</strong>
<textarea name="body" placeholder="Body text"><?=$row[body]?></textarea> </p>

<button type="submit" class="btn btn-success">Update Topic</button>
    
</form>

<?php
       }
    }
} else {
?>

<h1>Create a topic</h1>

<p class='text-center'><em><q>With great power there must also come -- great responsibility!</q></em> &mdash; Stan Lee.</p>
<p>You are creating a help topic on the live website. If you make a mistake, chances are, someone will see it. Make very sure that you check everything before publication.</p>

<form method="post" action="topic_format.php" enctype="application/x-www-form-urlencoded">
    <input type="hidden" name="publishinguser" value="<?=$userData[email_address]?>">
    <input type="hidden" name="editing" value="false">
<p><strong>Title</strong> <br>
<input type="text" name="title" placeholder="Title" class="form-control"></p>
<p><strong>Author</strong> <br>
<input type="text" name="author" placeholder="Title" class="form-control"></p>
<p><strong>Body</strong>
<textarea name="body" placeholder="Body text"></textarea> </p>

<button type="submit" class="btn btn-success">Publish Topic</button>
    
</form>

<?php
}

create_footer();

?>