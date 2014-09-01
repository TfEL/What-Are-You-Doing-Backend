<?php
header("Content-Type: text/plain");

date_default_timezone_set("Australia/Adelaide");

echo date("Y-m-d H:i:s", time()), "\n";

echo date("Y-m-d H:i:s", time()+80), "\n";