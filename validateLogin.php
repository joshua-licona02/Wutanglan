<?php
	session_start();
	include "config.php";
	
	if(isset($_POST['submit'])){

	$email = $_POST['email'];
	$password = $_POST['password'];

	$hash = password_verify($password, '$2y$10$Ys/S93NgEB63/cl0.hMoguCWMh8S6TA6rYWcGd7cYezyE4V3ZxBBa');

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

	$sql = "SELECT * FROM professor WHERE email = ? AND password = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ss", $email, $password);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$first_name = $row["first_name"];
		$last_name = $row["last_name"];
		$title = $row["title"];
		$prof_name = $title." ".$first_name." ".$last_name;
		$id_number = $row["professor_id"];
		header('Location: professor/profHome.php');
		$_SESSION['email'] = $email;
		$_SESSION['id_number'] = $id_number;
		$_SESSION['first_name'] = $first_name;
		$_SESSION['prof_name'] = $prof_name;
		$_SESSION['loggedIn'] = true;
		$_SESSION['profDept'] = $department;
		$_SESSION['privilege'] = "Professor";

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
		$department = $row['dept'];
  		header('Location: secretary/sectHome.php');
		$_SESSION['email'] = $email;
		$_SESSION['id_number'] = $id_number;
		$_SESSION['first_name'] = $first_name;
		$_SESSION['loggedIn'] = true;
		$_SESSION['secDept'] = $department;
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