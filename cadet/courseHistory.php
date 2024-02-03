<?php
    session_start();
    if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "Cadet") {
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
    //cadet ID number
    $id = $_SESSION['id_number'];
    //shows courses you are section marcher
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

    $current_time = "$hour:$min";
    
    $current_date = "$date/$month/$year == $hour:$min:$sec";

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

            echo "<h2>Report submitted by Cadet $cadet_name</h2>";

            $account_id = $_SESSION['accountability'];



            
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
                echo "<h4>Time: $section_time</h4>";
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

            //if()

            $course_id = $_SESSION['course_id'];

            $account_date = $_SESSION['account_date'];
            
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
            if($current_time <= $end_edits_time && $current_time >= $section_time){
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
                echo "<h2 style='border: solid; background: #ae122a; color: white;'>THIS IS A REMINDER THAT SUBMITTING THE SECTION MARCHER REPORT IS A CERTIFIED STATEMENT.</h2>";


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
        </center>
    </div>
</body>
</html>