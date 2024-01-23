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

	$sql = "SELECT * FROM cadets WHERE email = ? AND password = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $email, $password);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$first_name = $row["first_name"];
		$id_number = $row["id_number"];
		header('Location: cadet/cadetHome.php');
		$_SESSION['email'] = $email;
		$_SESSION['id_number'] = $id_number;
		$_SESSION['first_name'] = $first_name;
		$_SESSION['loggedIn'] = true;
		$_SESSION['privilege'] = "Cadet";

		exit;
	}

	$sql = "SELECT * FROM secretary WHERE email = ? AND password = ?";

	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $email, $password);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$first_name = $row["first_name"];
		$id_number = $row["id_number"];
  		header('Location: secretary/sectHome.php');
		$_SESSION['email'] = $email;
		$_SESSION['id_number'] = $id_number;
		$_SESSION['first_name'] = $first_name;
		$_SESSION['loggedIn'] = true;
		$_SESSION['privilege'] = "Sec";
		exit;
	}

	$sql = "SELECT * FROM commstaff WHERE email = ? AND password = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $email, $password);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$first_name = $row["first_name"];
		$id_number = $row["id_number"];
  		header('Location: comm/commStaffHome.php');
		$_SESSION['email'] = $email;
		$_SESSION['id_number'] = $id_number;
		$_SESSION['first_name'] = $first_name;
		$_SESSION['loggedIn'] = true;
		$_SESSION['privilege'] = "COMM";

		exit;

	}
	$_SESSION["error"] = $error;
	header("location: login.php");
}
?>