<?php

$theRow = $_GET['row'];

$classCode = $_GET['code'];

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

$theRow = $socket->real_escape_string(filter_var($theRow, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
$classCode = $socket->real_escape_string(filter_var($classCode, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));

?>

<?php if ($createdClass == true) { echo "<div class='alert alert-success'><strong>Class Created!</strong> Your class was sucessfully added, you can see a list of your classes below.</div>"; } ?>

<p class="pull-right"><a class="btn btn-success" href="results.php">My Reports</a> 
<h1>View Report</h1> 

<?php

$query = "SELECT * FROM `reports` WHERE `owner`='$userData[email_address]' AND `id`='$theRow' AND `classcode`='$classCode';";

if ($result = $socket->query($query)) {
    
     while ($row = $result->fetch_assoc()) {
        
        $groupOneArray = json_decode($row["groupOneArray"], true); $groupTwoArray = json_decode($row["groupTwoArray"], true); $groupThreeArray = json_decode($row["groupThreeArray"], true);
        
        echo "<p>Report created by <a href='mailto:$row[owner]'>$row[owner]</a> on $row[reportcreated] for class <code>$row[classcode]</code>.</p>";

        $studentsArray = json_decode($row[studentsarray], true);
        
        $inc = 0;
        $inct = 0;
         
        echo "\n\n\n<table border='1' style='width:100%;'>";
        foreach ($studentsArray as $key => $value) {
            $numStudents = count($key);
            $inct ++;
        }
        
        echo "<tr><th style='width:115px'>Interrupt #:</th> ";
        foreach ($value as $kkey => $kvalue) {
            $inc++;   
            echo "<th><abbr title='Interrupt at: $kkey'>$inc</abbr></th>";
        }
        echo "</tr> ";
        
        $inct = 0;
        foreach ($studentsArray as $key => $value) {
            $numStudents = count($key);
            $inct ++;
            // Student Numbers (the 'down')
            while ($numStudents > 0) {
                echo "<tr>";
                echo "<td>Student <abbr title='Student Anonymous ID: $key'>$inct</abbr></td>";
                foreach ($value as $kkey => $kvalue) {
                    $inc++;
                                    
                    switch ($kvalue) {
                        case "1:0":
                            $ret = $groupOneArray['1'];
                        break;
                        case "1:1":
                            $ret = $groupOneArray['2'];
                        break;
                        case "1:2":
                            $ret = $groupOneArray['3'];
                        break;
                        case "1:3":
                            $ret = $groupOneArray['4'];
                        break;
                        case "1:4":
                            $ret = $groupOneArray['5'];
                        break;
                        case "1:5":
                            $ret = $groupOneArray['6'];
                        break;
                        case "1:6":
                            $ret = $groupOneArray['7'];
                        break;
                        case "2:0":
                            $ret = $groupTwoArray['1'];
                        break;
                        case "2:1":
                            $ret = $groupTwoArray['2'];
                        break;
                        case "2:2":
                            $ret = $groupTwoArray['3'];
                        break;
                        case "2:3":
                            $ret = $groupTwoArray['4'];
                        break;
                        case "2:4":
                            $ret = $groupTwoArray['5'];
                        break;
                        case "2:5":
                            $ret = $groupTwoArray['6'];
                        break;
                        case "2:6":
                            $ret = $groupTwoArray['7'];
                        break;
                        case "3:0":
                            $ret = $groupThreeArray['1'];
                        break;
                        case "3:1":
                            $ret = $groupThreeArray['2'];
                        break;
                        case "3:2":
                            $ret = $groupThreeArray['3'];
                        break;
                        case "3:3":
                            $ret = $groupThreeArray['4'];
                        break;
                        case "3:4":
                            $ret = $groupThreeArray['5'];
                        break;
                        case "3:5":
                            $ret = $groupThreeArray['6'];
                        break;
                        case "3:6":
                            $ret = $groupThreeArray['7'];
                        break;
                    }
                    
                    echo "<td><abbr title='$ret'>$kvalue</abbr></td>";
                }
                echo "</tr>";
                 $numStudents--;
            }
        }
         
        echo "</table>\n\n\n <br>";
         
        if ($row[isshared] == 0) { 
            echo "<p>Share this report with your group?</p>";
        } else {
            echo "<p>This report is shared with $userData[thegroup].</p>";
        }
     }
}

create_footer();

?>