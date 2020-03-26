<?php
include "connection.php";
session_start();
if(isset($_SESSION['username']))
{
if(isset($_SESSION['to_username']))
{
    unset($_SESSION['to_username']);
}
// Query to fetch the user data    
$username=$_SESSION['username'];
$q="select * from sparsh_users where username='$username' ;";
$res=mysqli_query($conn,$q);
$row=mysqli_fetch_assoc($res);
?>

<!--User Data-->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Dashboard</title>
</head>
<body>
<div class="sidenav">

<img height="150" width="150" src=" <?php  echo 'img/'.$row['image']    ;    ?> ">
<h1>Hello <?php echo $row['firstname'];   ?> !!</h1>
<h1>@<?php  echo $_SESSION['username'];  ?></h1>
<p class="n">Email: <?php echo $row['email'];   ?>    
<p class="n">Phone: <?php echo $row['phone'];   ?>    
<p class="n">Gender: <?php echo $row['gender'];   ?>
<br><br><br><br>
<a href="index.php"><button>HOME</button></a>
<br>
<a href="edit.php"><button>EDIT PROFILE</button></a>  
<br>
<a href="logout.php"><button>LOGOUT</button></a>  
  
</div>
<div class="main">


<!-- Chat Feature-->
<form action="showmsg.php" method="POST">
<?php

// Getting all users from database
echo "<h1>Select User to Chat</h1>";
$q1="select username from sparsh_users where username <> '$username' ;";
$res1=mysqli_query($conn,$q1);

while($row1=mysqli_fetch_assoc($res1))
{
 ?>   
<input type="radio" name="to_user" id="<?php echo $row1['username'];  ?>" value="<?php echo $row1['username'];  ?>" >
<label for="<?php echo $row1['username'];  ?>"><?php echo $row1['username'];  ?></label>
<br>
<br>
<?php
}
}
// Redirection to login.php is not set through username session
else
{
    header("Location: login.php");
}
?>

<!-- Show Chats button-->
<input class="btn-chat" type="submit" value="CHAT" name="SHOW" id="SHOW">
<br>
</form>
</div>
</body>
</html>

