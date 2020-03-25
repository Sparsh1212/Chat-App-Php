<?php
session_start();
include "connection.php";
if(isset($_POST['save-btn']))
{

// Getting profile info of user
$username=$_SESSION['username'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$phoneNumber=$_POST['phone-number'];
$password=$_POST['password'];
$confirmPassword=$_POST['confirm-password'];
$gender=$_POST['gender'];
$image=$_FILES['photo'];
$img_size=$image['size'];
$img_name=$image['name'];
$tmp_dir=$image['tmp_name'];
$type=$image['type'];


// Defining server side regex for validation
$emailregx="/^([a-zA-Z0-9_]{2,})@([a-zA-Z]{2,})\.([a-zA-Z]{2,})(\.[a-z]{2,}){0,}$/";
$phoneregx="/^[6-9]{1}[0-9]{9}$/";
$passwordregx="/^[a-zA-Z0-9_@\.]{9,}$/";
$genderregx="/^[a-zA-Z]{1,}$/";

// Server side validation of info with regex 
if(preg_match($emailregx,$email)){
}else
{
    header("Location: edit.php");
}
if(preg_match($phoneregx,$phoneNumber)){
}else
{
    header("Location: edit.php");
}

if(preg_match($passwordregx,$password)){
}else
{
    header("Location: edit.php");
}
if($password==$confirmPassword){
}else
{
    header("Location: edit.php");
}
if(preg_match($genderregx,$gender)){
}else
{
    header("Location: edit.php");
}

// Image type check
if($type=="image/jpeg"||$type=="image/png"||$type=="image/jpg")
{   
    // Image size check
    if($img_size<=2097152)
    {   // Moving image to img folder
        move_uploaded_file($tmp_dir,"img/".$img_name);
        
        // Sanitizing data before inserting in database
        $email=htmlspecialchars($email);
        $email=mysqli_real_escape_string($conn,$email);
        $phoneNumber=htmlspecialchars($phoneNumber);
        $phoneNumber=mysqli_real_escape_string($conn,$phoneNumber);
        $gender=htmlspecialchars($gender);
        $gender=mysqli_real_escape_string($conn,$gender);
        $password=htmlspecialchars($password);
        $password=mysqli_real_escape_string($conn,$password);
        // Password Hashing before inserting into database
        $password=password_hash($password,PASSWORD_BCRYPT);
        
        // Sanitizing remaining data before inserting in database
        $firstname=htmlspecialchars($firstname);
        $firstname=mysqli_real_escape_string($conn,$firstname);
        $lastname=htmlspecialchars($lastname);
        $lastname=mysqli_real_escape_string($conn,$lastname);
        
        // Mysql query for updating info in database
        $q="update sparsh_users set firstname='$firstname',lastname='$lastname',image='$img_name',email='$email',phone='$phoneNumber',password='$password',gender='$gender'
        where username='$username'  ;";
        $res=mysqli_query($conn,$q);
        
        // Final redirection if everything is all right
        if($res)
        {
            header("Location: dashboard.php");
        }
        
        
       
        
    }
    // If size exceeded 2mb
    else
    {
     
    header("Location: edit.php");
    }

}
// If file is of non-image type
else
{  
    header("Location: edit.php");
}


}
// Redirection to edit.php if not set through save-btn
else
{
    header("Location: edit.php");
}

