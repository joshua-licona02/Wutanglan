<?php

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

    $cadet_id = $_POST['cadet'];
    $course_id = $_POST['course'];

    
   
    $sql = "INSERT INTO `course_enrollment` (`enrollment_id`, `cadet_id`, `course_id`, `section_marcher`, `semester`) VALUES (NULL, '$cadet_id', '$course_id', '0', 'SP24')";


    if ($conn->query($sql) === TRUE) {
        echo "<script> alert('Account Successfully Created.)</script>";
        header('Location: enrollCadets.php');
    
        exit;
    }

    else { 
    echo "<script> alert('Account was not created. Please try again.)</script>";
} 


?>