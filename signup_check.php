<?php
session_start();
include "connection.php";


// Checking whether username is already taken or not

if(isset($_POST['user_name']))
{
$user_name=mysqli_real_escape_string($conn,$_POST['user_name']);
$u_query="select * from sparsh_users where username='$user_name' ; ";
$u_result=mysqli_query($conn,$u_query);
echo mysqli_num_rows($u_result);
}





else if(isset($_POST['signup-btn'])){

// Getting values from front-end

$username=$_POST['username'];
$email=$_POST['email'];
$phoneNumber=$_POST['phone-number'];
$password=$_POST['password'];
$confirmPassword=$_POST['confirm-password'];
$gender=$_POST['gender'];



// Defining regex for server side validation

 $usernameregx="/^[a-zA-Z0-9_\.@]{5,20}$/";
 $emailregx="/^([a-zA-Z0-9_]{2,})@([a-zA-Z]{2,})\.([a-zA-Z]{2,})(\.[a-z]{2,}){0,}$/";
 $phoneregx="/^[6-9]{1}[0-9]{9}$/";
 $passwordregx="/^[a-zA-Z0-9_@\.]{9,}$/";


// Server side validation 

if(preg_match($usernameregx,$username)){
}else
{
    $_SESSION['hack']="Your hacking attempt was unsuccessful";
header("Location: signup.php");
}
if(preg_match($emailregx,$email)){
}else
{
    $_SESSION['hack']="Your hacking attempt was unsuccessful";
header("Location: signup.php");
}
if(preg_match($phoneregx,$phoneNumber)){
}else
{
    $_SESSION['hack']="Your hacking attempt was unsuccessful";
header("Location: signup.php");
}

if(preg_match($passwordregx,$password)){
}else
{
    $_SESSION['hack']="Your hacking attempt was unsuccessful";
header("Location: signup.php");
}
if($password==$confirmPassword){
}else
{
    $_SESSION['hack']="Your hacking attempt was unsuccessful";
header("Location: signup.php");
}


// Preparing data to be inserted to database

$username=htmlspecialchars($username);
$username=mysqli_real_escape_string($conn,$username);
$email=htmlspecialchars($email);
$email=mysqli_real_escape_string($conn,$email);
$phoneNumber=htmlspecialchars($phoneNumber);
$phoneNumber=mysqli_real_escape_string($conn,$phoneNumber);
$gender=htmlspecialchars($gender);
$gender=mysqli_real_escape_string($conn,$gender);
$password=htmlspecialchars($password);
$password=mysqli_real_escape_string($conn,$password);



// Password hashing

$password=password_hash($password,PASSWORD_BCRYPT);

// MySql query 

$q="insert into sparsh_users(username,email,password,phone,gender) values('$username','$email','$password',$phoneNumber,'$gender')   ;";
$res=mysqli_query($conn,$q);

// Redirection to another page based on query result
if($res){
    header("Location: login.php");
}else
{
    header("Location: signup.php");
    $_SESSION['hack']="Sorry something went wrong, please try again !!";
}

}


// Redirection if user entered without signup-btn
else
{  
    header("Location: signup.php");
}
?>

