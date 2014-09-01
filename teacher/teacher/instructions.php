<?php

require '../teacher/include/autoinclude.php'; 
autoinclude();

$userData = login_verify($_COOKIE);

if($userData['groupmember'] == true) { create_header(true);  } else { create_header(); }

$node = $_GET['node'];
$instruction = $_GET['instruction'];

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
    }
} 

if ($node != true) {
    $node = false;
}


if ($topicadmin == 9 && $node == true || $topicadmin == 1 && $node == true) { echo "<p class='pull-right'><a href='create-topic.php?mode=edit&instruction=$instruction' class='btn btn-default'>Edit Topic</a> <a href='harchive_format.php?row=$instruction' class='btn btn-default'>Delete Topic</a></p>"; $nodisplay = true; }

if ($topicadmin == 9 || $topicadmin == 1) { if ($nodisplay == true) {} else  { echo "<p class='pull-right'><a href='create-topic.php' class='btn btn-default'>Create Topic</a></p>"; } } 


?>

<h1>Help Topics</h1>

<div class="list-group" style="max-width:600px;">
<?php

if ($node == true) {
    $instruction = $socket->real_escape_string(filter_var($instruction, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
    $query = "SELECT * FROM `helptopics` WHERE `topicid`='$instruction';";
} else {
    $query = "SELECT * FROM `helptopics`;";
}
if ($result = $socket->query($query)) {
       while ($row = $result->fetch_assoc()) {
           if ($node == true) {
               echo "<h3>$row[title].</h3>\n<p>Authored on $row[created] by <a href='mailto:$row[owner]'>$row[author]</a>.</p>\n";
               echo "$row[body]";
           } else {
             echo "<a href=\"?node=true&instruction=$row[topicid]\" class=\"list-group-item\"><span class=\"badge pull-right\">$row[author]</span> $row[title]</a>";
           }
       }
}

?>

</div>

<?php

/* INSERT INTO `wrud`.`helptopics` (`id`, `owner`, `created`, `topicid`, `author`, `title`, `body`) VALUES ('0', 'aidancornelius@research.tfel.edu.au', '2014-07-21 16:15:00', '1100', 'Aidan Cornelius-Bell', 'Downloading the ''What are you Doing'' client', 'Not yet available'); */

create_footer();

?>