<?php
    session_start();
    if(isset($_GET['a'])){
    $_SESSION['course_id']= $_GET['a'];
    }

    if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "Professor") {
    //allow
    }else{
        echo "<script> alert('No user is logged in. Please login using your VMI credentials!'); window.location = 'login.php';</script>";
    }

    include ("../config.php");

    $email = $_SESSION['email'];
    $course_id = $_SESSION['course_id'];
    $cadet_id = $_SESSION['id_number'];

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
            $current_date = "$year-$month-$date";
            $current_date_new = "$month/$date/$year";
            $current_date_time = "$date/$month/$year == $hour:$min:$sec";
            $current_time = $current_time = "$hour:$min";

            function getWeekday($date) {
                return date('w', strtotime($date));
            }

            

    //checks if code has already been submitted
            $sql = "SELECT * FROM accountability where course_id = '$course_id' AND date = '$current_date_new' ORDER BY accountability_id asc LIMIT 1";
            

            $result = $conn->query($sql);

            if($result->num_rows > 0){
            
                while($row = $result->fetch_assoc()) {

                    $account_id = $row['accountability_id'];

                header("Location: courseHistory.php?a=$account_id&b=$course_id&c=$current_date_new");
                exit;


            }
        }

    $sql = "SELECT cadets.first_name, cadets.last_name, section_marcher, if(course_enrollment.section_marcher > 0, 'true','false') as 'is Section Marcher' from course_enrollment join cadets on course_enrollment.cadet_id = '$cadet_id' where cadets.id_number = course_enrollment.cadet_id AND section_marcher>0 and course_enrollment.course_id = '$course_id'";

    $result = $conn->query($sql);


    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            $section_marcher = $row['section_marcher'];
        }
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
                $id = $_SESSION['id_number'];
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
    <div style="padding: 1%;">
        <center>
            <h1>Section Marcher Report Override</h1>
            <h2><?php 
            $course_id = $_SESSION['course_id'];

            $sql = "SELECT cadets.first_name as cadet_first,cadets.last_name as cadet_last, courses.department as course_dept,courses.course_code, courses.section, courses.course_title, courses.section_time, courses.section_end, courses.section_day, course_enrollment.course_id, course_enrollment.semester, professor.title,professor.first_name,professor.last_name FROM cadets join course_enrollment on cadets.id_number = course_enrollment.cadet_id JOIN courses ON courses.course_id = course_enrollment.course_id join professor on courses.professor_id = professor.professor_id WHERE course_enrollment.course_id = '$course_id'";

            $result = $conn->query($sql);

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                //basic section marcher/course info
                    $cadet_first = $row['cadet_first'];
                    $cadet_last = $row['cadet_last'];
                    $course_section = $row['section'];
                    if($course_section < 10){
                            $course_section = '0'.$course_section;
                        }
                    $department = $row['course_dept'];
                    $course_code = $row['course_code'];
                    $course = $row['course_title'];
                    $rank = $row['title'];
                    $prof_first = $row['first_name'];
                    $prof_last = $row['last_name'];

                    $section_start = $row['section_time'];
                    $section_start = str_replace(':', '', $section_start);
                    $section_start = substr($section_start, 0,4);
                    $section_end = $row['section_end'];
                    $section_end = str_replace(':', '', $section_end);
                    $section_end = substr($section_end, 0,4);
                    $semester = $row['semester'];
                    if(substr($semester, 0,2)=='FL'){
                        $sem = 'Fall';
                    }
                    else{
                        $sem = 'Spring';
                    }

                    $sem = $sem.' 20'.substr($semester, 2,3);
                    $section_day = $row['section_day'];
                    $length = strlen($section_day);
                    $temp = $section_day;
                    $string = "";
                }
            }


            

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
                else{

                }
            }

            
            //delete here this is for testing purposes
            $isClassToday = True;

            if($isClassToday != "True"){
                echo "<h1 style = 'background-color: #ae122a; color: white'>Course Locked</h1>";
                echo "<h1>$department " . "$course_code-" . "$course_section". ": ". "$course does not meet on $current_day</h1>";
                exit;
            }

            $section_start_time = new DateTime($section_start);
            $section_start_time->modify('-2 minutes');
            $section_start_time = $section_start_time->format('H:i:s');

            $section_end_time = new DateTime($section_end);
            $time = $section_end_time->format('H:i:s'); 
            $hours = 1; 
            $end_edits_time = (clone $section_end_time)->add(new DateInterval("PT{$hours}H")); 
            $end_edits_time = $end_edits_time->format('H:i:s');

            //unedit this to fix
            if($current_time > $end_edits_time || $current_time < $section_start_time){

            //if(5>6){

                echo "<h1 style = 'background-color: #ae122a; color: white'>Course Locked</h1>";
                echo "<h1>$department " . "$course_code-" . "$course_section". ": ". "$course forms up at $section_start.</h1>";
                exit;
            }

            $email = $_SESSION['email'];
            $course_id = $_SESSION['course_id'];
            $cadet_id = $_SESSION['id_number'];
            $sql = "SELECT cadets.first_name, cadets.last_name, section_marcher, if(course_enrollment.section_marcher > 0, 'true','false') as 'is Section Marcher' from course_enrollment join cadets on course_enrollment.cadet_id = '$cadet_id' where cadets.id_number = course_enrollment.cadet_id AND section_marcher>0 and course_enrollment.course_id = '$course_id'";

            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    $section_marcher = $row['section_marcher'];
                }
            }
            ?>
            <?php

            if($section_marcher == 1){
                $section_marcher .= "st";
            }
            else if($section_marcher == 2){
                $section_marcher .= "nd";
            }
            else if($section_marcher == 3){
                $section_marcher .= "rd";
            }
            echo $department . " " . $course_code ."-". $course_section .": " . $course?></h2>
            <h4>Class Period: <?php echo $section_start ."-".$section_end?></h4>
            <h5><?php echo $section_day?></h5>
            <h5><?php echo $sem?></h5>

            <form action = "submitAccountability.php" method="post">
            <table class = "course_Roll">
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
                $sql = "SELECT * FROM cadets JOIN rank on cadets.rank=rank.rank join course_enrollment on course_enrollment.cadet_id = cadets.id_number where course_id = '$course_id' order by rank_id, class, last_name";

                $result = $conn->query($sql);
                //index
                $cadetNum = 1;
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()) {
                    //cadet id
                        $id = $row["id_number"];
                        $first_name = $row["first_name"];
                        $last_name = $row["last_name"];
                        $rank = $row['rank'];
                        $company = $row['company'];
                        $class = $row['class'];
                        $major = $row['major'];

                        echo "<tr><td>$cadetNum</td>";
                        echo "<td>$first_name</td>";
                        echo "<td>$last_name</td>";
                        echo "<td>$class</td>";
                        echo "<td>$rank</td>";
                        echo "<td>
                        <select id='status' name='status[]' required>
                        <option selected value='Present'>Present</option>
                        <option value='Late'>Late <5 mins</option>
                        <option value='Late Late'>Late 5-15 mins</option>
                        <option value='Absent'>Absent</option>
                            </select></td>";

                        echo "<td style = 'padding-top: 1%;'><input style = 'width: 85%;' name = 'comments[]' type='text'>
                        </td></tr>";
                        $cadetNum++;
                    }
                }
                ?>
                <tr><td style = "padding-top: 2%;"align = "center" colspan="7">
                <input style="width: 30%;" type = "submit">
                </td></tr>
            </form>
        </table>
    </center>
</div>
</body>
</html>