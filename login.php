<?php
session_start();
?>
<!DOCTYPE html>
<html >
<head>
<?php
include "header.php";
?>
<title>Login</title>
</head>
<body>
    
<!-- Login form-->
<div class="container text-center" style="width: 400px;">
<h1 class="text-center">Login</h1>
<form action="login_check.php" onsubmit="return validaterfunc();" method="POST">
<div class="form-group">
<input class="form-control" type="text" id="username" name="username" placeholder="Username" value="<?php if(isset($_COOKIE["username"])){echo $_COOKIE["username"]; }         ?>" required>
<span id="username-error"></span>
</div>
<div class="form-group">
<input class="form-control" type="password" id="password" name="password" placeholder="Password" value="<?php if(isset($_COOKIE["password"])){echo $_COOKIE["password"]; }         ?>" required>
<span id="password-error"></span>
</div>
<div class="form-check">
<input class="form-check-input" type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["username"])){  ?>  checked  <?php } ?>  >
<label for="remember">Remember me</label>
</div>
<input class="btn btn-outline-primary   btn-lg"  type="submit" value="Login" id="login-btn" name="login-btn">
</form>

<?php
// Checking if any message is to be displayed
if(isset($_SESSION['hack']))
{
echo $_SESSION['hack'];
unset($_SESSION['hack']);
}
?>
</div>
<a href="index.php" role="button" class="btn btn-outline-success   btn-lg" style="position: fixed; left: 20px; top: 20px;">HOME</a>
<script>
function validaterfunc(){
        
        // Getting input values
         var username=document.getElementById('username').value;
         var password=document.getElementById('password').value;

        // Defining Regex
         var usernameregx=/^[a-zA-Z0-9_\.@]{5,20}$/;
         var passwordregx=/^[a-zA-Z0-9_@\.]{9,}$/;
        
        // Performing Client side validation
        if(usernameregx.test(username)){
            document.getElementById('username-error').innerHTML="";
            
        }
        else{
            document.getElementById('username-error').innerHTML="Invalid Username Format";
            return false;
        }

        if(passwordregx.test(password)){
            document.getElementById('password-error').innerHTML="";
        }
        else{
            document.getElementById('password-error').innerHTML="Invalid Password";
            return false;
        }

}


</script>

</body>
</html>

