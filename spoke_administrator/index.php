<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {

	header('WWW-Authenticate: Basic realm="Spoke Administrator Login"');
	header('HTTP/1.0 401 Unauthorized');

	include 'header.fnc.php';
	create_header();

	echo '<h2>Spoke Administrator</h2></h2><p>Sorry, you entered an incorrect password.</p> <a href="../site_version.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Go back</a>';
} elseif ($_SERVER['PHP_AUTH_USER'] == "aidancornelius@research.tfel.edu.au") {
	include 'header.fnc.php';
	create_header();
	echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
	echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
} else {

        header('WWW-Authenticate: Basic realm="Spoke Administrator Login"');
        header('HTTP/1.0 401 Unauthorized');

        include 'header.fnc.php';
        create_header();

	echo '<h2>Spoke Administrator</h2></h2><p>Sorry, you entered an incorrect password.</p> <a href="../site_version.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> Go back</a>';

}


?>
