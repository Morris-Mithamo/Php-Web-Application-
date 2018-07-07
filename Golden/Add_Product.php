<?php
require 'Connection.php';
session_start();
//if(!isset($_SESSION['#add the Employees'])){header("Location:Mainlogin.php");}
if(!isset($_SESSION['admin_login'])){header("Location:Mainlogin.php");}
$Profile = $_SESSION['admin_login'];
$Select =mysqli_query($Connect,"SELECT * FROM `administrator` WHERE Email_Address ='$Profile'");
$numrows =mysqli_num_rows($Select);
if($numrows!=0)
{
  while($row=mysqli_fetch_array($Select))
  {
    $User =$row['Administrator_Name'];
  }
}
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
</style>
<script type="text/javascript">

function Product_Edit()
{

document.getElementById('ProductEdit').style.display="block";

}
</script>
<link rel="stylesheet" type="text/css"  href="css/Product.css"/>
<link rel="stylesheet" type="text/css" href="css/GoldenLogin.css"/>
</head>
<h2><div class="Login_confirm">List of Items</div></h2>
<!---THE SEARCH PART-->
<form action="Add_Product.php" method="post" class="Search_code">

     <fieldset class="Search_code">
        <legend>Search Product Code</legend>
        <input type="checkbox"  name="checkcode" value="">
        <input type="text" name="search_code" placeholder="product code"><br></br>
     </fieldset><!--SEARCH USING CODE-->
     <fieldset class="Search_name">
        <legend>Search Product Name</legend>
        <input type="checkbox" name="checkname" value="">
        <input type="text" name="search_code" placeholder="product name"><br></br>
     </fieldset>
<br><input type="submit" value="Search product" name="search">
</form>
<div class="Scrollbar" style="overflow:scroll;height:200px;width:84%;border:2px solid black;">
  <?php
 if(isset($_POST['search']))
 {
   $Code =$_POST['search_code'];
   if($Select =mysqli_query($Connect,"SELECT * FROM `Products` WHERE Product_Code ='$Code'"))
   {
     echo"true";
   }

 }

   ?>
<table border="2px" style="border-collapse:collapse;">

 <th>Image</th>
 <th>Product ID</th>
 <th>Stock</th>
 <th>Product Category</th>
  <th>Product Serial</th>
 <th>Product Code</th>
 <th>Product Name</th>
 <th>Product Details</th>
 <th>Product Price</th>
 <th>Added by</th>
 <th>Date Added</th>
 <th>Select</th>


<?php

$Products =mysqli_query($Connect,"SELECT * FROM `products`");
$numrows=mysqli_num_rows($Products);
if($numrows!=0)
{
  while($rows=mysqli_fetch_array($Products))
  {
    echo "<tr>";
    echo '<td><img src="data:images/jpeg;base64,'.base64_encode($rows['Image']).'"height="40px" width="40px" style="border-radius:60%"></td>';//Add the image later
    echo "<td>".$rows['Product_ID']."</td>";
    echo "<td>".$rows['Stock']."</td>";
    echo "<td>".$rows['Product_Category']."</td>";
    echo "<td>".$rows['Product_Serial']."</td>";
    echo "<td>".$rows['Product_Code']."</td>";
    echo "<td>".$rows['Product_Name']."</td>";
    echo "<td>".$rows['Product_Details']."</td>";
    echo "<td>".$rows['Procuct_Price']."<b>".$rows['Currency']."</b>"."</td>";
    echo "<td>".$rows['Product_Added_By']."</td>";
    echo "<td>".$rows['Date_Added']."</td>";
    ?>
    <form action="ProductDelete.php" value="<?php echo $rows['Product_ID'];?>" method="post">
    <td><input type="checkbox" value="<?php echo $rows['Product_ID'];?>" name="check[]">
    </td>
    </tr>
    <?php
  }
}else
{
  echo "<b><th class='Empty'>No product is Currently Available in the Database.</th></b>";
}

 ?>
</table>
</div>
<br><input type="submit" name="Delete" class="Delete" value="Delete Selected" onclick="return confirm('Confirm that you want to Delete the selected.')"><br></br>
</form>

<div class="ProductBox">
  <div class="label">Add a Product</div>
<form action="Add_product.php" method="post" enctype="multipart/form-data">
<label>Product Image</label><input type="file" name="image" class="currency"><br></br>
<label>Product Availability:</label> <select name="Stock" class="currency">
          <option value="In Stock">In Stock</option>
          <option value="Out of Stock">Out of Stock</option>
    </select><br></br>
<label>Product Category:</label> <select name="Category" class="currency">
        <option value=""></option>
        <option value="HandWorks">HandWorks</option>
        <option value="Clothes">Clothes</option>
        <option value="Shoes">Shoes</option>
        <!--<option value=""></option>-->
  </select><br></br>
  <label>Product Code: </label><input type="text" name="Product_Code" maxlength="12"/><br></br>
  <label>Product Name: </label><input type="text" name="Product_Name" maxlength="12"/><br></br>
  <label>Product Details: </label><input type="text" name="Product_Details" /><br></br>
  <label>Product Price: </label><input type="text" name="Product_Price"/><select class="currency" name="currency"><option value="US$">$</option><option value="Ksh">Ksh</option></select></label><br></br>
  <input type ="submit" name="Confirm" value="Confirm Product" onclick="return confirm('Confirm Product Entry.')"/><br>
  <!--<label>FirstName:</label><input type="text" name="FirstName" /><br></br>
  <label>FirstName:</label><input type="text" name="FirstName" /><br></br>-->

<?php
if(isset($_POST['Confirm']))
{
$Image=$_FILES['image']['name'];
$Image=addslashes(file_get_contents($_FILES['image']['tmp_name']));
$ProductCategory =$_POST['Category'];
$ProductCode =$_POST['Product_Code'];
$ProductName=$_POST['Product_Name'];
$ProductDetails=$_POST['Product_Details'];
$ProductPrice=$_POST['Product_Price'];
$ProductAvailability=$_POST['Stock'];
$Currency=$_POST['currency'];
$Added_by =  $User;
  $ProductSerial =(int)$ProductCode+(int)$ProductPrice+(int)$ProductName;
  $Serial =str_shuffle($ProductSerial);
  $Serial =substr($ProductSerial,0,12);


  if(empty($ProductCode)||empty($ProductName)||empty($ProductDetails)||empty($ProductPrice)||empty($ProductCategory)||empty($Image))
       {
                   print "<font color='red'>*Unable to Add product:.</font><br></br>";
                   if(empty($Image)){print "<font color='red'>*Upload the Product Image.</font><br></br>";}
                   if(empty($ProductCode)){print "<font color='red'>*Enter the Product Code.</font><br></br>";}
                   if(empty($ProductName)){print "<font color='red'>*Fill in the Product Name.</font><br></br>";}
                   if(empty($ProductDetails)){print "<font color='red'>*Fill in the Product Details.</font><br></br>";}
                   if(empty($ProductPrice)){print "<font color='red'>*Fill in the Product Price.</font><br></br>";}
                   if(empty($ProductCategory)){print "<font color='red'>*Select the Product Category.</font><br></br>";}
       }else

       {

      if($Product =mysqli_query($Connect,"INSERT INTO `products` (Image,Product_Category,Product_Serial,Product_Code,Product_Name,Product_Details,Procuct_Price,Currency,Product_Added_By,Stock)
      VALUES ('$Image','$ProductCategory','$Serial','$ProductCode','$ProductName','$ProductDetails','$ProductPrice','$Currency','$Added_by','$ProductAvailability')"))
           {
              header("Refresh:2;url=Add_Product.php");
           }else
           {
           echo "Failure";
           }
       }


}
 ?>
</div>
</form>
