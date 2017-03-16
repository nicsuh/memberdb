<?php
//error_reporting(0); // we don't want to see errors on screen
// Start a session
error_reporting(E_ALL); //  we don't want to see errors on screen
 
require_once ('db_connect.inc.php'); // include the database connection
require_once ("functions.inc.php"); // include all the functions
$seed="0dAfghRqSTgx"; // the seed for the passwords
$domain =  "www.synccom.com"; // the domain name without http://www.


$servername = "localhost";
$username = "root";
$password = "usbw";
$mydb = "membership";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Complete Member Login / System tutorial - <?php echo $domain; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>