<?php

$username = "";
$password = "";
$hostname = "127.0.0.1";	
$database = "";

mysql_connect($hostname, $username, $password) or die(mysql_error());
mysql_select_db($database) or die(mysql_error()); 

?>