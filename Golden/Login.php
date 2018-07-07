<?php
require 'Connection.php';
session_start();

?>
<html lang="en">
<title></title>
<head>
<link rel="stylesheet" type="text/css" href="css/GoldenLogin.css"/>
<style>@font-face{font-family: Font;src:url('fonts/Font.ttf');}</style>
</head>

<form action="Login.php" method="post" name-"LoginForm" class="login">
  <div class="Login_label">Login &nbsp &nbsp &nbsp &nbsp<a href="Register.php" class="Register_label">Register</a></div>
<label>Email address</label><input type="Email" maxlength="45" size="" autocomplete="false" name="Email"/><br></br>
<label>Password</label><input type="password" maxlength="45" size="" Onpaste ="false" autocomplete="false" name="Password"/><br></br>
<input type ="submit" name="Login" value="Login"/><br>
<a href="ForgotPassword.php">Forgot password?</a></br>&nbsp<br>



<?php
if(isset($_POST['Login']))
{
  $Email=$_POST['Email'];
  $Password=$_POST['Password'];
  if(empty($Empty) && empty($Password)){ print "<b>Input Error:.<b><br></br>";
  if(empty($Email)){print "<b><font color ='red'>*Fill in the Email Address.<b><br></br></font>";}
  if(empty($Password)){print "<b><font color ='red'>*Fill the Password. <b><br></br></font>";}
}else{
  $Select =mysqli_query($Connect,"SELECT * FROM `users` WHERE Email ='$Email' AND Confirmed ='True'");
  $numrows =mysqli_num_rows($Select);
  if($numrows!=0)
  {
    while($row=mysqli_fetch_array($Select))
    {
      $DB_Email = $row['Email'];
      $DB_Password = $row['Password'];
      $DB_Firstname = $row['FirstName'];
      $DB_LastName = $row['LastName'];
    }
    if($Email=$DB_Email)
    {
      if(password_verify($Password,$DB_Password))
         {
          Session_start();
          $_SESSION['User_Email'] = $DB_Email;
          header("Location:Profile.php");
     }else
         {
         echo "<b><font color ='red'>*Password Doesn't Match with "."$Email".".</b><br></br></font>";
         }
    }

  }else

  {

   print "<b><font color ='red'>*Invalid Login Credetials.<b><br></br></font>";

  }
 }
}





 ?>
</form>
</html>
