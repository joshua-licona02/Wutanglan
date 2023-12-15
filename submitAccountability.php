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

$status = array();
$comments = array();

foreach($_POST['status'] as $value ) {
	if($value != ""){
		$status[] = $value;
	}
}




foreach($_POST['comments'] as $value ) {
	if(!isset($value) || trim($value) == ''){
		$comments[] = 'N/A';
	}else{
		$comments[] = $value;
	}
}
$course_id = $_SESSION['course_id'];
$id_number = $_SESSION['id_number'];

$cadets_in_course = array();
$count = 0;

$sql = "SELECT * FROM cadets JOIN rank on cadets.rank=rank.rank join course_enrollment on course_enrollment.cadet_id = cadets.id_number where course_id = '$course_id' order by rank_id, class, last_name";

 $result = $conn->query($sql);

 if($result->num_rows > 0){
 	while($row = $result->fetch_assoc()) {
 		date_default_timezone_set('America/New_York');
 		$date = date("m/d/Y");
 		$time = date("h:i:s");
 		$cadet_id = $row['id_number'];


 		if($comments[$count] == '0'){
 			$comment[$count] = '';
 		}
	else{
		$comment = $comments[$count];
	}
	
	$cadet_status = $status[$count++];

	$sql = "INSERT INTO `accountability` (`accountability_id`, `date`, `time`, `course_id`, `cadet_id`, `status`, `comments`, `submitted_by`) VALUES (NULL, '$date', '$time', '$course_id', '$cadet_id', '$cadet_status', '$comment', '$id_number');";
	
	
	if($conn->query($sql)){
		echo "<script> alert('Accountability Submitted!'); window.location = 'cadetHome.php';</script>";
	}else{
		echo "<script> alert('Error: Accountability Not Submitted!'); window.location = 'newCourse.php';</script>";
	}
      }
 
}

?>