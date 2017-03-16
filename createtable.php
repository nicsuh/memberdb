<?php
include("header.php");

 

// Create connection
$conn = mysqli_connect($servername, $username, $password, $mydb);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql = "CREATE TABLE login (
 `loginid` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `actcode` varchar(45) NOT NULL,
  `disabled` tinyint(1) NOT NULL default '0',
  `activated` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`loginid`)
 
)";

if (mysqli_query($conn, $sql)) {
    echo "Table loginweb created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>