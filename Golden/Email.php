<?php
session_start();
require 'Connection.php';
if(!isset($_SESSION['admin_login']))
{
  header("Location:Mainlogin.php");
}
$profile = $_SESSION['admin_login'];

$Select = mysqli_query($Connect,"SELECT * FROM `users` WHERE Email ='{$_POST['Email']}' LIMIT 1");
while($row=mysqli_fetch_array($Select))
{
 $To = $row['Email'];
}

 ?>
 <html>
<form action="Email.php" method="post">
<label><b>To:</b></label><label name="to"> <?php echo $To ?> </label><br></br>
<label><b>From:</b></label><label name="from"> <?php echo $profile ?> </label><br></br>
<label><b>Subject:</b></label><input type="text" maxlength="40" name="Subject"><br></br>
<label><b>Message:</b></label><textarea spellcheck="true" name="Message"></textarea><br></br>
<input type="submit" name="Send" value ="Send">
</form>
<?php

if(isset($_POST['Send']))
{

$text =$_POST['Subject'];
$Message =$_POST['Message'];

if(empty($text)){print "<b><font color ='red'>*Fill in the Subject.<b><br></br></font>";}
if(empty($Message)){print "<b><font color ='red'>*Fill in the Message.<b><br></br></font>";}

//if(Mail($To,$profile,$text,$Message))
//{

}//else
//{
  //print "<b><font color ='red'>*Failed to send Email.<b><br></br></font>";}
//}



 ?>





</htmL>
