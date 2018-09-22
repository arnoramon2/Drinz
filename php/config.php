<?php
date_default_timezone_set( "Europe/Brussels" );

$local = true;

if ($local) {
	$tmp = 'http://' . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
	$DB  = substr( $tmp, 0, strripos( $tmp, "/" ) ) . "/php/DB_local.php";
}
else {
	$DB = "";
}
?>