<?php
 
//MySQLi Procedural
$conn = mysqli_connect("localhost","root","root","phonebook");
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
 
?>