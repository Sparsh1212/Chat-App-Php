<?php
session_start();
include("connection.php");
if(isset($_POST['update-btn']))
{
// Getting data and sanitizing before inserting into database    
$username=$_SESSION['username'];
$firstname=$_POST['firstname'];
$firstname=htmlspecialchars($firstname);
$firstname=mysqli_real_escape_string($conn,$firstname);
$lastname=$_POST['lastname'];
$lastname=htmlspecialchars($lastname);
$lastname=mysqli_real_escape_string($conn,$lastname);
if(isset($_FILES['photo']))
{
$image=$_FILES['photo'];
$img_size=$image['size'];
$img_name=$image['name'];
$tmp_dir=$image['tmp_name'];
$type=$image['type'];

// Checking whether image type or not
if($type=="image/jpeg"||$type=="image/png"||$type=="image/jpg")
{
    if($image_size<=2097152)
    {   // Moving the image to img folder
        move_uploaded_file($tmp_dir,"img/".$img_name);
        
        // Mysql query
        $q="update sparsh_users set firstname='$firstname',lastname='$lastname',image='$img_name' where username='$username'  ;";
        $res=mysqli_query($conn,$q);
        
        // Final Redirection if everything is successful
        if($res)
        {
            header("Location: dashboard.php");
        }
        
    }
    // If size exceeded 2mb
    else
    {
     
    header("Location: profile.php");
    }

}
// If file is of non-image type
else
{  
    header("Location: profile.php");
}


}
// If not set via files
else
{
    echo "Not set via files";
}


}


// If not from update-btn
else
{
header("Location: login.php");

}
?>
