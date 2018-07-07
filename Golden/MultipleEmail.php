<?php
require 'Connection.php';
session_start();
if(isset($_SESSION['User_Email'])) //Logs out if user is logged in.
{
  header("Location:Mainlogin.php");
}
$profile = $_SESSION['admin_login'];
if(!isset($_SESSION['admin_login']))
{
  header("Location:Mainlogin.php");
}
$Select =mysqli_query($Connect,"SELECT * FROM `administrator` WHERE Email_Address = '$profile' ");
while($row = mysqli_fetch_array($Select))
{
  $Username = $row['Username'];
}
?>
<html>
<title>MultipleEmail: <?= $Username?></title>
<head>
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
@font-face
{
  font-family: Font;
  src:url('fonts/Font.eot');
}
.container
{

}
.table
{
  border-collapse: collapse;

}
th
{
  font-family:helvetica;
  font-size: 14px;
  padding: 6px;
  background-color:#0080FF;
  color:#ffffff;
}
td
{
  padding: 2px;
}
/*tr:hover
{
cursor:pointer;
background-color:#81D8D0;
}*/
tr:nth-child(odd){background-color:#f4f4f4;}
input[type='submit']
{
border-radius:4px;
cursor:pointer;
padding: 10px;
background-color: #b80f0a;
border: 2px solid #b80f0a;
color:#ffffff;
}
input[type='submit']:hover
{
background-color: #7C0A02;
border: 2px solid #7C0A02;
}
input[type='submit']:focus
{
border: 2px solid #7C0A02;
background-color: #7C0A02;
outline-color: #7C0A02;
}
.Header
{
  width: 100%;
  height: 20px;
  top:0px;
  left:0px;
  position: fixed;
  padding: 16px;
  border: solid 1px #000000;

}
.Label_Email
{
  top:4px;
  position: fixed;
  left:54px;
}
.Label_Username
{
  top:24spx;
  position: fixed;
  left:54px;
}
.Profile_pic
{
  position: fixed;
  left:2px;
  top: 2px;
}
.Container
{
  top:60px;
}
.Logout
{
  text-decoration: none;
  color:#000080;
  position: fixed;
  right: 2%;

}
.Logout:hover
{
  color:#0080FF;
}

</style>

</head>
<div class="Header">
<img src="" height="50px" width="50px" class="Profile_pic" onerror="this.src='Images/Error.png'">
<label class="Label_Email"><?php echo"Email: $profile"?></label><a href ="Mainlogout.php" class="Logout">Logout</a>
<br><label class="Label_Username"><?php echo "$Username"?></label><!--<a href ="SendEmail.php">Email</a></br>-->
</div><br><br></br></br>
<div class="Container">
<div class="Scrollbar" style="overflow-y:scroll;height:400px;width:100%;border:2px solid black;">
<table class="table" border ="2px">

  <th>ID</th>
  <th>FirstName</th>
  <th>LastName</th>
  <th>Email</th>
  <th>Gender</th>
  <th>PhoneNumber</th>
  <th>Country</th>
  <th>Town</th>
  <th>Password</th>
  <th>Select</th>
  <?php

  $Users = mysqli_query($Connect,"SELECT * FROM `users`");
  $numrows =mysqli_num_rows($Users);
  print "<br>Number of Registered users:".$numrows."</br><br>";
  if($numrows!=0)
  {
    while($row=mysqli_fetch_array($Users))
    {



       print "<tr>";
       Print "<td>".$row['ID']."</td>";
       print "<td>".$row['FirstName']."</td>";
       print "<td>".$row['LastName']."</td>";
       print "<td>".$row['Email']."</td>";
       print "<td>".$row['Gender']."</td>";
       print "<td>".$row['PhoneNumber']."</td>";
       print "<td>".$row['Country']."</td>";
       print "<td>".$row['Town']."</td>";
       print "<td>".$row['Password']."</td>";

  ?>
       <td><form action="SendMultipleEmails.php" value="<?php echo $rows['Email'];?>" method="post">
           <input type="checkbox" value="<?php echo $rows['Email'];?>" name="check[]">

      </td>

<?php print "</tr>"; } ?>

<?php

  }else

  {
    echo "<b><br><br>There are no Users to display at this moment.</br></br></b>";
  }

   ?>

</table>
</div><br></br>
<label><b>From:</b></label><label name="from"> <?php echo $profile ?> </label><br></br>
<label><b>Subject:</b></label><input type="text" maxlength="40" name="Subject"><br></br>
<label><b>Message:</b></label><textarea spellcheck="true" name="Message"></textarea><br></br>
<br><input type="submit" name="Email" class="Delete" value="Send Email" onclick="return confirm('Confirm that you want to send an Email to the selected.')"><br></br>
</form>
</div>


</html>
