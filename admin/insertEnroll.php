<?php

include ("../config.php");

    $cadet_id = $_POST['cadet'];
    $course_id = $_POST['course'];

    
   
    $sql = "INSERT INTO `course_enrollment` (`enrollment_id`, `cadet_id`, `course_id`, `section_marcher`, `semester`) VALUES (NULL, '$cadet_id', '$course_id', '0', 'SP24')";


    if ($conn->query($sql) === TRUE) {

        header("adminOrderSM.php");


        echo "<script> alert('Account Successfully Created.)</script>";
        header('Location: enrollCadets.php');
    
        exit;
    }

    else { 
    echo "<script> alert('Account was not created. Please try again.)</script>";
} 


?>