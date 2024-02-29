<?php
$servername = "localhost";
	$dbname = "capstone";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if(!$conn){
		echo "<script> alert('Connection failed.)</script>";
	}

	if($conn->connect_error){
		die("Connection failed:" . $conn->connect_error);
	}
?>