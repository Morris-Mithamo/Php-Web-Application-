<?php
require_once 'Connection.php';


$Delete = mysqli_query($Connect,"DELETE FROM `users` WHERE Email ='{$_POST['Email']}' LIMIT 1");





?>
