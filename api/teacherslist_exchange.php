<?php

require "authentication_header.fnc.php";

echo json_encode(array("id" => "1", "email" => "example@example.com", "password" => "example", "id" => "2", "email" => "example2@example.com", "password" => "password2", ));
