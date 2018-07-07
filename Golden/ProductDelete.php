<?php
require_once 'Connection.php';
if(isset($_POST['check']))
{
  $Check =count($_POST['check']);
  for($i=0;$i<$Check;$i++)
  {
  if($Delete = mysqli_query($Connect,"DELETE FROM `products` WHERE Product_ID ='{$_POST['check'][$i]}'"));
  }

  echo"<b>Product Deleted.</b>";
  header("Refresh:1;url=Add_Product.php");

}else
{

    echo "<b>Unable to Delete Product.</b>";
    header("Refresh:1;url=Add_Product.php");
}


 ?>
