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
$account_id = $_SESSION['accountability'];
$account_date = $_SESSION['account_date'];


$cadets_in_course = array();
$count = 0;

$sql = "SELECT * FROM cadets JOIN rank on cadets.rank=rank.rank join course_enrollment on course_enrollment.cadet_id = cadets.id_number where course_id = '$course_id' order by rank_id, class, last_name";

$result = $conn->query($sql);

$num_of_students = $result->num_rows;

 if($result->num_rows > 0){
 	while($row = $result->fetch_assoc()) {
 		date_default_timezone_set('America/New_York');
 		$date = date("m/d/Y");
 		$time = date("H:i:s");
 		
 		$cadet_id = $row['id_number'];
 		$cadets_in_course[] = $cadet_id;

 		if($comments[$count] == '0'){
 			$comment[$count] = '';
 		}
	else{
		$comment = $comments[$count];
	}

	$cadet_status = $status[$count++];
	}
}

	$sql = "select accountability_id from accountability join cadets on accountability.cadet_id = cadets.id_number JOIN courses on courses.course_id = accountability.course_id JOIN rank on rank.rank = cadets.rank where accountability_id >= '$account_id' AND date = '$account_date' AND accountability.course_id = '$course_id' order by rank_id, class, last_name";

	$accountability_ids = array();
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()) {

			$accountability_ids[] = $row['accountability_id'];

		}
 	}

 	$error = false;

 	for($i = 0; $i<count($accountability_ids); $i++){

 		$current_id = $accountability_ids[$i];
 		$current_cadet = $cadets_in_course[$i];
 		$current_status = $status[$i];
 		$current_comment = $comments[$i];
 		
 		$sql = "UPDATE accountability SET date = '$date', time = '$time', course_id = '$course_id', cadet_id = '$current_cadet', status = '$current_status', comments = '$current_comment', submitted_by = '$id_number' WHERE accountability.accountability_id='$current_id'";
 		if($conn->query($sql)){
 			continue;
		}
		else{
			echo "<script> alert('Error: Accountability Not Updated!'); window.location = 'newCourse.php';</script>";
			break;
		}
	}	

 	echo "<script> alert('Accountability Updated Successfully!'); window.location = 'cadetHistory.php';</script>";
 	

?>