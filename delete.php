<?php
	include('conn.php');

	$id=$_GET['id'];

	mysqli_query($conn,"delete from contact where contact_id='$id'");
	header('location:index.php');

?>