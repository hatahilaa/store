<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "Hatahila@2017";
$mysql_database = "ciment_mgt_db";
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password) 
or die("Opps some thing went wrong");
mysqli_select_db($bd,$mysql_database) or die("Opps some thing went wrong");

?>