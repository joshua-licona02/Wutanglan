<?php
session_start();
if($_SESSION['loggedIn']) {
//allow
}else{
    
    echo "<script> alert('No user is logged in. Please login using your VMI credentials!'); window.location = 'login.php';</script>";
    
}

    include ("../config.php");

    $id = $_SESSION['id_number'];

    


?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VMI E-Section Marcher | Admin Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href="style.css" rel="stylesheet"/>
</head>
<body>
    <div class = "header">
            <img id = "mainImg" src = "vmilogo.svg" id = "logo">
            <h1 id = "esection">E-Section Marcher</h1>
    </div>

    <div class="navbar">
        <a class = "active">Home</a>
        <a href="adminOrdersSM.html">Re-Order SM</a>
        <a href="adminAddCadets.html">Add Cadets</a>
        <a href="adminAddCourse.html">Add Courses</a>
        <a href="enrollCadets.php">Enroll Cadets</a>
        <a href="editCourseEnrollment.php">Course Roster Edit</a>
        <a href="courseOverride.php">Course Override</a>
        <a id = "logout" href="logout.php">Logout</a>
    </div>

    <div>

        <center>
            <h2>Welcome Admin!</h2>
            <a>Use this dashboard to add cadets and courses to VMI system, as well as enrolling cadets in courses.</a><br>
            <a> After enrolling more cadets in courses, please remember to Re-order the section marchers for all classes.
            </a>
            
        </center>
    </div>
</body>
</html>