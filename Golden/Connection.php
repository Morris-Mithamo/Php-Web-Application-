<?php

$DB_Hostname = 'localhost';
$DB_Username = 'root';
$DB_Password = '';
$Database = 'golden_database';

if($Connect =mysqli_connect($DB_Hostname,$DB_Username,$DB_Password,$Database))
{

//print "<font color ='green'> • </font>";

}else

{
  //print "<font color ='red'> • </font>";
  die("<b>Unable to establish a connection to the Database:<b>".mysqli_error());
}


?>
