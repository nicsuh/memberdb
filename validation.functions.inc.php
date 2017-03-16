<?php
 
#### Validation functions ####
function valid_email($email)
{


	function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


 if (empty($email)) {
    
    return false;

  } else {
    $email = test_input($email);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     return false;
    }else{
    	return true;
    }
  }
 
 return true;
 
}
 
function valid_username($myusername, $minlength = 3, $maxlength = 30)
{
 
	$myusername = trim($myusername);
 
	if (empty($myusername))
	{
		return false; // it was empty
	}
	if (strlen($myusername) > $maxlength)
	{
		return false; // to long
	}
	if (strlen($myusername) < $minlength)
	{
 
		return false; //toshort
	}
 
	$result = preg_match ("/^[A-Za-z0-9_\-]+$/", $myusername); //only A-Z, a-z and 0-9 are allowed
 
	if ($result)
	{
		return true; // ok no invalid chars
	} else
	{
		return false; //invalid chars found
	}
 
	return false;
 
}
 
function valid_password($pass, $minlength = 6, $maxlength = 15)
{
	$pass = trim($pass);
 
	if (empty($pass))
	{
		return false;
	}
 
	if (strlen($pass) < $minlength)
	{
		return false;
	}
 
	if (strlen($pass) > $maxlength)
	{
		return false;
	}
 
	$result = preg_match("/^[A-Za-z0-9_\-]+$/", $pass);
 
	if ($result)
	{
		return true;
	} else
	{
		return false;
	}
 
	return false;
 
}
 
?>
