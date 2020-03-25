<head>
<style>
body {font-family: Arial, Helvetica, sans-serif;
background-color: teal;
}
* {box-sizing: border-box;}
.message-box{
  background-color: aqua;
  width: 250px;
  border: 4px solid blue;
  padding: 10px;
  font-size: 14px;
}
button {
     
    
    
     padding: 5px;
     text-align: center;
     text-decoration: none;
     display: inline-block;
     font-size: 16px;
     background-color: skyblue;
     color: black;
     border: 2px solid red;
     width: 150px;
   } 
 

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  left: 28px;
  width: 270px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  left: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
</head>
<?php
session_start();
include "connection.php";


if(isset($_POST['SHOW'])||isset($_SESSION['to_username']))
{
// Getting data and sanitizing before inserting into database  
$from_username=$_SESSION['username'];
if(isset($_SESSION['to_username']))
{
  $to_username=$_SESSION['to_username'];
}
else{
$to_username=$_POST['to_user'];
}
if(isset($_POST['SHOW'])){
$_SESSION['to_username']=$to_username;
}
$to_username=htmlspecialchars($to_username);
$to_username=mysqli_real_escape_string($conn,$to_username);
$q="select * from sparsh_messages where (to_username='$to_username' and from_username='$from_username') or  (to_username='$from_username' and from_username='$to_username')  ;";
$res=mysqli_query($conn,$q);
if(mysqli_num_rows($res)>0)
{ // Displaying chats
  while($row=mysqli_fetch_assoc($res))
  {
    ?><div class="message-box">
      <h3><?php echo $row['message']; ?></h3>
    
      <p>Time: <?php echo $row['date'];       ?></p>
      
      <p>Sender: <?php echo $row['from_username']; ?></p>
     
      <p>Receiver: <?php echo $row['to_username']; ?></p>
      
      </div>
     <br>
    <?php 
    }


}

// When no conversation is present
else
{
    echo "No chats till now";
}

?>
<!-- Form to send message to user-->
<button class="open-button" onclick="openForm()">SEND MESSAGE</button>
<div class="chat-popup" id="myForm"> 
<form action="sendmsg.php" method="POST" class="form-container">
<h1>To user: <?php echo $to_username  ; ?></h1>
<label for="message"><b>Message</b></label>
<textarea id="message" name="message" placeholder="Message"></textarea>
<br>
<input type="submit"  class="btn" name="send" id="send" value="Send">
<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
</form>
</div>
<a href="dashboard.php" style=" position: fixed; left: 320px; bottom: 30px;"><button>Dashboard</button></a>
</body>

<?php
}
else
{
  header("Location: dashboard.php");
}
?>
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

