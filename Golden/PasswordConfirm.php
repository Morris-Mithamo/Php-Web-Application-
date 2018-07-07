<?php require 'Connection.php';print 'Your confirmation code has been sent to your Email Address.';?>
<html lang="en">
<title></title>
<head>
<link rel="stylesheet" type="text/css" href="css/GoldenLogin.css"/>
<style>@font-face{font-family: Font;src:url('fonts/Font.ttf');}
.Confirm{
text-decoration: none;
padding:8px;
margin-left: 20px;
border-radius: 4px;
border: 1px solid #C8C8C8;
text-align:justify;
outline: none;}
</style>
</head>
<form action="PasswordConfirm.php" method="post" name-"LoginForm" class="login">
<div class="Login_confirm">Account Recovery</div>
<label>Confirmation Code </label><br><input type="text" maxlength="45" size="" autocomplete="false" class="Confirm" name="Code"/><br></br>
<label>New Password:</label><input type="password" class="password" name="Password" maxlength="8" onpaste ="return false" onCopy = "return false" onCut = "return false" autocomplete="off"/> &nbsp
<label>Confirm Password:</label><input type="password" class="password" name="ConfirmPassword" maxlength="8" onpaste ="return false" onCopy = "return false" onCut = "return false" autocomplete="off"/><br></br>
<input type ="submit" name="Confirm" value="Confirm New Password"/><br>
<?php
if(isset($_POST['Confirm']))
{
  $Code = $_POST['Code'];
  $Password=$_POST['Password'];
  $ConfirmPassword=$_POST['ConfirmPassword'];
  if(empty($Code))
    {
      Echo "<font color='red'>Enter the Confirmation Code.</font>";
    }else{$Select =mysqli_query($Connect,"SELECT * FROM `users` WHERE Code ='$Code'");

        if($Password!==$ConfirmPassword){Echo "<font color='red'>Passwords do not Match.</font>";}
           else{
               $PasswordNew=Password_hash($Password,PASSWORD_BCRYPT);
               $Insert=mysqli_query($Connect,"UPDATE `users` SET Password = '$PasswordNew' WHERE Code='$Code'");
                echo "<font color='Green'> Your new Password has been set Successfully.</font>";
               header("Refresh:2;url=Login.php");
               }
          }
}

?>
