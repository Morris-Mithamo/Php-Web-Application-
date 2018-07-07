<?php
require_once 'Connection.php';
?>
<html lang="en">
<head>
<style>
@font-face
{
  font-family:Font;src:url('fonts/Font.ttf');
}
  td
  {
  padding: 14px;
  font-family: Font;
  border-collapse: collapse;
  }
  th
  {
    font-family: sans-serif;
    font-size:14px;
    padding: 4px;
    background-color: #008ECC;
    color: #ffffff;

  }


  </style>
</head>
<?php
$Page=$_GET["Page"];
if($Page==""||$Page=="1")
{
    $Page=0;

}else
{
  $PageNum=($Page*2)-2;
}
$Products =mysqli_query($Connect,"SELECT * FROM `products`LIMIT $PageNum,4");
$numrows=mysqli_num_rows($Products);
if($numrows!=0)
{
  while($rows=mysqli_fetch_array($Products))
  { echo "<table border=1px width='auto'style='border-collapse:collapse'>";
    echo "<th>Image</th>";
    echo "<th>Stock</th>";
    echo "<th>Product Category</th>";
    echo "<th>Product Code</th>";
    echo "<th>Product Name</th>";
    echo "<th>Product Details</th>";
    echo "<th>Product Price</th>";
    echo "<th>Product Price</th>";
    echo "<tr>";
    echo '<td><img src="data:images/jpeg;base64,'.base64_encode($rows['Image']).'"height="100px" width="100px" style="border-radius:4%"></td>';//Add the image later
    echo "<td>".$rows['Stock']."</td>";
    echo "<td>".$rows['Product_Category']."</td>";
    echo "<td>".$rows['Product_Code']."</td>";
    echo "<td>".$rows['Product_Name']."</td>";
    echo "<td>".$rows['Product_Details']."</td>";
    echo "<td>".$rows['Procuct_Price']."<b>".$rows['Currency']."</b>"."</td><br></br>";
    ?>

    <td>
      <a href="">View Product</a><br></br><!--View the product..comeback later link-->
    <form action="" name ="" method="post">
        <input type="submit" Value="Add To Cart" name="Cart">
        <input type="hidden" name ="Email" value="">
    </form>
    </td>

    <?php
  }
    ?>

<?php

}
    ?>


<?php
    $Num =$numrows/2;
    $Num= ceil($Num);

    for($i=1;$i<=$Num;$i++)
    {
      ?><a href="OnlineStore.php?Page=<?php echo $Num ?>" style="text-decoration:none;"><?php echo $i.' '?></a><?php
    }
?>
