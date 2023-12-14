<?php
    session_start();
    if($_SESSION['loggedIn']) {
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

    $sql = "SELECT cadet_id, section_marcher, semester, cadets.first_name as cadet_first, cadets.last_name as cadet_last,course_title,course_code, section, courses.department, title, professor.first_name, professor.last_name, courses.section_day, courses.section_time, courses.section_end, courses.course_id from course_enrollment join cadets on course_enrollment.cadet_id = cadets.id_number join courses on courses.course_id = course_enrollment.course_id join professor on professor.professor_id = courses.professor_id where cadet_id = '$id' order by section_marcher";

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

            if($section_marcher == 0){
                $zero_Section++;
                break;
                           }
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
        <a href="cadetHistory.php">History</a>
        <a class = "active">Instructions</a>
        <a href="cadetInfo.php">Cadet Info</a>
        <a id = "logout" href="logout.php">Logout</a>
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
            <h1 style="border: solid; background: black; color: white">SECTION MARCHER INSTRUCTIONS</h1>
            
            <table class = "sectInstructions" style="border: solid;">

            <tr>
                <td>
                    <h2>
                    1. Select the section that you are reporting the accountability for.
                    </h2>
                </td>
            </tr>

            <tr><td><h3 style = "text-align: center;color: #ae122a;">1. Only one cadet may submit section marcher report per section.<br>2. If the first section marcher is late or absent then the succeeding section marcher is responsible for submitting report.</h3></td></tr>

            <tr>
                <td>
                    <h2>
                    2. Select the status for each cadet that is not present when the bell rings.
                    </h2>
                </td>
            </tr>
            <tr><td style = "text-align: center;color: #ae122a;"><h3>1. Late <5 mins<br>2. Late 5-15 mins<br>
                    3. Absent (Not present or later than 15 minutes)</h3></td>
            </tr>

            <tr><td><h2>
                3. Put important information in the comments
            </h2></td>
            </tr>
            <tr><td style = "text-align: center; color: #ae122a;"><h3>i.e., All-Duty, 3.2 Cut, Doctor's Excuse, Sports Event</h3></td>
            </tr>
            <tr><td><h2>4. Click submit after the initial roll call.</h2> </td></tr>
            <tr><td style = "text-align: center; color: #ae122a;"><h3>Any changes made (i.e., marking someone late) must be made NLT 1 hour after CP ends.</h3></td></tr></table>
            <h2 style="border: solid; background: #ae122a; color: white">
                THIS IS A REMINDER THAT SUBMITTING THE SECTION MARCHER REPORT IS A CERTIFIED STATEMENT.</h2> 
            

        </center>
    </div>
</body>
</html>