<?php
session_start();
if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "Cadet") {
//allow
}else{
    
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
        <a class = "active">Home</a>
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
        <a href="cadetHistory.php">History</a>
        <a href="cadetInstructions.php">Instructions</a>
        <a href="cadetAttendance.php">Attendance</a>
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


    <div>

        <center>
            <h2>Welcome <?php echo $_SESSION['first_name'] . '!';?></h2>

            <h3>You are a section marcher in the following courses:</h3>

            <!--
            Use php to pull courses section marcher in and what section marcher number

            --> 
            <table class = "cadet_courses sortable">
                <tr>
                    <th>Course Number</th>
                    <th>Course Title</th>
                    <th>Instructor</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Section Marcher #</th>
                </tr>
                    <?php 

                    $result = $conn->query($sql);
                    $num_of_courses = 0;

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
                           $title = $row['title'];
                           $prof_first= $row['first_name'];
                           $prof_last = $row['last_name'];
                           $instuctor = $title . " ".$prof_first . " " . $prof_last;
                           $section_marcher = $row['section_marcher'];

                           $section_time = $row['section_time'];
                           $section_end = $row['section_end'];
                           $section_day = $row['section_day'];

                           $section_start = str_replace(':', '', $section_time);
                           $section_start = substr($section_start, 0,4);

                           $section_end = str_replace(':', '', $section_end);
                           $section_end = substr($section_end, 0,4);

                           $section_time = $section_start."-".$section_end;
                           echo "<tr><td><a href = 'newCourse.php?a=$course_id'>$full_code</a></td>";
                           echo "<td>$course</td>";
                           echo "<td>$instuctor</td>";
                           echo "<td>$section_day</td>";
                           echo "<td>$section_time</td>";
                           echo "<td>$section_marcher</td></tr>";

                
 }}
$sql = "SELECT cadet_id, section_marcher, semester, cadets.first_name as cadet_first, cadets.last_name as cadet_last,course_title,course_code, section, courses.department, title, professor.first_name, professor.last_name, courses.section_day, courses.section_time, courses.section_end, courses.course_id from course_enrollment join cadets on course_enrollment.cadet_id = cadets.id_number join courses on courses.course_id = course_enrollment.course_id join professor on professor.professor_id = courses.professor_id where cadet_id = '$id' and section_marcher != 0 order by section_marcher";
$num_of_courses = 0;

$result = $conn->query($sql);
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
                   else{
                    echo "<tr><td colspan = '6'>You are not a section marcher in any of your registered courses.</td></tr>";
                }

 ?>
            </table>
            <br>
            <h3>Ensure you that you understand all <a href="cadetInstructions.php">instructions</a> (found under the Instructions tab) before completing the section marcher report.</h3>
            <i>Ignorance is not an excuse.</i>

        </center>
    </div>
</body>
</html>