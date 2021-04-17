<?php
	include('conn.php');
	
	$id=$_GET['id'];
	
	$contact_fname=$_POST['contact_fname'];
    $contact_lname=$_POST['contact_lname'];
    $contact_number=$_POST['number'];
    $category_id=$_POST['category_id'];
	
	mysqli_query($conn,"update contact set contact_fname='$contact_fname', contact_lname='$contact_lname', contact_number='$contact_number', category_id='$category_id' where contact_id='$id'");
	header('location:index.php');

?>