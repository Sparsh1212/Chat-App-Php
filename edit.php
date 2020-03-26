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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
  
    </div>
    <div class="form-group">
    <label for="phone-number">Phone No.</label>
    <input class="form-control" id="phone-number" name="phone-number" type="number" required value="<?php echo $row['phone'];  ?>" placeholder="Phone No.">
   
    </div>
    <div class="form-group">
    <label for="password">Password</label>
    <input class="form-control" id="password" name="password" type="password" required placeholder="Password" >
   
    </div>
    <div class="form-group">
    <label for="confirm-password">Confirm Password</label>
    <input class="form-control" id="confirm-password" name="confirm-password" type="password" required placeholder="Confirm Password" >
  
    </div>
    <div class="form-group">
    <input type="radio" checked name="gender" value="Male" id="Male"><label for="Male">Male</label>
    <input type="radio" name="gender" value="Female" id="Female"><label for="Female">Female</label>
    <input type="radio" name="gender" value="Others" id="Others"><label for="Others">Others</label>
 
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
        
        
        
        // Defining the regex for all the input fields
        
        var emailregx=/^([a-zA-Z0-9_]{2,})@([a-zA-Z]{2,})\.([a-zA-Z]{2,})(\.[a-z]{2,}){0,}$/;
        var phoneregx=/^[6-9]{1}[0-9]{9}$/;
        var passwordregx=/^[a-zA-Z0-9_@\.]{9,}$/;
       
        
        
        // Checking input with regx
        
        if(emailregx.test(email)){
          
        }
        else{
            
            //console.log("email is invalid");
            Swal.fire({
            icon: 'error',
            title: 'Invalid Email',
            text: 'Must be a valid email like: xyz@pqr.com or xyz@pqr.ac.in'
             })
             return false;
           
            
        }
        if(phoneregx.test(phoneNo)){
           
        }
        else{
           
            Swal.fire({
            icon: 'error',
            title: 'Invalid Phone no.',
            text: 'Must start with 6/7/8/9 and should be of 10 digits'
             })
            return false;
        }
        
        if(passwordregx.test(password)){
         
        }
        else{
            Swal.fire({
            icon: 'error',
            title: 'Invalid Password',
            text: 'Must be of atleast 9 characters and should be alphanumeric with _/@/. as special characters'
             })


            return false;
        }
        
        if(password==confirmPassword){
         
        }
        else{
            
            Swal.fire({
            icon: 'error',
            title: 'Passwords do not match',
        
             })
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
