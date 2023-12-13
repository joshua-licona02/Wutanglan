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

    //now need to edit to where it does this for all courses

    $sql = "SELECT course_id FROM courses";

    $course_ids = array();


    $result = $conn->query($sql);
    
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {

            $course_ids[] = $row['course_id'];
        }
    }

    $num_of_courses = count($course_ids);
    
    for($i = 0; $i < $course_ids[$num_of_courses - 1]; $i++){

        $sql = "UPDATE course_enrollment ce JOIN (SELECT RANK() OVER (ORDER BY rank_id, cadets.class, cadets.last_name) AS num, course_enrollment.cadet_id, course_enrollment.course_id FROM cadets JOIN course_enrollment ON cadets.id_number = course_enrollment.cadet_id JOIN rank ON rank.rank = cadets.rank WHERE course_enrollment.course_id = $course_ids[$i] LIMIT 3) AS subquery ON ce.cadet_id = subquery.cadet_id AND ce.course_id = subquery.course_id SET ce.section_marcher = CASE WHEN subquery.num IS NOT NULL THEN subquery.num ELSE 0 END";

        $result = $conn->query($sql);
    }

    header("Location: adminHome.php");
    exit();

?>