<?php
	session_start();
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

	if(isset($_POST['submit'])){

	$email = $_POST['email'];
	$password = $_POST['password'];
	$error = "Email/password is incorrect. An @vmi.edu email is required for access.";

	$sql = "SELECT * FROM cadets WHERE email = '$email' AND password = '$password'";

	$result = $conn->query($sql);
	
	if($result->num_rows > 0){
		
		$row = $row = $result->fetch_assoc();

		header('Location: cadetHome.html');
		exit;
	}
	else{
		$_SESSION["error"] = $error;
    	header("location: login.php");
	}
}
?>