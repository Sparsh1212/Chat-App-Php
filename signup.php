
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

</head>
<body>
    <!--Signup Form Part-->
    <div class="container" style="width: 500px;">
    <h1 class="text-center">Signup</h1>
    <form action="signup_check.php" onsubmit="return validaterfunc();" method="POST">
    <div class="form-group">
    <input class="form-control" id="username" name="username" type="text" required placeholder="Username">
    <span class="text-danger font-weight-bold" id="username-error"></span>
    <span  id="availability"></span>
    </div>
    <div class="form-group">
    <input id="email" class="form-control" name="email" type="email" required placeholder="Email">
    <span id="email-error" class="text-danger font-weight-bold"></span>
    </div>
    <div class="form-group">
    <input id="phone-number" class="form-control" name="phone-number" type="number" required placeholder="Phone No.">
    <span class="text-danger font-weight-bold" id="phone-number-error"></span>
    </div>
    <div >
    <div class="form-group">
    <input class="form-control" id="password" name="password" type="password" required placeholder="Password" >
    <span class="text-danger font-weight-bold" id="password-error"></span>
    </div>
    <div class="form-group">
    <input class="form-control" id="confirm-password" name="confirm-password" type="password" required placeholder="Confirm Password" >
    <span class="text-danger font-weight-bold" id="confirm-password-error"></span>
    </div>
    <div class="form-group">
    <input class="form-control" id="gender" type="text" name="gender" required placeholder="Male|Female|Others">
    <span id="gender-error"></span>
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
	console.log(response);    
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
        var gender=document.getElementById('gender').value;
        
        
        // Defining the regex for all the input fields
        var usernameregx=/^[a-zA-Z0-9_\.@]{5,20}$/;
        var emailregx=/^([a-zA-Z0-9_]{2,})@([a-zA-Z]{2,})\.([a-zA-Z]{2,})(\.[a-z]{2,}){0,}$/;
        var phoneregx=/^[6-9]{1}[0-9]{9}$/;
        var passwordregx=/^[a-zA-Z0-9_@\.]{9,}$/;
        var genderregx=/^[a-zA-Z]{1,}$/;
        
        
        // Checking input with regx
        if(usernameregx.test(username)){
            document.getElementById('username-error').innerHTML="";
            
        }
        else{
            document.getElementById('username-error').innerHTML="Invalid Username Format";
            return false;
        }
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
            document.getElementById('confirm-password-error').innerHTML="Passwords do not match";
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
