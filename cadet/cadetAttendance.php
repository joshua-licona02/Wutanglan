<?php
    session_start();
    if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "Cadet") {
    //allow
    }
    else{
    
    echo "<script> alert('No user is logged in. Please login using your VMI credentials!'); window.location = 'login.php';</script>";
    }

    include ("../config.php");

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
        <a href = "cadetHistory.php">History</a>
        <a href = "cadetInstructions.php">Instructions</a>
        <a class = "active">Attendance</a>
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

            echo "<h2 style = 'background-color: black; color: white'> Cadet $cadet_name Attendance Report</h2>";

            ?>
            
            
            <table class = "cadet_courses sortable" style = "width: 50%;">
                <tr>
                    <th>Course</th>
                    <th>Faculty</th>
                    <th>Attendance Rate</th>
                    <th>Overall Attendance</th>
                </tr>
                
           
            <?php

            //$sql = "select * from accountability join courses on accountability.course_id = courses.course_id join professor on courses.professor_id = professor.professor_id where submitted_by = '$id' group by date";
            
            $sql = "select courses.course_title, courses.course_code, courses.department, courses.section, professor.first_name, professor.last_name, professor.title, courses.course_id, courses.section_day from course_enrollment join accountability on course_enrollment.cadet_id = accountability.cadet_id join courses on courses.course_id = course_enrollment.course_id join professor on professor.professor_id = courses.professor_id where course_enrollment.cadet_id = '$id' group by course_enrollment.course_id";


            $result = $conn->query($sql);

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {

                    $course_title = $row['course_title'];
                    $course_code = $row['course_code'];
                    $course_section = $row['section'];
                    $section_day = $row['section_day'];
                    if($course_section < 10){
                        $course_section = "0".$course_section;
                    }

                    $department = $row['department'];
                    $course = $department . " ".$course_code."-".$course_section;

                    $faculty = $row['title'] . " " . $row['first_name']. " " . $row['last_name'];

                    $course_id = $row['course_id'];

                    $sql = "select * from accountability where cadet_id = '$id' and course_id = '$course_id'";

                    $new_result = $conn->query($sql);

                    $cadet_present = 0;
                    $cadet_absent = 0;
                    $cadet_total = 0;

                    $isNoAttendance = "False";

                    if($new_result->num_rows > 0){
                    while($row = $new_result->fetch_assoc()) {
                        $status = $row['status'];
                        if($status == "Absent"){
                            $cadet_absent++;
                        }
                        else{
                            $cadet_present++;
                        }
                        $cadet_total++;
                    }
                }
                else{
                    $isNoAttendance = "True";
                }


                if ($isNoAttendance == "True"){
                    echo "<tr><td colspan = '4'>No Attendance Recorded.</td></tr>";
                }

                else{

                    echo "<tr><td><a href = 'courseAttendance.php?a=$course_id'>$course</a></td>";
                    echo "<td>$faculty</td>";
                    $percent = ($cadet_present/$cadet_total) * 100;
                    $percent = number_format($percent, 2);
                    
                    if($percent > 80){
                        echo "<td style = 'background-color: green'><a style = 'color: white'>$cadet_present/$cadet_total ($percent%)</a></td>";
                    }
                    else if($percent <= 80 && $percent > 70){
                        echo "<td style = 'background-color: yellow'>$cadet_present/$cadet_total ($percent%)</td>";
                    }
                    else{
                        echo "<td style = 'background-color: red'><a style = 'color: white'>$cadet_present/$cadet_total ($percent%)</a></td>";
                    }
                    
                        
                    

                    //algorithm to count total number of class days

                    //1. Check each letter
                    //2. For each day of class + 1
                    //3. Consider days where there are no classes

                    $numOfClassWeekly = strlen($section_day);

                    $totalMeetings = $numOfClassWeekly * 14;

                   
                    $overall_percent = (($totalMeetings - $cadet_absent) / $totalMeetings) * 100;
                    $overall_percent = number_format($overall_percent, 2);

                    // Apply conditional formatting based on the overall attendance percentage
                    if ($overall_percent < 80 && $overall_percent > 70) {
                        echo "<td style='background-color: yellow'>$cadet_present/$cadet_total ($overall_percent%)</td>";
                    } else if ($overall_percent <= 70) {
                        echo "<td style='background-color: red; color: white'>$cadet_present/$cadet_total ($overall_percent%)</td>";
                    } else if ($overall_percent > 80) {
                        echo "<td style='background-color: green;'><a style = 'color: white'>$cadet_present/$cadet_total ($overall_percent%)</a></td>";
                    }
                }
                }
            }


            ?>
        </table>

        <h3 style = 'color: white; margin-left: 10%; margin-right: 10%; background-color: #ae122a;'>Note: Overall attendance shows your current progress towards the 30% rule. The maximum allowed percentage of class absences is 30%. No categories of absences (academic, athletic, guard, 3.2 cuts, etc.) will be exempt from that percentage. When a cadet reaches 20% absences, the instructor issues a written warning. Upon reaching 30% absences the cadet is referred to the Dean for appropriate action (Administrative Report of Excessive Absences form). Normally a cadet who exceeds the 30% absences will be required to withdraw from the course with a W or a WF.</h3>
        </center>
    </div>
</body>
</html>