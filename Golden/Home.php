<?php
require 'Connection.php';
session_start();
$Profile = $_SESSION['User_Email'];
if(isset($Profile))
{
  $Select =mysqli_query($Connect,"SELECT * FROM `users` WHERE Email ='$Profile'");
  while($row=mysqli_fetch_array($Select)){$FirstName=$row['FirstName'];$LastName=$row['LastName'];$Image=$row['Image'];}
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
   .Image
   {
    display: inline-block;

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

   .Gallery
   {
    margin-top: 200px;
    margin-left:10%;
    margin-right:20%;

   }
   .Information_body
   {
     margin-top:14%;
     height:100%;
  	 width:80%;
	   background-color:#e0f4fb;
     margin-left:10%;
	   margin-right:20%;
	   box-shadow: 1px 1px 1px 1px #665544;
	   -moz-box-shadow: 1px 1px 1px 1px #665544;
	   -webkit-box-shadow: 1px 1px 1px 1px #665544;
	   border-radius:4px;
   }
   </style>
</head>

<header>
<?php echo "<a href ='Profile.php'>".$FirstName." ".$LastName. "</a>" ?>

  <ul>
    <a href ='Profile.php'><img src="<?php echo 'data:images/jpeg;base64,'.base64_encode($Image).''?>" height="80px" width="80px" onerror=this.src="Images/Error.png" class="profilepic" style="border-radius:10%"/></a>
    <li><a href="Home.php"><img src="Icons/Home.png" width="40px" height="40px" class="icon_home"/><br>Home</a></li>
    <li><a href=""><img src="Icons/Store.png" width="40px" height="40px" class="Online"/></br>OnlineStore</a></li>
    <li><a href=""><img src="Icons/Download.png" width="40px" height="40px" class="Downloads"/></br>Downloads</a></li>
    <li><a href=""><img src="Icons/About.png" width="40px" height="40px" class="About"/></br>About us</a></li>
    <li><a href=""><img src="Icons/Contact.png" width="40px" height="40px" class="Contact"/></br>Contact us</a></li>
    <li><button class="Login" value="Login"><a href="Login.php">Login/Register</label></button></br></a></li>
  </ul>
</header>
<body>
  <ul class="Gallery">
  <li class"Image">

          <img src="" width="200px" height="200px"/>

  </li>

  <li class"Image">

          <img src="" width="200px" height="200px"/>

  </li>

  <li class"Image">

          <img src="" width="200px" height="200px"/>

  </li>

  <li class"Image">

          <img src="" width="200px" height="200px"/>

  </li>

  <li class"Image">

          <img src="" width="200px" height="200px"/>

  </li>

  <li class"Image">

          <img src="" width="200px" height="200px"/>

  </li>

  </ul>

  </div>

  <div class="Information_body">

  </div>
</body>
</html>
