<?php
require 'Connection.php';

?>
<html lang="en">
<title></title>
<head>
<link rel="stylesheet" type="text/css" href="css/GoldenLogin.css"/>
<style>@font-face{font-family: Font;src:url('fonts/Font.ttf');}</style>
</head>
<form action="ForgotPassword.php" method="post" name-"LoginForm" class="login">
<div class="Login_confirm">Account Retrieval</div>
<label>Email address</label><input type="Email" maxlength="45" size="" autocomplete="false" name="Email"/><br></br>
<input type ="submit" name="Confirm" value="Confirm Email" onclick="return confirm ('Are you sure you want to reset your password ?')"/><br>
</form>

<?php
if(isset($_POST['Confirm']))
{
  $Email=$_POST['Email'];
  $Select=mysqli_query($Connect,"SELECT * FROM `users`WHERE Email ='$Email'");
  $Numrows =mysqli_num_rows($Select);
  if($Numrows!=0)
  {
    while($Row=mysqli_fetch_array($Select))
    {
      $User = $Row['FirstName'];
      $Password = $Row['Password'];
      $Code= $Row['Code'];
    }
 ////PASSWORD MUST BE DECRYPTED
        $Value =$Password;
        $Token = str_shuffle($Value);
        $Reset =substr($Token,0,8);


    if($Delete=mysqli_query($Connect,"UPDATE `users` SET Password = '' WHERE Email='$Email'"))
    {
      if($Insert=mysqli_query($Connect,"UPDATE `users` SET Code = '$Reset' WHERE Email='$Email'"))
      {
        $To =$Email;
        $Subject ='Password Reset:';
        $Text = 'Dear '.$User.',

 Confirmation Code for Password Reset  ' .$Reset.'';

        $Headers ='Account Reactivation';
        if(mail($To,$Subject,$Text,$Headers))
        {
          header("Refresh:0;url=PasswordConfirm.php");
        }else
        {
          print 'Error:Kindly contact your system Administrator.';
        }
      }
    }


  }else

  {
    Print "<font color='red'>*The Email '$Email' does not exist in the system.</font>";
  }
}

?>
