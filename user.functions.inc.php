<?php


##### User Functions #####
function changePassword($myusername,$currentpassword,$newpassword,$newpassword2){
global $seed;

global $servername;
global $username;
global $password;
global $mydb;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $mydb);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}




	if (!valid_username($myusername) || !user_exists($myusername))
	{
		return false;
	}
	if (! valid_password($newpassword) || ($newpassword != $newpassword2)){
 
		return false;
	}
 
	// we get the current password from the database
	$query = sprintf("SELECT password FROM login WHERE username = '%s' LIMIT 1",
		mysqli_real_escape_string($conn, $myusername));
 
	$result = mysqli_query($conn, $query);
	$row= mysqli_fetch_row($result);
 
	// compare it with the password the user entered, if they don't match, we return false, he needs to enter the correct password.
	if ($row[0] != sha1($currentpassword.$seed)){
 
		return false;
	}
 
	// now we update the password in the database
	$query = sprintf("update login set password = '%s' where username = '%s'",
		mysqli_real_escape_string($conn, sha1($newpassword.$seed)), mysqli_real_escape_string($conn, $myusername));
 
	if (mysqli_query($conn, $query))
	{
		return true;
	}else {return false;}
	return false;


	 mysqli_close($conn);
}
 
 
function user_exists($myusername)
{

global $servername;
global $username;
global $password;
global $mydb;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $mydb);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}




	if (!valid_username($myusername))
	{
		return false;
	}
 
	$query = sprintf("SELECT loginid FROM login WHERE username = '%s' LIMIT 1",
		mysqli_real_escape_string($conn, $myusername));
 
	$result = mysqli_query($conn, $query);
 
	if (mysqli_num_rows($result) > 0)
	{
		return true;
	} else
	{
		return false;
	}
 
	return false;


 mysqli_close($conn);
}
 
function activateUser($uid, $actcode)
{
global $servername;
global $username;
global $password;
global $mydb;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $mydb);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



	$query = sprintf("select activated from login where loginid = '%s' and actcode = '%s' and activated = 0  limit 1",
		mysqli_real_escape_string($conn, $uid), mysqli_real_escape_string($conn, $actcode));
 
	$result = mysqli_query($conn, $query);
 
	if (mysqli_num_rows($result) == 1)
	{
 
		$sql = sprintf("update login set activated = '1'  where loginid = '%s' and actcode = '%s'",
			mysqli_real_escape_string($conn, $uid), mysqli_real_escape_string($conn, $actcode));
 
		if (mysqli_query($conn, $sql))
		{
			return true;
		} else
		{
			return false;
		}
 
	} else
	{
 
		return false;
 
	}
 mysqli_close($conn);
}
 
function registerNewUser($myusername, $password1, $password2, $email)
{
 
	global $seed;
global $servername;
global $username;
global $password;
global $mydb;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $mydb);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



	if (!valid_username($myusername) || !valid_password($password1) ||
			!valid_email($email) || $password1 != $password2 || user_exists($myusername))
	{
		return false;
	}
 


	$code = generate_code(20);
	$sql = sprintf("INSERT into login (username,password,email,actcode) VALUES ('%s','%s','%s','%s')",
		mysqli_real_escape_string($conn, $myusername), mysqli_real_escape_string($conn, sha1($password1 . $seed))
		, mysqli_real_escape_string($conn, $email), mysqli_real_escape_string($conn, $code));
 
 
	if (mysqli_query($conn, $sql))
	{
		$id = mysqli_insert_id($conn);
 
		if (sendActivationEmail($myusername, $password1, $id, $email, $code))
		{
 
			return true;
		} else
		{
			return false;
		}
 
	} else
	{
		return false;
	}
	return false;
 mysqli_close($conn);
}
 
function lostPassword($myusername, $email)
{
 
	global $seed;
global $servername;
global $username;
global $password;
global $mydb;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $mydb);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



	if (!valid_username($myusername) || !user_exists($myusername) || !valid_email($email))
	{
 
		return false;
	}
 
	$query = sprintf("select loginid from login where username = '%s' and email = '%s' limit 1",
		$myusername, $email);
 
	$result = mysqli_query($conn, $query);
 
	if (mysqli_num_rows($result) != 1)
	{
 
		return false;
	}
 
 
	$newpass = generate_code(8);
 
	$query = sprintf("update login set password = '%s' where username = '%s'",
		mysqli_real_escape_string($conn, sha1($newpass.$seed)), mysqli_real_escape_string($conn, $myusername));
 
	if (mysqli_query($conn, $query))
	{
 
			if (sendLostPasswordEmail($myusername, $email, $newpass))
		{
			return true;
		} else
		{
			return false;
		}
 
	} else
	{
		return false;
	}
 
	return false;
 mysqli_close($conn);
}

?>
