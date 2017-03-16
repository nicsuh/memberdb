<?php
 
require_once ("header.php");
 
if (isLoggedIn())
{
 
	if (isset($_POST['change']))
	{
 
		if (changePassword($_POST['myusername'], $_POST['oldpassword'], $_POST['password1'],
			$_POST['password2']))
		{
			echo "Your password has been changed ! <br /> <a href='./index.php'>Return to homepage</a>";
 
		} else
		{
			echo "Password change failed! Please try again.";
			show_changepassword_form();
		}
 
	} else
	{
		show_changepassword_form();
	}
 
} else {
	// user is not loggedin
	show_loginform();
}
 
require_once "footer.php";
 
?>
