<?php
//error_reporting(0);
$host = "localhost";
$user = "root";
$password = "";
$datbase = "dbtuts";
//mysql_connect($host,$user,$password);
//mysql_select_db($datbase);
$conn = mysqli_connect($host, $user, $password, $datbase);
if (!$conn) {
	die("Connection failed: ");
}
?>