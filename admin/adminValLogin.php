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

	$username = $_POST['email'];
	$password = $_POST['password'];
	$error = "Admin username/password is incorrect.";

	$sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";

	$result = $conn->query($sql);
	
	if($result->num_rows > 0){
		header('Location: adminHome.php');
		$_SESSION['loggedIn'] = true;
		exit;
	}
	else{
		$_SESSION["error"] = $error;
    	header("location: index.php");
    }
}
?>