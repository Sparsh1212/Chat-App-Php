<?php
session_start();
include "connection.php";
if(isset($_POST['send']))
{   
    // Getting input data and sanitizing before inserting into database
    $to_username=$_SESSION['to_username'];
    $message=$_POST['message'];
    $from_username=$_SESSION['username'];
    $to_username=htmlspecialchars($to_username);
    $to_username=mysqli_real_escape_string($conn,$to_username);
    $message=htmlspecialchars($message);
    $message=mysqli_real_escape_string($conn,$message);

    // Mysql query
    $q="insert into sparsh_messages(to_username,from_username,message) values('$to_username','$from_username','$message')  ;";
    $res=mysqli_query($conn,$q);
    // Final redirection when everything is successful
    if($res)
    {
        header("Location: showmsg.php");
    }


}
else
{
    header("Location: dashboard.php");
}

?>
