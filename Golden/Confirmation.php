<?php
require 'Connection.php';
Session_start();
if(!isset($_SESSION['Email_account']))
{
  header("Location:Register.php");
}
echo "<b>Enter the Code that has been sent to your Email account to confirm your account.</b>";
$Email=$_SESSION['Email_account'];
?>
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
<form action="" method="post" name-"LoginForm" class="login">
<div class="Login_confirm">Account Confirmation</div>
<label><?php echo $Email?></label><br></br>
<label>Confirmation Code </label><br><input type="text" maxlength="45" size="" autocomplete="false" class="Confirm" name="Code"/><br></br>
<input type ="submit" name="Confirm" value="Confirm Account"/><br>

<?php
if(isset($_POST['Confirm']))
{
  $Code=$_POST['Code'];
  if(empty($Code))
  {
    print "<font color ='red'>Enter the Confirmation Code.</font>";

  }else
    {
       $Select =mysqli_query($Connect,"SELECT * FROM `users` WHERE Email ='$Email'");
    }
  while($row=mysqli_fetch_array($Select))
  {
    $DB_Code = $row['Code'];
  }
  if($Code==$DB_Code)
  {
    $Insert=mysqli_query($Connect,"UPDATE `users` SET Confirmed = 'True' WHERE Email='$Email'");
    echo "<font color='Green'> Your Account has been Confirmed.</font>";
    header("Refresh:2;url=Login.php");
  }
  else
  {
    echo "<font color ='red'> The Confirmation Code does not match with the one sent to your Email Address.</font>";
  }
}
  ?>
</form>
