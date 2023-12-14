<?php
	session_start();
if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "COMM") {
//allow
}else{
    
    echo "<script> alert('No user is logged in. Please login using your VMI credentials!'); window.location = 'login.php';</script>";
    
}

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

    if(isset($_GET['a'])){
    $date = $_GET['a'];
    }

    $sql = "SELECT accountability_id, accountability.date as date_submitted, accountability.time as time_submitted, submitted_by, accountability.course_id, courses.course_title, courses.department, courses.course_code, courses.section, section_time, cadets.first_name, cadets.last_name, cadets.class, status, comments from accountability JOIN cadets ON accountability.cadet_id = cadets.id_number join courses on accountability.course_id = courses.course_id where accountability.date = '$date' ORDER BY accountability.time desc,'date', course_id, section_time ";

    $result = $conn->query($sql);

    
	
?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VMI E-Section Marcher</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href="style.css" rel="stylesheet"/>
</head>

<center>
	<h1>Accountability Report for <?php echo $date?></h1>
	
	<table class = "comm_daily_report">
		
		<?php
		if($result->num_rows > 0){
			echo "<h2>Report only reflects cadets that were not marked 'Present'</h2>";
			echo "<h3>Late: <5 mins late<br> Late Late: 5-15 mins late<br> Absent: >15 mins late or not present for entire duration of class </h3>";
			echo "<tr>";
			echo "<th>Accountability ID</th>";
			echo "<th>Date Submitted</th>";
			echo "<th>Time Submitted</th>";
			echo "<th>Submitted by ID</th>";
			echo "<th>Course ID</th>";
			echo "<th>Course Title</th>";
			echo "<th>Course Code</th>";
			echo "<th>Section Time</th>";
			echo "<th>First Name</th>";
			echo "<th>Last Name</th>";
			echo "<th>Class</th>";
			echo "<th>Status</th>";
			echo "<th>Comments</th>";
		echo "</tr>";




        while($row = $result->fetch_assoc()) {
        	//submission info
        	$accountability_id = $row['accountability_id'];
        	$date_submitted = $row['date_submitted'];
        	$time_submitted = $row['time_submitted'];
        	$submitted_by_id = $row['submitted_by'];
        	//course info
        	$course_id = $row['course_id'];
        	$course_title = $row['course_title'];
        	$course_id = $row['course_id'];
        	$course_dept = $row['department'];
        	$course_code = $row['course_code'];
        	$section = $row['section'];
        	$comments = $row['comments'];


        	if($section < 10){
                            $section = '0'.$section;
             }

        	$section_time =  $row['section_time'];
        	//cadet info
			$first_name = $row['first_name'];
        	$last_name = $row['last_name'];
        	$cadet_class = $row['class'];
        	$status = $row['status'];

        	if($status != "Present"){
   
		echo "<tr>";
		echo "<td>$accountability_id</td>";
		echo "<td>$date_submitted</td>";
		echo "<td>$time_submitted</td>";
		echo "<td>$submitted_by_id</td>";
		echo "<td>$course_id</td>";
		echo "<td>$course_title</td>";
		echo "<td>$course_dept " . "$course_code"."-$section</td>";
		echo "<td>$section_time</td>";
		echo "<td>$first_name</td>";
		echo "<td>$last_name</td>";
		echo "<td>$cadet_class</td>";
		echo "<td>$status</td>";
		echo "<td>$comments</tr>";

	}
}
}
else{
	echo "<h2 style = 'color: Red'>No Section Marcher Reports were submitted.</h2>";
}
		?>



	</table>


</center>

</html>