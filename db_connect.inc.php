<?php

include("header.php");
 


// Create connection
$conn = mysqli_connect($servername, $username, $password, $mydb);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


mysqli_close($conn);
?>


