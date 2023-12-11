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
	date_default_timezone_set('America/New_York');

	$date = date("m/d/Y");
	$time = date("h:i:s");

	//$date = "12/11/2023";
	//$time = "10:05:00";
	$course_id = '4';
	$cadet_id = "0609724";
	$status = "Present";

	$sql = "INSERT INTO `accountability` (`accountability_id`, `date`, `time`, `course_id`, `cadet_id`, `status`) VALUES (NULL, '$date', '$time', '$course_id', '$cadet_id', '$status')";


	if($conn->query($sql)){
		echo "<script> alert('Accountability Submitted!'); window.location = 'cadetHome.php';</script>";
	}else{
		echo "<script> alert('Accountability Submitted!'); window.location = 'newCourse.php';</script>";
	}


	
?>