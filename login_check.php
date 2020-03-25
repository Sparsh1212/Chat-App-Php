<?php
session_start();
include "connection.php";
if(isset($_POST['login-btn']))
{
// Getting values from front-end

$username=$_POST['username'];
$password=$_POST['password'];

    
// Defining regex for server side validation

$usernameregx="/^[a-zA-Z0-9_\.@]{5,20}$/";
$passwordregx="/^[a-zA-Z0-9_@\.]{9,}$/";


// Server side validation 

    if(preg_match($usernameregx,$username)){
}else
{
    $_SESSION['hack']="Your hacking attempt was unsuccessful";
header("Location: login.php");
}


if(preg_match($passwordregx,$password)){
}else
{
    $_SESSION['hack']="Your hacking attempt was unsuccessful";
header("Location: login.php");
}

//Preparing data for query

$username=htmlspecialchars($username);
$username=mysqli_real_escape_string($conn,$username);
$password=htmlspecialchars($password);
$password=mysqli_real_escape_string($conn,$password);

// MySql query 
$q="select * from sparsh_users where username='$username' ";
$res=mysqli_query($conn,$q);
if(mysqli_num_rows($res)>0)
{
 $row=mysqli_fetch_assoc($res);
    if(password_verify($password, $row['password']))
    {
    
    // Checking whether user has opted for Rememberme or not
    if(!empty($_POST['remember']))
    {
     // Setting cookies   
     setcookie("username",$username,time()+(24*60*60));
     setcookie("password",$password,time()+(24*60*60));
    }
    else
    {   // Destroying cookies if already set before
        if(isset($_COOKIE["username"]))
        {
      setcookie("username","");
        }
        if(isset($_COOKIE["password"]))
        {     
        setcookie("password","");
        }

    }



    // Final redirection to profile.php

    $_SESSION['username']=$username;
    if($row['firstname']!='' && $row['lastname']!='' && $row['image']!='' )
    {
        echo "Success3";
        header("Location: dashboard.php");
    }
    else{
    header("Location:profile.php");
    }
    }


    //When password mismatch happens
    else
    {
    $_SESSION['hack']="Sorry, wrong credentials entered.";
    header("Location: login.php");
    }

}
// When no such username exists
else
{
    $_SESSION['hack']="Account dosen't exists, please Signup first";
    header("Location: login.php");
}

}
// Redirection if user enters without login-btn
else
{
    header("Location: login.php");
}
                  
?>
