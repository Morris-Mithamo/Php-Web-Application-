<?php
session_start();
if(isset($_SESSION['User_Email']))
{
  header("Location:Mainlogin.php");
}
unset($_SESSION['admin_login']);
session_destroy();
require 'Connection.php';
?>

<html lang ="en">
<title>Mainlogin</title>
<head>
<link rel="stylesheet" type="text/css" href="css/Golden.css"/>
<style>
@font-face
{
  font-family: Font;
  src:url('fonts/Font.ttf');

}
@font-face
{
  font-family: Font;
  src:url('fonts/Font.eot');

}

</style>
</head>

<form action="Mainlogin.php" method="post" class="login">
  <div class="Login_label">Administrator Login</div>
  <label>Email Address: </label><input type="Email" name= "Email" maxlength="64" onpaste = "return false" onCopy = "return false" onCut = "return false" autocomplete="off">
  <br></br>
  <label>Password: </label><input type="password" name= "Password" maxlength="8" onpaste ="return false" onCopy = "return false" onCut = "return false" autocomplete="off">
  <br></br>
  <input type = "submit" name ="submit"value="Login">


<?php
if(isset($_POST['submit']))

{
  $Email= $_POST['Email'];
  $Password = $_POST['Password'];

  if(empty($Empty) && empty($Password)){ print "<b>Input Error:</b><br></br>";
    if(empty($Email)){print "<b><font color ='red'>*Fill in the Email Address.<b><br></br></font>";}
    if(empty($Password)){print "<b><font color ='red'>*Fill in the Password.<b><br></br></font>";}
  }else{

  $Select = mysqli_query($Connect,"SELECT * FROM `administrator` WHERE Email_Address='$Email' AND Password='$Password'");
  $numrow =mysqli_num_rows($Select);
  if($numrow!=0)
  {
    while($row=mysqli_fetch_array($Select))
    {
    $DB_EmailAddress = $row['Email_Address'];
    $DB_Password = $row['Password'];
    $DB_Username = $row['Username'];
    $DB_AdministratorName = $row['Administrator_Name'];

    if($DB_EmailAddress==$Email && $DB_Password==$Password)
    {
      session_start();
      $_SESSION ['admin_login']=$DB_EmailAddress;

      header("Location:Main.php");
    }

    }


  }else{Print "<b><font color ='red'>*Invalid User Credentials.</font>";}
}
}

?>
</form>

</html>
