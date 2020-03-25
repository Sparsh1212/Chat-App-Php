<?php
session_start();
include "connection.php";
if(isset($_SESSION['username']))
{
     $username=$_SESSION['username'];
     $q="select * from sparsh_users where username='$username' ;";
     $res=mysqli_query($conn,$q);
     $row=mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    include "header.php";
    ?>
    <title>Edit Profile</title>
</head>
<body>
<!-- User current profile info-->
<div class="container " style="width: 500px;">
<form action="edit_check.php" onsubmit="return validaterfunc();" method="POST" enctype="multipart/form-data">
    <h1>Edit Profile</h1>
    <div class="form-group">
    <label for="firstname">Firstname</label>
    <input class="form-control" type="text" id="firstname" name="firstname" placeholder="Firstname" value="<?php echo $row['firstname'];  ?>" required>
    </div>
    <div class="form-group">
    <label for="lasttname">Lastname</label>
    <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Lastname" value="<?php echo $row['lastname'];  ?>" required>
    </div>
    <p>Current Profile Pic</p><img height="100" width="100"  src=" <?php  echo 'img/'.$row['image']    ;    ?> ">    
    <br><br>
    <div class="form-group">
    <input class="form-control" type="file" id="photo"  name="photo" required>
    </div>
    <div class="form-group">
    <label for="email">Email</label>
    <input class="form-control" id="email" name="email" type="email" required value="<?php echo $row['email'];  ?>" placeholder="Email">
    <span class="text-danger font-weight-bold" id="email-error"></span>
    </div>
    <div class="form-group">
    <label for="phone-number">Phone No.</label>
    <input class="form-control" id="phone-number" name="phone-number" type="number" required value="<?php echo $row['phone'];  ?>" placeholder="Phone No.">
    <span class="text-danger font-weight-bold" id="phone-number-error"></span>
    </div>
    <div class="form-group">
    <label for="password">Password</label>
    <input class="form-control" id="password" name="password" type="password" required placeholder="Password" >
    <span class="text-danger font-weight-bold" id="password-error"></span>
    </div>
    <div class="form-group">
    <label for="confirm-password">Confirm Password</label>
    <input class="form-control" id="confirm-password" name="confirm-password" type="password" required placeholder="Confirm Password" >
    <span class="text-danger font-weight-bold" id="confirm-password-error"></span>
    </div>
    <div class="form-group">
    <label for="gender">Gender</label>
    <input class="form-control" id="gender" type="text" name="gender" required value="<?php echo $row['gender'];  ?>"  placeholder="Gender: Male|Female|Others">
    <span class="text-danger font-weight-bold" id="gender-error"></span>
    </div>
    <input class="btn btn-outline-primary   btn-lg" id="save-btn" name="save-btn"  type="submit" value="Save Changes"> 
    <br><br>
    </form>
    </div>
    <a href="dashboard.php" role="button" class="btn btn-outline-success   btn-lg" style="position: fixed; left: 20px; top: 20px;">Dashboard</a>
<script>
        function validaterfunc(){
        
        // Getting the value from the input fields
        
        var email=document.getElementById('email').value;
        var phoneNo=document.getElementById('phone-number').value;
        var password=document.getElementById('password').value;
        var confirmPassword=document.getElementById('confirm-password').value;
        var gender=document.getElementById('gender').value;
        
        
        // Defining the regex for all the input fields
        
        var emailregx=/^([a-zA-Z0-9_]{2,})@([a-zA-Z]{2,})\.([a-zA-Z]{2,})(\.[a-z]{2,}){0,}$/;
        var phoneregx=/^[6-9]{1}[0-9]{9}$/;
        var passwordregx=/^[a-zA-Z0-9_@\.]{9,}$/;
        var genderregx=/^[a-zA-Z]{1,}$/;
        
        
        // Checking input with regx
        
        if(emailregx.test(email)){
            document.getElementById('email-error').innerHTML="";
        }
        else{
            document.getElementById('email-error').innerHTML="Invalid email";
            return false;
        }
        if(phoneregx.test(phoneNo)){
            document.getElementById('phone-number-error').innerHTML="";
        }
        else{
            document.getElementById('phone-number-error').innerHTML="Invalid Phone Number";
            return false;
        }
        
        if(passwordregx.test(password)){
            document.getElementById('password-error').innerHTML="";
        }
        else{
            document.getElementById('password-error').innerHTML="Invalid Password";
            return false;
        }
        
        if(password==confirmPassword){
            document.getElementById('confirm-password-error').innerHTML="";
        }
        else{
            document.getElementById('confirm-password-error').innerHTML="Passwords does not match";
            return false;
        }
        
        if(genderregx.test(gender)){
            
            document.getElementById('gender-error').innerHTML="";
          //  console.log("All are successfull");
            
        }
        else{
            document.getElementById('gender-error').innerHTML="Invalid Gender Format";
            return false;
        }
        
        }
        
</script>
</body>
</html>


<?php
}
// Redirection to dashboard.php if user try to access without login
else
{
    header("Location: dashboard.php");
}
?>
