<?php

// Teacher Registration for WruD
// © 2014 Department for Education and Child Development

// @Requries - uses the settings from the API for centralisation
require '../api/settings.php';
require '../api/api.fnc.php';

// @Headers
date_default_timezone_set("Australia/Adelaide");

// @Setters
$db = configure_active_database();
$socket = ConnectToDatabase($db) or die("<strong>Error:</strong> couldn't find database! Try again in a few moments.");

// @Getters
$cleanData = array();
$cleanData['emailaddress'] = $socket->real_escape_string(filter_var($_POST['emailaddress'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
$cleanData['password'] = $socket->real_escape_string(filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));

// @Inref Functions
function return_failed() {
    header('Location: /teacher/settings.php?failed=true');
}

function fix_time($timeString) {
    try {
        $correctTimeStamp = date("Y-m-d H:i:s", $timeString);
    } catch (Exception $e) { 
        return_failed();
    }
    return $correctTimeStamp;
}

// @Create Time

$timeCreated = fix_time(time());

// @Build Query

$safeQuery = "INSERT INTO `wrud`.`passwordpending` (`id`, `emailaddress`, `newpassword`) VALUES (NULL, '$cleanData[emailaddress]', '$cleanData[password]');";

// @Insert New User

try {
    $result = MakeDatabaseQuery($safeQuery, $socket) or die(mysqli_error($socket));
    
    if (!result) {
        return_failed();
        die();
    } else {
        // New User Verification Email...
        require '../includes/PHPMailerAutoload.php';
        
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'mail.internode.on.net';
        $mail->SMTPAuth = false;
        $mail->setFrom('no-reply@wrud.tfel.edu.au', 'TfEL App Support');
        $mail->addAddress($cleanData[emailaddress], $cleanData[firstname]);
        $mail->Subject = '[TfEL] Password Change';
        $mail->Body    = '<!DOCTYPE html>
<html>
<body>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <div class="container">
        <h1 style="color: #ec5945;">What Are You Doing - Change Password</h1>
        <p>Hello,</p>
        <p>You, or someone pretending to be you has changed your password for the TfEL App &prime;What are you Doing&prime;.</p>
        <p>If it was you, confirm your change by <a href="https://wrud.tfel.edu.au/teacher/verify_format.php?email='.$cleanData[emailaddress].'&newpass=true">clicking here</a>. If you didn\'t make this request, you can safely ignore this message, no further action will be taken.</p>
        <p>If you believe that someone may be attempting to use / retrieve your details illegitimately, please forward this message to <a href="mailto:aidan.cornelius@sa.gov.au">Aidan Cornelius</a>.</p>
        <p>Best Wishes,</p>
        <p>The Teaching for Effective Learning Team</p>
        <p>Online: <a href="//www.tfel.edu.au" target="_blank">TfEL Resources</a><br>Phone: <a href="tel:0882264351">08 8226 4351</a></p>
        <p><small>Please do not reply to this email. Use the contact address above.</small></p>
    </div>
</body>
</html>';
        $mail->AltBody = 'Hello '.$cleanData[firstname].'\nYou, or someome pretending to be you has registered for the TfEL App What are you Doing as a teacher.\nIf it was you, you can confirm your email address here https://wrud.tfel.edu.au/verify_format.php?email='.$cleanData[emailaddress].'&edu_domain=true&authrandom=VC3XC4L3E. If you didn\'t make this request, you can safely ignore this message, no further action will be taken.\nBest Wishes,\nThe Teaching for Effective Learning Team';
        
        if(!$mail->send()) {
            echo '<strong>Mail error:</strong> ' . $mail->ErrorInfo;
            return_failed();
        } else {
            header('Location: /teacher/settings.php?register=true');
        }
    }
} catch (Exception $e) {
    return_failed();
    die();
} 
