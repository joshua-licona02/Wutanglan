<?php

include ("../config.php");

    $course_title = $_POST['course_title'];
    $major = $_POST['major'];
    $course_code = $_POST['course_code'];
    $section = $_POST['section'];
    $Monday = $_POST['Monday'];
    $Tuesday = $_POST['Tuesday'];
    $Wednesday = $_POST['Wednesday'];
    $Thursday = $_POST['Thursday'];
    $Friday = $_POST['Friday'];
    $section_start = $_POST['section_start'];
    $section_end = $_POST['section_end'];
    $semester = $_POST['semester'];
    $professor = $_POST['professor'];
    $building = $_POST['building'];
    $classroom = $_POST['classroom'];


    if($semester == "SP24"){
        $start_date = "2024-01-17";
        $end_date = "2024-05-06";
    }

    $course_days = $Monday.$Tuesday.$Wednesday.$Thursday.$Friday;

    $sql = "INSERT INTO `courses` (`course_id`, `course_title`, `course_code`, `section`, `section_day`, `section_time`, `section_end`, `date_start`, `date_end`, `professor_id`, `building`, `classroom`, `department`) VALUES (NULL, '$course_title', '$course_code', '$section', '$course_days', '$section_start', '$section_end', '$start_date', '$end_date', '$professor', '$building', '$classroom', '$major')";

    if ($conn->query($sql) === TRUE) {
    header('Location: adminAddCourse.php');
    echo "<script> alert('Account Successfully Created.)</script>";
        exit;
    }

    else { 
    echo "<script> alert('Account was not created. Please try again.)</script>";
} 

?>