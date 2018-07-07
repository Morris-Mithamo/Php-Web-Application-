<?php
require_once 'Connection.php';
$Select =mysqli_query($Connect,"SELECT * FROM `products` WHERE Edit ='{$_POST['Edit']}'");



 ?>
