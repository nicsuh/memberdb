<?php 
session_start();
unset ($SESSION['myusername']);
 unset($_SESSION['loginid']);
session_destroy();
header('Location: index.php');

?>	


