<?php
session_start();
include "connection.php";
if(isset($_SESSION['username']))
{


?>
<!DOCTYPE html>
<html>
<head>
<?php
include "header.php";
?>
<title>Profile Complete</title>
</head>
<body>

<div class="container" style="width: 500px;">
<h1 text-center>Complete Profile</h1>
<form action="profile_check.php" method="POST" enctype="multipart/form-data">
<div class="form-group">
<input class="form-control" type="text" id="firstname" name="firstname" placeholder="Firstname" required>
</div>
<div class="form-group">
<input class="form-control" type="text" id="lastname" name="lastname" placeholder="Lastname" required>
</div>
<div class="form-group">
<label for="photo" class="font-weight-bold" >Profile Picture </label>
<input class="form-control"  type="file" id="photo" name="photo" required>
</div>
<input class="btn btn-outline-primary   btn-lg" type="submit" id="update-btn" name="update-btn" value="Save">
</form>
</div>
</body>
</html>

<?php
}
// Redirection if user is not login
else
{
    header("Location: login.php");
}
?>
