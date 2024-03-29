<?php

function login_verify($dataInbound) {
   // Something something cookie, something something database
    
    function return_failed($error) {
        echo '<script type="text/javascript"> window.location="https://wrud.tfel.edu.au/login.php"; </script>';
        die();   
    }
    
    if (!function_exists('configure_active_database')) {
        require '../api/settings.php';
        require '../api/api.fnc.php';
        
        $socket = ConnectToDatabase(configure_active_database()) or die("<strong>Error:</strong> couldn't find database! Try again in a few moments.");
    } else {
        $socket = ConnectToDatabase(configure_active_database()) or die("<strong>Error:</strong> couldn't find database! Try again in a few moments.");
    }
    
    $uvEmailAddress = $dataInbound['emailAddress'];
    $uvFirstName = $dataInbound['firstName'];
    $uvLoginStamp = $dataInbound['loginStamped'];
    
    if(empty($uvLoginStamp)) {
        // Well that was easy...
        return_failed("No Stamp");
    } else {
        $return = array();
        
        $emailAddress = $socket->real_escape_string(filter_var($uvEmailAddress, FILTER_VALIDATE_EMAIL));
        $firstName = $socket->real_escape_string(filter_var($uvFirstName, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
        
        $safeQuery = "SELECT * FROM `teachers` WHERE `emailaddress`='$emailAddress' AND `firstname`='$firstName';";

        $result = MakeDatabaseQuery($safeQuery, $socket) or return_failed("Query Failed");
        
        $isRows = $result->num_rows;
    
        if ($isRows == 0) { 
            // Nothing came back in the query.
            return_failed("No Rows");
        } else {
            // There was a result...
            $returnKeys = MakeDatabaseFetch($result, $socket);
            
            $memberSafeQuery = "SELECT * FROM `memberships` WHERE `emailaddress`='$returnKeys[emailaddress]';";
            
            $memberresult = MakeDatabaseQuery($memberSafeQuery, $socket);
            
            $membershipsStack = MakeDatabaseFetch($memberresult);
            
            if (is_null($membershipsStack)) { 
                $return["groupmember"] = false;
            } else {
                if ($membershipsStack->num_rows <= 1) {
                
                    $groupSafeQuery = "SELECT * FROM `sites` WHERE `sitecode`='$membershipsStack[sitecode]';";

                    $groupresult = MakeDatabaseQuery($groupSafeQuery, $socket);

                    $groupStack = MakeDatabaseFetch($groupresult);

                    $return["groupmember"] = true;
                    $return["thegroup"] = $groupStack['sitename'];
                    $return["groupcode"] = $membershipsStack['sitecode'];
                } else {
                    $return["groupmember"] = false;
                }
            }
            
                if ($returnKeys[emailaddress] == $emailAddress) {
                    if ($returnKeys[firstname] == $firstName) {
                        $return["email_address"] = $returnKeys['emailaddress'];
                        $return["first_name"] = $returnKeys['firstname'];
                        $return["site_school"] = $returnKeys['decdsite'];
                        $return["user_password"] = $returnKeys['password'];
                    }
                }
        } 
    }
    return $return;
}

?>