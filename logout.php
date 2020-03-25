<?php
session_start();
if(isset($_SESSION['username'])){

// unsetting previous sessions which are set
unset($_SESSION['username']);
unset($_SESSION['to_username']);

//session_destroy();
$_SESSION['hack']="Successfully Logged Out";
header("Location: login.php");
}
// Redirection if user is not login
else
{
    header("Location: login.php");
}

?>
