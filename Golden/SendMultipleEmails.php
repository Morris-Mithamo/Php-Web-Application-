<?php
require_once 'Connection.php';
require_once 'MultipleEmail.php';
if(isset($_POST['Email']))
{
  $Email =count($_POST['check']);
  for($i=0;$i<$Email;$i++)
  {

  $To =$_POST['Email'][$i];

  }

//if(mail($To,$Subject,$Text,$Headers))
//{
 echo"<b>Email Sent.$To</b>";
 //header("Refresh:1;url=MultipleEmail.php");
//}

}else
{

    echo "<b>Unable to Send Email.</b>";
    //header("Refresh:1;url=MultipleEmail.php");
}


 ?>
