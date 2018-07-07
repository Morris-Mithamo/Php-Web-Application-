<?php
require 'Connection.php';
?>

<html>
<title></title>
<head>
  <style>
  @font-face
  {
    font-family: Font;
    src:url('fonts/Font.ttf');
  }
  .password,.Select
  {
    padding:8px;
    text-decoration: none;
    border-radius: 4px;
    border: 1px solid #C8C8C8;
    text-align:justify;
    outline: none;
  }
  .Email
  {
    text-decoration: none;
    padding:8px;
    border-radius: 4px;
    border: 1px solid #C8C8C8;
    text-align:justify;
    outline: none;
  }
  form
  {
    padding-top: 24px;
  }
  .Register
  {
    margin-top: 20px;
    border: 1px solid #000000;
    width: 640px;
    border-radius: 4px;
  }
  </style>
<link rel="stylesheet" type="text/css"  href="css/Product.css">
</head>
<div class="Register">
  <div class="label">REGISTER</div>
<form action="Register.php" method="post">
<label>FirstName:</label><input type="text" name="FirstName" maxlength="12"/>&nbsp<label>LastName:</label><input type="text" name="LastName" maxlength="12"/><br></br>
<label>Email Address:</label><input type="Email" name="Email" class="Email" maxlength="48" size="34"/><br></br>
<label>Password:</label><input type="password" class="password" name="Password" maxlength="8" onpaste ="return false" onCopy = "return false" onCut = "return false" autocomplete="off"/> &nbsp
<label>Confirm Password:</label><input type="password" class="password" name="ConfirmPassword" maxlength="8" onpaste ="return false" onCopy = "return false" onCut = "return false" autocomplete="off"/>
<br></br>
<label>Gender:</label><select  name="Gender" class="Select">
                      <option value=""></option>
                      <option value ="Male">Male</option>
                      <option value ="Female">Female</option>
                      </select><br></br>
<label>Country:</label><input type="text" name="Country" maxlength="24"/>&nbsp<label>Town:</label><input type="text" name="Town" maxlength="24"/><br></br>
<input type="checkbox" value="Accept" name="Agree"/><b>I agree to the Terms and Conditions.</b><br></br>
<input type="submit" value="Register" name="Register">
</form>

<?php
if(isset($_POST['Register']))
{
  $FirstName=$_POST['FirstName'];
  $LastName=$_POST['LastName'];
  $Email=$_POST['Email'];
  $Password=$_POST['Password'];
  $ConfirmPassword=$_POST['ConfirmPassword'];
  $Gender=$_POST['Gender'];
  $Country=$_POST['Country'];
  $Town=$_POST['Town'];
  if($Password==$ConfirmPassword)
  {
    $PasswordError=$Password;
  }

  if(empty($FirstName)||empty($LastName)||empty($Email)||empty($PasswordError)||empty($ConfirmPassword)||empty($Gender)||empty($Country)||empty($Town))
  {

    print "<b><font color='red'>*Ensure that all the fields are filled in.</font></b><br></br>";

    if(empty($FirstName)){print "<b><font color='red'>*Fill in the FirstName.</font></b><br></br>";}
    if(empty($LastName)){print "<b><font color='red'>*Fill in the LastName.</font></b><br></br>";}
    if(empty($Email)){print "<b><font color='red'>*Fill in the Email.</font></b><br></br>";}
    if(empty($ConfirmPassword)){print "<b><font color='red'>*Confirm the Password.</font></b><br></br>";}
    if(empty($PasswordError)){print "<b><font color='red'>*Fill in the password fields correctly.</font></b><br></br>";}
    if(empty($Gender)){print "<b><font color='red'>*Select the Gender.</font></b><br></br>";}
    if(empty($Country)){print "<b><font color='red'>*Fill in the Country.</font></b><br></br>";}
    if(empty($Town)){print "<b><font color='red'>*Fill in the Town.</font></b><br></br>";}

  }else{
    //Accepting the Terms and Conditions.

if(isset($_POST['Agree'])){
             $Date =date('l,d,F,Y');
             $Select=mysqli_query($Connect,"SELECT * FROM `users`WHERE Email ='$Email'");
             $numrows =mysqli_num_rows($Select);
             $hashed_password=Password_hash($Password,PASSWORD_BCRYPT);
             $file = fopen("Logs/$Email.txt",'w') or die('Unable to Register the user');
             $text ="The user ".$FirstName." ".$LastName.", has been Registered Successfully on ".$Date." and has accepted the terms and Conditions.";
             fwrite($file,$text);
             fclose($file);
             if($numrows!==1)
             {
                 if($Insert = mysqli_query($Connect,"INSERT INTO `users`(FirstName,LastName,Email,Password,Gender,Country,Town)
                 VALUES('$FirstName','$LastName','$Email','$hashed_password','$Gender','$Country','$Town')"))
                   {

                       if($Select =mysqli_query($Connect,"SELECT * FROM `users` WHERE Email ='$Email'"))
                       {

                       while($row=mysqli_fetch_array($Select))
                       {
                         $db_Email=$row['Email'];
                         $db_Password=$row['Password'];
                       }
                         $Token =$db_Password;
                         $Token = str_shuffle($Token);
                         $Code =substr($Token,0,8);
                         $To =$db_Email;
                         $Subject ='Account Confirmation:';
                         $Text ='Confirmation Code '.$Code.'';
                         $Headers ='Confirmation Code/Activation Code:';
                         if($Insert=mysqli_query($Connect,"UPDATE `users` SET Code = '$Code' WHERE Email='$Email'")){
                         if(mail($To,$Subject,$Text,$Headers))
                         {
                           session_start();
                           if($_SESSION['Email_account'] = $db_Email)
                           {

                             header("Location:Confirmation.php");
                           }
                          }
}else{echo "error";}
                     }else{echo "error";}

                   }else

                   {
                   Print"<b><font color='red'>*Registration Failed:</font></b><br></br>";
                   }

             }else{print "<b><font color='Red'>The Email Address: </b>'$Email' <b>already exists,try a different Email Address.</b></font>";}
                         }else{print "<b><font color='red'>*Confirm that you accept the terms and conditions.</color></b><br></br>";}
             }




  }




?>
</div>
<htmL>
