<?php
session_start();
include ("../config.php");

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
 		$time = date("H:i:s");
 		$cadet_id = $row['id_number'];

 		if($comments[$count] == '0'){
 			$comment[$count] = '';
 		}
	else{
		$comment = $comments[$count];
	}
	
	$cadet_status = $status[$count++];

	$sql = "INSERT INTO `accountability` (`accountability_id`, `date`, `time`, `course_id`, `cadet_id`, `status`, `comments`, `submitted_by`, `submitted_by_role`) VALUES (NULL, '$date', '$time', '$course_id', '$cadet_id', '$cadet_status', '$comment', '$id_number', 'Cadet')";


	
	
	if($conn->query($sql)){
		
	}else{
		echo "<script> alert('Error: Accountability Not Submitted!'); window.location = 'newCourse.php';</script>";
		exit;
	}
      }
 
}

echo "<script> alert('Accountability Submitted!'); window.location = 'cadetHome.php';</script>";

?>