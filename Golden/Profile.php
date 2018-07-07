<?php require 'ProfileHome.php'; ?>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="css/GoldenLogin.css"/>
<style>
body
{
  font-family: Font;
}
@font-face
{
  font-family: Font;
  src:url('fonts/Font.ttf');

}
.Edit
{
  color:#0080FF;

}
.Edit:hover
{
  color: #000000;
}
table
{
  border-collapse: collapse;
  padding: 14px;
}


b
{
  font-family: helvetica;
  font-size: 14px;



}
.profile_box
{
  padding: 8px;
  width:400px;
  margin-top:240px;
}
.History
{
  border-collapse: collapse;
  padding:12px;
}
tr:nth-child(odd){background-color: #f4f4f4f4;padding:14px;}
td
{
padding: 14px;
}
label
{
  margin-left: 10px;
}

</style>
</head>
<?php
require 'Connection.php';
Session_start();
if(!isset($_SESSION['User_Email']))
{
  header("Location:Login.php");
}

  $Profile = $_SESSION['User_Email'];
  $Select =mysqli_query($Connect,"SELECT * FROM `users` WHERE Email ='$Profile'");
  $numrows =mysqli_num_rows($Select);
  if($numrows!=0)
  {
    while($row=mysqli_fetch_array($Select))
    {
      echo "<div class='profile_box'>";
      echo "<div class='Login_confirm'>Profile Details&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      <a href ='EditProfile.php'class='Edit'>[Edit Details]</a></div>";
      echo "<table border=1px width='400px'>";
      echo "<b><tr><td>Name:</b><label>".$row['FirstName']."&nbsp";
      echo "".$row['LastName']."</label><br></td></tr>";
      echo "<b><tr><td>Email Address:</b><label>".$row['Email']."</label><br></td></tr>";
      echo "<b><tr><td>Gender:</b> <label>".$row['Gender']."</label></td></tr><br>";
      echo "<b><tr><td>PhoneNumber:</b><label>".$row['PhoneNumber']."</label><br></td></tr>";
      echo "<b><tr><td>Country:</b><label>".$row['Country']."</label><br></td></tr>";
      echo "<b><tr><td>Town:</b><label>".$row['Town']."</label><br></td></tr>";
      echo "</table>";
      echo "</div>";

    }
  }
 ?>


<table border="1px" class="History">
<tr>
      <th><th>
      <th><th>
      <th><th>
      <th><th>
      <th><th>
      <th><th>
               </tr>

</table>
</html>
