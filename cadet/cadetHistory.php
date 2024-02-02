<?php
    session_start();
    if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "Cadet") {
    //allow
    }
    else{
    
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

    $id = $_SESSION['id_number'];
    $sql = "SELECT cadet_id, section_marcher, semester, cadets.first_name as cadet_first, cadets.last_name as cadet_last,course_title,course_code, section, courses.department, title, professor.first_name, professor.last_name, courses.section_day, courses.section_time, courses.section_end, courses.course_id from course_enrollment join cadets on course_enrollment.cadet_id = cadets.id_number join courses on courses.course_id = course_enrollment.course_id join professor on professor.professor_id = courses.professor_id where cadet_id = '$id' and section_marcher != 0 order by section_marcher";

    $result = $conn->query($sql);
    $num_of_courses = 0;
    $course_ids = array();
    $full_codes = array();
    
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {

            $num_of_courses++;
            $course_id = $row['course_id'];
            $department = $row['department'];
            $course_code = $row['course_code'];
            $course = $row['course_title'];
            $section = $row['section'];
            if($section < 10){
                $section = '0'.$section;
            }
            $full_code = $department . " " .$course_code . "-" . $section;
            $section_marcher = $row['section_marcher'];
            $course_ids[] = $row['course_id'];
            $full_codes[] = $full_code;
        }
    }
    date_default_timezone_set('America/New_York'); // Eastern Time

    $info = getdate();
    $date = $info['mday'];
    $month = $info['mon'];
    $year = $info['year'];
    $hour = $info['hours'];
    $min = $info['minutes'];
    $sec = $info['seconds'];


    if($hour < 10){
        $hour = '0'.$hour;
    }
    if($min < 10){
        $min = '0'.$min;
    }
    if($sec < 10){
        $sec = '0'.$sec;
    }
    $current_date = "$year-$month-$date";
    $current_date_time = "$date/$month/$year == $hour:$min:$sec";

    function getWeekday($date) {
        return date('w', strtotime($date));
    }

    /*switch(getWeekday($current_date)){
        case 0: echo "Sunday"; break;
        case 1: echo "Monday"; break;
        case 2: echo "Tuesday"; break;
        case 3: echo "Wednesday"; break;
        case 4: echo "Thursday"; break;
        case 5: echo "Friday"; break;
        case 6: echo "Saturday"; break;
    }
    */

?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VMI E-Section Marcher</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href="style.css" rel="stylesheet"/>
</head>
<body>
    <div class = "header">
            <img id = "mainImg" src = "vmilogo.svg" id = "logo">
            <h1 id = "esection">E-Section Marcher</h1>
    </div>

    <div class="navbar">
        <a href = "cadetHome.php">Home</a>
        <div class="dropdown">
            <button class="dropbtn" onclick="myFunction()">Courses
            <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content" id="myDropdown">
                <?php 

                
               
                    for($i=0; $i<count($course_ids); $i++){
                    echo "<a href = 'newCourse.php?a=$course_ids[$i]'>$full_codes[$i]</a></td>";
                }
                
                
            ?>
            </div>
        </div> 
        <a class = "active">History</a>
        <a href = "cadetInstructions.php">Instructions</a>
        <a href="cadetInfo.php">Cadet Info</a>
        <a id = "logout" href="../logout.php">Logout</a>
    </div>

    <script>
    /* When the user clicks on the button, 
    toggle between hiding and showing the dropdown content */
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(e) {
      if (!e.target.matches('.dropbtn')) {
      var myDropdown = document.getElementById("myDropdown");
        if (myDropdown.classList.contains('show')) {
          myDropdown.classList.remove('show');
        }
      }
    }
    </script>


    <div style="padding: 2%;">

        <center>
            <?php 

            $sql = "select first_name, last_name from cadets where id_number = '$id'";
            $result = $conn->query($sql);

             if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                   
                   $cadet_name = $row['first_name']." ".$row['last_name'];

                }
            }

            echo "<h2>Reports submitted by Cadet $cadet_name</h2>";

            ?>
            
            
            <table class = "cadet_courses" style = "width: 50%;">
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Course</th>
                    <th>Faculty</th>
                </tr>
                
           
            <?php

            //$sql = "select * from accountability join courses on accountability.course_id = courses.course_id join professor on courses.professor_id = professor.professor_id where submitted_by = '$id' group by date";
            
            $sql = "select * from accountability join courses on accountability.course_id = courses.course_id join professor on courses.professor_id = professor.professor_id where submitted_by = '$id' group by courses.course_id, date order by date desc, time desc ";


            $result = $conn->query($sql);

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {

                    $date = $row['date'];
                    $time = $row['time'];
                    $course_id = $row['course_id'];
                    $course_title = $row['course_title'];
                    $course_code = $row['course_code'];
                    $course_section = $row['section'];
                    if($course_section < 10){
                        $course_section = "0".$course_section;
                    }

                    $department = $row['department'];
                    $course = $department . " ".$course_code."-".$course_section;

                    $faculty = $row['title'] . " " . $row['first_name']. " " . $row['last_name'];
                    $account_id = $row['accountability_id'];

                    echo "<tr><td><a href = 'courseHistory.php?a=$account_id&b=$course_id&c=$date'>$date</a></td>";

                    //need this to happen on click
                    //$_SESSION['course_id'] = $course_id;
                    //$_SESSION['account_date'] = $date;
                    
                    echo "<td>$time</td>";
                    echo "<td>$course</td>";
                    echo "<td>$faculty</td></tr>";
                }
            }
            
            ?>
        </table>
        </center>
    </div>
</body>
</html>