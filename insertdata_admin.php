<?php

include("header.php");
 
// Create connection
$conn = mysqli_connect($servername, $username, $password, $mydb);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT into login (username,password,email,activated) VALUES ('admin',sha1(concat('yourpasswordhere','0dAfghRqSTgx')),'youremailhere','1');
";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>