<?php
session_start();
if($_SESSION['loggedIn']) {
//allow
}else{
    
    echo "<script> alert('No user is logged in. Please login using your VMI credentials!'); window.location = 'login.php';</script>";
    
}

    include ("../config.php");

    $id = $_SESSION['id_number'];

    if(isset($_POST['submitCourse'])){
        
            $selected_course = $_POST['course_select'];
       
    }



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
        <a href="adminHome.php">Home</a>
        <a href="adminOrdersSM.html">Re-Order SM</a>
        <a href="adminAddCadets.html">Add Cadets</a>
        <a href="adminAddCourse.html">Add Courses</a>
        <a href="enrollCadets.php">Enroll Cadets</a>
        <a class = "active">Course Roster Edit</a>
        <a id = "logout" href="logout.php">Logout</a>
    </div>

    <div>

        <center>
            <h2>Edit Course Enrollment</h2>
            
            <form class = "edit_course" method="POST">
            <label>Select Course</label>
            <select name = "course_select">

                <?php 

                $sql = "Select * from courses";

                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()) {

                        $course_title = $row['course_title'];
                        $course_code = $row['course_code'];
                        $course_section = $row['section'];
                        $course_department = $row['department'];
                        $full_course = $course_department." ".$course_code."-".$course_section.": ".$course_title;
                        $course_id = $row['course_id'];

                        echo "<option value = '$course_id'>$full_course</option>";

                    }
                }
                ?>
            </select>
            <br>
            <input type = 'submit' text = "submit" name = "submitCourse">

        </form>


        <?php 

        if(isset($selected_course)){

            echo "<table class = 'cadet_info'>";

            echo "<th>Cadet Name</th>";

            $sql = "Select * from course_enrollment join cadets on course_enrollment.cadet_id = cadets.id_number where course_id = '$course_id'";

            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {

                    $cadet_first = $row['first_name'];
                    $cadet_last = $row['last_name'];
                    $cadet_name = $cadet_first." ".$cadet_last;

                    echo "<tr>";
                    echo "<td>$cadet_name</td>";
                    echo "</tr>";

                }
            }


            
            
            echo "</table>";


        }



        ?>

            
        </center>
    </div>
</body>
</html>