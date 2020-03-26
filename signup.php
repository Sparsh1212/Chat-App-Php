
<?php
session_start();
?>

<!DOCTYPE html>
<html >
<head>
   
    <?php
    include "header.php";
    ?>
    <title>Signup</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>
<body>
    <!--Signup Form Part-->
    <div class="container" style="width: 500px;">
    <h1 class="text-center">Signup</h1>
    <form action="signup_check.php" onsubmit="return validaterfunc();" method="POST">
    <div class="form-group">
    <input class="form-control" id="username" name="username" type="text" required placeholder="Username">
   
    <span  id="availability"></span>
    </div>
    <div class="form-group">
    <input id="email" class="form-control" name="email" type="email" required placeholder="Email">

    </div>
    <div class="form-group">
    <input id="phone-number" class="form-control" name="phone-number" type="number" required placeholder="Phone No.">

    </div>
    <div >
    <div class="form-group">
    <input class="form-control" id="password" name="password" type="password" required placeholder="Password" >
   
    </div>
    <div class="form-group">
    <input class="form-control" id="confirm-password" name="confirm-password" type="password" required placeholder="Confirm Password" >
   
    </div>
    <div class="form-group">
    <input type="radio" checked name="gender" value="Male" id="Male"><label for="Male">Male</label>
    <input type="radio" name="gender" value="Female" id="Female"><label for="Female">Female</label>
    <input type="radio" name="gender" value="Others" id="Others"><label for="Others">Others</label>
    </div>
    
    <input class="btn btn-outline-primary   btn-lg"  id="signup-btn" name="signup-btn"  type="submit" value="Signup"> 
    
    </form>
    </div>
    <a href="index.php" role="button" class="btn btn-outline-success   btn-lg" style="position: fixed; left: 20px; top: 20px;">HOME</a>
    <br>
    <br>
    
    
    <!--Php code to receive result from server side validation-->
    <?php       
    if(isset($_SESSION['hack']))
    {
        echo $_SESSION['hack'] ;
        unset($_SESSION['hack']);
    }
    ?>

    
    <script>
       $(document).ready(function(){
     $('#username').keyup(function(){
     
    var username=$(this).val();
    // Ajax request to server
     $.ajax({
     url: 'signup_check.php',
     method:"POST",
     data:{user_name:username},
     success:function(response)
     
     {  // Handling the response from server
        if(response!=0)
        { 
        $('#availability').html('<span class="text-danger font-weight-bold">Username not availiable</span>');
        $('#signup-btn').attr("disabled",true);


        }else
        {
        $('#availability').html('<span class="text-success font-weight-bold">Username  availiable</span>');
        $('#signup-btn').attr("disabled",false);
        }
 }
});
   });
      });
        
        // Validater function
        function validaterfunc(){
        
        // Getting the value from the input fields
        var username=document.getElementById('username').value;
        var email=document.getElementById('email').value;
        var phoneNo=document.getElementById('phone-number').value;
        var password=document.getElementById('password').value;
        var confirmPassword=document.getElementById('confirm-password').value;
       
        
        
        // Defining the regex for all the input fields
        var usernameregx=/^[a-zA-Z0-9_\.@]{5,20}$/;
        var emailregx=/^([a-zA-Z0-9_]{2,})@([a-zA-Z]{2,})\.([a-zA-Z]{2,})(\.[a-z]{2,}){0,}$/;
        var phoneregx=/^[6-9]{1}[0-9]{9}$/;
        var passwordregx=/^[a-zA-Z0-9_@\.]{9,}$/;
        
        
        
        // Checking input with regx
        if(usernameregx.test(username)){
           
            
        }
        else{
            Swal.fire({
            icon: 'error',
            title: 'Invalid Username',
            text: 'Must be of atleast 5 characters and characters should be alphanumeric or _/@/. as special characters'
             })
           
            return false;
        }
        if(emailregx.test(email)){
            
         
        }
        else{
          
            console.log("email is invalid");
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
