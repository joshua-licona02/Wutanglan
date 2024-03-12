<?php
    session_start();
    if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "Professor") {
    //allow
    }
    else{
    
    echo "<script> alert('No user is logged in. Please login using your VMI credentials!'); window.location = 'login.php';</script>";
    }
    //start of accountability ids for that course
    if(isset($_GET['a'])){
        $_SESSION['accountability']= $_GET['a'];
    }
    if(isset($_GET['b'])){
        $_SESSION['course_id'] = $_GET['b'];
    }

    if(isset($_GET['c'])){
        $_SESSION['account_date'] = $_GET['c'];
    }

    include ("../config.php");
    //prof ID number
    $id = $_SESSION['id_number'];
    
    date_default_timezone_set('America/New_York'); // Eastern Time
    $info = getdate();
    $date = $info['mday'];
    $month = $info['mon'];
    $year = $info['year'];
    $hour = $info['hours'];
    $min = $info['minutes'];
    $sec = $info['seconds'];
    
            if($date < 10){
                $date = '0'.$date;
            }

            if($month < 10){
                $month = '0'.$month;
            }

            if($hour < 10){
                $hour = '0'.$hour;
            }
            if($min < 10){
                $min = '0'.$min;
            }
            if($sec < 10){
                $sec = '0'.$sec;
            }

    $current_time = "$hour:$min";
    
    //$current_date = "$month/$date/$year == $hour:$min:$sec";
    $current_date = "$year-$month-$date";

            function getWeekday($date) {
                return date('w', strtotime($date));
            }

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
        <a href = "profHome.php">Home</a>
        <div class="dropdown">
            <button class="dropbtn" onclick="myFunction()">Courses
            <i class="fa fa-caret-down"></i>
            </button>
        <div class="dropdown-content" id="myDropdown">

        <?php 

        $sql = "SELECT * from courses where professor_id = '$id' order by course_code asc, section asc";

        $result = $conn->query($sql);
        $num_of_courses = 0;
        $course_ids = array();
        $full_codes = array();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $num_of_courses++;
                $course_id_temp = $row['course_id'];
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

                    for($i=0; $i<count($course_ids); $i++){
                        echo "<a href = 'courseResults.php?a=$course_ids[$i]'>$full_codes[$i]</a></td>";
                    }

        ?>
    </div>
</div>

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

            $account_id = $_SESSION['accountability'];

            $sql = "select first_name, last_name, time, submitted_by_role from accountability join cadets on accountability.submitted_by = cadets.id_number where accountability_id = '$account_id'";
            $result = $conn->query($sql);

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                   $time_submitted = $row['time'];
                   $submitted_by_first = $row['first_name'];
                   $submitted_by_last = $row['last_name'];
                   $submitted_by_role = $row['submitted_by_role'];
                   $submitted_by = $submitted_by_first." ".$submitted_by_last;
                }
            }

            $prof_name = $_SESSION['prof_name'];

            if($submitted_by_role == "Cadet"){
                echo "<h2>Report submitted by Cadet $submitted_by at $time_submitted</h2>";
            }
            else{
                echo "<h2>Report submitted by $prof_name</h2>";
            }

            
            $sql = "select courses.course_title, courses.course_code, courses.section, courses.department, section_time, section_end, professor.first_name as prof_first, professor.last_name as prof_last, professor.title from accountability join cadets on accountability.cadet_id = cadets.id_number JOIN courses on courses.course_id = accountability.course_id JOIN professor on professor.professor_id = courses.professor_id where accountability_id = '$account_id'";

            //echo $sql;
            //exit;

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    
                $department = $row['department'];
                $course_title = $row['course_title'];
                $course_code = $row['course_code'];
                $course_section = $row['section'];
                $section_time = $row['section_time'];
                $section_end = $row['section_end'];

                //echo "$section_end"; //11:50... we need 12:50
                
                $date = $_SESSION['account_date'];
                if($course_section < 10){
                    $course_section = "0".$course_section;
                }
                $course = $department . " ".$course_code."-".$course_section;
                $faculty_first = $row['prof_first'];
                $faculty_last = $row['prof_last'];
                $faculty_title = $row['title'];

                $professor_full = $faculty_title . " " . $faculty_first . " " . $faculty_last;

            }
                echo "<h3>$course: $course_title</h3>";
                echo "<h4>Faculty: $professor_full</h4>";
                echo "<h4>Date: $date</h4>";
                echo "<h4>Section Time: $section_time</h4>";
                }

            $cadetNum = 1;



            ?>         

                
            <table class = "cadet_courses" style = "width: 50%;">
                <tr>
                    <th>Cadet Number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Class</th>
                    <th>Rank</th>
                    <th>Status</th>
                    <th>Comments (Optional)</th>
                </tr>
                
           
            <?php

            $course_id = $_SESSION['course_id'];

            $account_date = $_SESSION['account_date'];


            $sql = "SELECT cadets.first_name as cadet_first,cadets.last_name as cadet_last, courses.department as course_dept,courses.course_code, courses.section, courses.course_title, courses.section_time, courses.section_end, courses.section_day, course_enrollment.course_id, course_enrollment.semester, professor.title,professor.first_name,professor.last_name FROM cadets join course_enrollment on cadets.id_number = course_enrollment.cadet_id JOIN courses ON courses.course_id = course_enrollment.course_id join professor on courses.professor_id = professor.professor_id WHERE course_enrollment.course_id = '$course_id'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){

                while($row = $result->fetch_assoc()) {
                    $section_day = $row['section_day'];

                }
            }

            
            $sql = "select cadets.first_name, cadets.last_name, cadets.class, cadets.rank, accountability.status, accountability.comments, courses.course_title, courses.course_code, courses.section, courses.department from accountability join cadets on accountability.cadet_id = cadets.id_number JOIN courses on courses.course_id = accountability.course_id JOIN rank on rank.rank = cadets.rank where accountability_id >= '$account_id' AND date = '$account_date' AND accountability.course_id = '$course_id' order by rank_id, class, last_name";

            $result = $conn->query($sql);

            $section_end_time = new DateTime($section_end);
            $time = $section_end_time->format('H:i:s'); 
            $hours = 1; 
            $end_edits_time = (clone $section_end_time)->add(new DateInterval("PT{$hours}H")); 
            $end_edits_time = $end_edits_time->format('H:i:s');
 
            
            //THIS IS WHAT NEEDS TO BE FIXED - 02/02/2024
            //THIS SHOULD CHECK IF THE CURRENT TIME IS OUTSIDE OF THE 
            //ALLOWED SM REPORTING CAPABALITIES
            //EX: CP: 1100-1150
            //REPORTING/EDITING ENDS AT 1250.
            //if(5 < 10){
            switch(getWeekday($current_date)){
                case 0: $current_day = "Sunday"; break;
                case 1: $current_day = "Monday"; break;
                case 2: $current_day = "Tuesday"; break;
                case 3: $current_day = "Wednesday"; break;
                case 4: $current_day = "Thursday"; break;
                case 5: $current_day = "Friday"; break;
                case 6: $current_day = "Saturday"; break;
            }

            $section_array = array();

            for($i = 0; $i < strlen($section_day); $i++) {
                if($section_day[$i] == "M"){
                    $string = $string . "Monday";
                    $section_array[] = "Monday";
                }
                if($section_day[$i] == "T"){
                    $string = $string . "Tuesday";
                    $section_array[] = "Tuesday";
                }
                if($section_day[$i] == "W"){
                    $string = $string . "Wednesday";
                    $section_array[] = "Wednesday";
                }
                if($section_day[$i] == "R"){
                    $string = $string . "Thursday";
                    $section_array[] = "Thursday";
                }
                if($section_day[$i] == "F"){
                    $string = $string . "Friday";
                    $section_array[] = "Friday";
                }
                if($length == 1) {
                    break;
                }
                $length--;
                $string = $string . '/';
            }

            $section_day = $string;
            $isClassToday = "False";

            for($i = 0; $i < count($section_array); $i++){
                if($section_array[$i] == $current_day){
                    $isClassToday = "True";
                    break;
                }
                
            }



            if($current_time <= $end_edits_time && $current_time >= $section_time && $isClassToday == "True"){

            //if(5<6){

                //within time range
                //allow edits
                //copy code from newCourse.php


                echo "<form action = 'updateAccountability.php' method='post'>";

                if($result->num_rows > 0){

                while($row = $result->fetch_assoc()) {

                $id = $row["id_number"];
                        $first_name = $row["first_name"];
                        $last_name = $row["last_name"];
                        $rank = $row['rank'];
                        $company = $row['company'];
                        $class = $row['class'];
                        $major = $row['major'];
                        $status = $row['status'];
                        $comments = $row['comments'];

                        echo "<tr><td>$cadetNum</td>";
                        echo "<td>$first_name</td>";
                        echo "<td>$last_name</td>";
                        echo "<td>$class</td>";
                        echo "<td>$rank</td>";
                        echo "<td><select id='status' name='status[]' required>";
                        if($status == "Present"){
                            echo 
                            "<option selected value='Present'>Present</option>
                            <option value='Late'>Late <5 mins</option>
                            <option value='Late Late'>Late 5-15 mins</option>
                            <option value='Absent'>Absent</option>";
                        }
                        else if($status == "Absent"){
                            echo 
                            "<option value='Present'>Present</option>
                            <option value='Late'>Late <5 mins</option>
                            <option value='Late Late'>Late 5-15 mins</option>
                            <option selected value='Absent'>Absent</option>";
                        }
                        else if($status == "Late"){
                            echo 
                            "<option value='Present'>Present</option>
                            <option selected value='Late'>Late <5 mins</option>
                            <option value='Late Late'>Late 5-15 mins</option>
                            <option value='Absent'>Absent</option>";
                        }
                        else{
                            echo 
                            "<option value='Present'>Present</option>
                            <option value='Late'>Late <5 mins</option>
                            <option selected value='Late Late'>Late 5-15 mins</option>
                            <option value='Absent'>Absent</option>";
                        }
                        echo "</select></td>";

                        echo "<td style = 'padding-top: 1%;'><input style = 'width: 85%;' name = 'comments[]' type='text' value = '$comments'>
                        </td></tr>";
                        $cadetNum++;
                    }
                }

                echo "<tr><td style = 'padding-top: 2%;' align = 'center' colspan='7'>";
                echo "<input style='width: 30%;' type = 'submit'></td></tr>";
                echo "</form>";
                echo "</table>";
            }

            if($result->num_rows > 0){

                while($row = $result->fetch_assoc()) {

                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $class = $row['class'];
                    $rank = $row['rank'];
                    $status = $row['status'];
                    $comments = $row['comments'];
                    
                    echo "<tr><td>$cadetNum</td>";
                    echo "<td>$first_name</td>";
                    echo "<td>$last_name</td>";
                    echo "<td>$class</td>";
                    echo "<td>$rank</td>";
                    if($status == "Present"){
                        echo "<td style = 'background: green'><a style = 'color: white'>$status</a></td>";
                    }
                    else if($status == "Late"){
                        echo "<td style = 'background: Yellow'><a style =  'color: Black'>$status</a></td>";
                    }
                    else if($status == "Late Late"){
                        echo "<td style = 'background: Orange'><a style =  'color: Black'>$status</a></td>";
                    }
                    else{
                        echo "<td style = 'background: red'><a style =  'color: white'>$status</a></td>";
                    }
                    
                    echo "<td>$comments</td>";
                    echo "</tr>";
                    $cadetNum++;
                }
            }
            
            ?>
        </table>
        </div>
        </center>
</body>
</html>