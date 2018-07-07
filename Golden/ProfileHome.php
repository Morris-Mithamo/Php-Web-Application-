<?php
require 'Connection.php';
session_start();
$Profile = $_SESSION['User_Email'];
if(isset($Profile))
{
  $Select =mysqli_query($Connect,"SELECT * FROM `users` WHERE Email ='$Profile'");
  while($row=mysqli_fetch_array($Select))
  {
    $FirstName=$row['FirstName'];$LastName=$row['LastName'];$Image=$row['Image'];
    //Print'<img src="data:images/jpeg;base64,'.base64_encode($row['Image']).'" height=60px width=60px class="profilepic"/></td>';
  }

}

 ?>
<html lang="en">
<title></title>
<head>

   <style>
   body
   {

   }
   header
   {
  top: 0px;
	left: 0px;
	background-color:#fff;
	position: fixed;
	height:auto;
	width:100%;
	border-radius: 0px;
	-moz-border-radius:0px;
	-webkit-border-radius:0px;
	-o-border-radius:0px;
		box-shadow: 1px 1px 1px 1px #4b4b4b;
	-moz-box-shadow: 1px 1px 1px 1px #4b4b4b;
	-webkit-box-shadow: 1px 1px 1px 1px #4b4b4b;
	-o-box-shadow:1px 1px 1px 1px #4b4b4b;
   }
   .Login
   {
     padding:12px;
     border:1px solid #c7ea46;
     border-radius: 4px;
     background-color:#c7ea46;
     color: #f4f4f4;
     font-family: Font;
   }
  .Login:hover
   {
     cursor: pointer;
     background-color:#ffffff;
     border:1px solid #000000;

   }
  .Login:focus
   {
     cursor: pointer;
     background-color:#c7ea42;
     outline-color: #c7ea46;
   }
   @font-face{font-family: Font;src:url('fonts/Font.ttf');}
   a{ text-decoration: none;padding-left:0px;}
   li{display:inline-block;padding-left:80px;font-family: Font;top:0px;}
   ul{align-items:left;margin-left:0px;}
   .lb
   {
     color:#f4f4f4;

   }
   .lb:hover
   {
     color:#000000;
   }
   .Logout
   {
    left:35%;
    color:#000000;
   }
   .Logout:hover
   {
    color:#b80f0a;
   }
   </style>
</head>
<header>
<?php echo "<a href ='Profile.php'>".$FirstName." ".$LastName. "</a>" ?>

  <ul>
    <img src="<?php echo 'data:images/jpeg;base64,'.base64_encode($Image).''?>" height="80px" width="80px" onerror=this.src="Images/Error.png" class="profilepic" style="border-radius:10%"/>
    <li><a href="Home.php"><img src="Icons/Home.png" width="40px" height="40px" class="icon_home"/><br>Home</a></li>
    <li><a href=""><img src="Icons/Store.png" width="40px" height="40px" class="Online"/></br>OnlineStore</a></li>
    <li><a href=""><img src="Icons/Download.png" width="40px" height="40px" class="Downloads"/></br>Downloads</a></li>
    <li><a href=""><img src="Icons/About.png" width="40px" height="40px" class="About"/></br>About us</a></li>
    <li><a href=""><img src="Icons/Message.png" width="40px" height="40px" class="Contact"/></br>Contact us</a></li>
    <a href="Logout.php" class="Logout">Logout</a>
  </ul>
</header>
