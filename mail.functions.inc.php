<?php
 
##### Mail functions #####

function sendLostPasswordEmail($myusername, $email, $newpassword)
{
 
    global $domain;
    $message = "
You have requested a new password on http://www.$domain/,
 
Your new password information:
 
username:  $myusername
password:  $newpassword
 
 
Regards
$domain Administration
";
 
    if (sendMail($email, "Your password has been reset.", $message, "no-reply@$domain"))
    {
        return true;
    } else
    {
        return false;
    }
 
 
}
 
function sendMail($to, $subject, $message, $from)
{
 
 
    $from_header = "From: $from";
 
    if (mail($to, $subject, $message, $from_header))
    {
        return true;
    } else
    {
        return false;
    }
    return false;
}
 
function sendActivationEmail($myusername, $password, $uid, $email, $actcode)
{
    global $domain;
    $link = "http://www.$domain/logintwo/activate.php?uid=$uid&actcode=$actcode";
    $message = "
Thank you for registering on http://www.$domain/,
 
Your account information:
 
username:  $myusername
password:  $password
 
Please click the link below to activate your account.
 
$link
 
Regards
$domain Administration
";
 
    if (sendMail($email, "Please activate your account.", $message, "no-reply@$domain"))
    {
        return true;
    } else
    {
        return false;
    }
}
 
?>