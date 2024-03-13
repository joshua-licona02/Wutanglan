<?php
session_start();
if($_SESSION['loggedIn']) {
//allow
}else{
    
    echo "<script> alert('No user is logged in. Please login using your VMI credentials!'); window.location = 'login.php';</script>";
    
}

    include ("../config.php");

    $id = $_SESSION['id_number'];

    if(isset($_GET['submit_course'])){
        
        $selected_course = $_GET['course_select'];
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
        <a href="courseOverride.php">Course Override</a>
        <a id = "logout" href="logout.php">Logout</a>
    </div>

    <div>

        <center>
            <h2>Edit Course Enrollment</h2>
            
            <form action = 'editCourseEnrollment.php?a=<?php echo $selected_course?>' class = "edit_course" method="GET">
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
                        if($course_section < 10){
                            $course_section = '0'.$course_section;
                        }
                        $course_department = $row['department'];
                        $full_course = $course_department." ".$course_code."-".$course_section.": ".$course_title;
                        $course_id = $row['course_id'];

                        echo "<option id = 'course' value = '$course_id'>$full_course</option>";

                    }
                }
                ?>
            </select>
            <br>
            <input type = 'submit' text = "submit" name = submit_course>

        </form>


        <?php 

        if(isset($selected_course)){
            $sql = "Select * from course_enrollment join cadets on course_enrollment.cadet_id = cadets.id_number join rank on rank.rank = cadets.rank where course_id = '$selected_course' order by rank_id, class, last_name";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
            echo "<form action = 'deleteCadetsFromCourse.php' method = 'POST' >";
            echo "<table class = 'cadet_info'>";

            echo "<th>Delete</th>";
            echo "<th>Cadet Name</th>";
            echo "<th>Rank</th>";
            echo "<th>Class</th>";

                while($row = $result->fetch_assoc()) {

                    $cadet_id_temp = $row['id_number'];
                    $cadet_first = $row['first_name'];
                    $cadet_last = $row['last_name'];
                    $cadet_name = $cadet_first." ".$cadet_last;
                    $rank = $row['rank'];
                    $class = $row['class'];

                    echo "<tr>";
                    echo "<td style = 'margin-right: 10%'><input type = 'checkbox' name = 'cadet_ids[]' value = '$cadet_id_temp'></td>";
                    echo "<td>$cadet_name</td>";
                    echo "<td>$rank</td>";
                    echo "<td>$class</td>";
                    echo "</tr>";
                }
                    echo "<tr><td colspan = 4><input style = 'width: 50%' type = 'submit' value = 'Delete Cadets' name = 'checkSubmit'></td></tr>";
                    echo "</table>";
                    echo "</form>";
            }
            else{
                echo "<h1>Currently no cadets enrolled.</h1>";
            }

        }
            
        ?>
            
        </center>
    </div>
</body>
</html>