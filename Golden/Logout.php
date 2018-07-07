<<?php
Session_start();
unset($_SESSION['User_Email']);
session_destroy();
header("Location:Profile.php");
?>
