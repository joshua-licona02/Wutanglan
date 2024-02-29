<?php
	session_start();
	include ("../config.php");

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