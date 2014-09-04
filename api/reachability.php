<?php

require "authentication_header.fnc.php";

echo json_encode(array("Reachable" => true, "Authenticated" => true, ));
