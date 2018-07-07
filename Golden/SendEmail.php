<?php
require 'Connection.php';
session_start();
if(!isset($_SESSION['admin_login']))
{
  header("Location:Mainlogin.php");
}
$profile = $_SESSION['admin_login'];

 ?>
 <html>
<title>[Send Email]</title>
<head>
<style>
table
{
  border-collapse: collapse;
}
</style>
</head>
<form action ="SendEmail.php" method="post">
<label><b>Email_Address:</b></label><input type="Email" size="18px" name="Email_Search">
<input type="submit" name="Search" value="Search">
</form>
<table border="2px">
<tr>
  <th>FirstName</th>
<th>LastName</th>
<th>Email</th>
<th>Country</th>
<th>Send Email</th></tr>
<?php
if(isset($_POST['Search']))
{
  $Email_Search=$_POST['Email_Search'];
  if(empty($Email_Search))
  {

   print "<b><font color='red'>*Enter the Email Address.</font>";

  }
    if($Select = mysqli_query($Connect,"SELECT * FROM `users` WHERE Email='$Email_Search'"))
    {
    while($Value = mysqli_fetch_array($Select))
        {

        print"<td>".$Value['FirstName']."</td>";
        print"<td>".$Value['LastName']."</td>";
        print"<td>".$Value['Email']."</td>";
        print"<td>".$Value['Country']."</td>";
        ?>
        <td>
           <form action="Email.php" method="post" name="<?php echo $Value['Email']?>">
           <input type ="hidden" name="Email" value="<?php echo $Value['Email']?>">
           <input type ="submit" name="Send" Value="Compose Email">
          <form>
        </td>
    <?php } ?>
<?php
     }
}



 ?>
 </table>
 </html>
