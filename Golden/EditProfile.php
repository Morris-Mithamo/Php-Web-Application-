<?php
require 'connection.php';
session_start();
if(!isset($_SESSION['User_Email']))
{
header("Location:Login.php");
}
$Profile = $_SESSION['User_Email'];
?>
<?php

$Select =mysqli_query($Connect,"SELECT * FROM `users` WHERE Email ='$Profile'");

while($row=mysqli_fetch_array($Select))
{
  $FirstName=$row['FirstName'];
  $LastName=$row['LastName'];
  $Email=$row['Email'];
  $Gender=$row['Gender'];
  $Phone=$row['PhoneNumber'];
  $Country=$row['Country'];
  $Town=$row['Town'];
}

 ?>
<html lang="en">
<head>
<style>
.Gender
{
  padding:8px;
  text-decoration: none;
  border-radius: 4px;
  border: 1px solid #C8C8C8;
  text-align:justify;
  outline: none;
}
.Back
{
  padding:12px;
  width: 80px;
  margin-left:16px;
  margin-bottom: 10px;
  border:1px solid #bcdc28;
  border-radius: 100px;
  background-color:#bcdc28;
  color: #f4f4f4;
  cursor: pointer;
  text-align: center;
  outline: none;
}
.Back:hover
{
  border:1px solid #000000;
  background-color:#ffffff;
  color: #000000;
}
</style>
</head>

<link rel="stylesheet" type="text/css" href="css/Edit.css"/><head>
<style>@font-face{font-family:Font;src:url('fonts/Font.ttf');}</style>
<link rel="stylesheet" type="text/css" href="css/GoldenLogin.css"/></head>
<button class="Back"><a href="Profile.php">Back</a></button><br>

<form action="EditProfile.php" method="post" class="Edit" enctype="multipart/form-data">
  <div class="Login_confirm">Edit Profile Details</div>
<div class="Profilepicture"><label>Upload a Profile Picture  </label><input type="file" name="image"></div><br></br>
<label>FirstName:</label><input type="text" name="FirstName" maxlength="12" value="<?php echo $FirstName?>"/>&nbsp<label>LastName:</label><input type="text" name="LastName" maxlength="12" value="<?php echo $LastName?>"/><br></br>
<label>Email Address:</label><label name="Email"> <?php echo $Email?></label><br></br>
<label>Gender:</label><select  name="Gender" class="Gender">
                      <option value="<?php echo $Gender?>"><?php echo $Gender?></option>
                      <option value=""></option>
                      <option value ="Male">Male</option>
                      <option value ="Female">Female</option>
                    </select> &nbsp <label>Phone Number:</label><input type="text" name="PhoneNumber" maxlength="12" value="<?php echo $Phone?>"/><br></br>
<label>Country:</label><input type="text" name="Country" maxlength="24" value="<?php echo $Country?>"/>&nbsp<label>Town:</label><input type="text" name="Town" maxlength="24" value="<?php echo $Town?>"/><br></br>
<input type="submit" value="Confirm Edit" name="Edit" onclick="return confirm('Confirm Update.')">


<?php
if(isset($_POST['Edit']))
{
  $FirstName=$_POST['FirstName'];
  $LastName=$_POST['LastName'];
  $Gender=$_POST['Gender'];
  $Phone=$_POST['PhoneNumber'];
  $Country=$_POST['Country'];
  $Town=$_POST['Town'];
  $Image=$_FILES['image']['name'];
  $Image=addslashes(file_get_contents($_FILES['image']['tmp_name']));

if(empty($FirstName)||empty($LastName)||empty($Email)||empty($Gender)||empty($Country)||empty($Town))
{
  if(empty($FirstName)){print "<font color='red'><br></br>*Fill in the FirstName.</font><br></br>";}
  if(empty($LastName)){print "<font color='red'>*Fill in the LastName.</font><br></br>";}
  //if(empty($Phone)){print "<font color='red'>*Fill in the Phone.</font><br></br>";}
  if(empty($Gender)){print "<font color='red'>*Select the Gender.</font><br></br>";}
  if(empty($Country)){print "<font color='red'>*Fill in the Country.</font><br></br>";}
  if(empty($Town)){print "<font color='red'>*Fill in the Town.</font><br></br>";}

}else

{

    if($Update =mysqli_query($Connect,"UPDATE `users` SET FirstName ='$FirstName',LastName='$LastName',Gender='$Gender',PhoneNumber='$Phone',Country='$Country',Town='$Town',Image='$Image' WHERE Email ='$Profile'"))
      {

      header("Location:Profile.php");

      }else{echo"Unable to Update record.";}

}


}

 ?>
</form>
</htmL>
