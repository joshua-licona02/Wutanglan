<?php
session_start();
if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "Sec") {
//allow
}else{
    
    echo "<script> alert('No user is logged in. Please login using your VMI credentials!'); window.location = 'login.php';</script>";
    
}

    include ("../config.php");

    if(isset($_GET['a'])){
        $cadet_id= $_GET['a'];
    }

    //user_id
    $id = $_SESSION['id_number'];
    $secDept = $_SESSION['secDept'];

    $sql = "SELECT * FROM `cadets` where id_number = '$cadet_id'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            $cadet_first = $row['first_name'];
            $cadet_last = $row['last_name'];
            $cadet_class = $row['class'];
            $cadet_rank = $row['rank'];
            $cadet_email = $row['email'];

        }

    }

?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VMI E-Section Marcher | Comm Staff</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href="style.css" rel="stylesheet"/>
</head>
<body>
    <div class = "header">
            <img id = "mainImg" src = "vmilogo.svg" id = "logo">
            <h1 id = "esection">E-Section Marcher</h1>
    </div>

    <div class="navbar">
        <a href="sectHome.php">Home</a>
        <a href="sectSearch.php">Search</a>
        <a href="displayLists.php">Find</a>
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
            <h1>Attendance Report for <?php echo "Cadet $cadet_first $cadet_last: Class of $cadet_class";?></h1>
            <table class = "cadet_courses">
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Comments</th>
                <th>Course</th>
                <th>Course Time</th>
                <th>Instructor</th>
               
                <?php

                $sql = "SELECT accountability.course_id, date, time, status, comments, course_title, courses.department,course_code, section, section_day, section_time, section_end, professor.title, professor.first_name, professor.last_name from accountability join cadets on accountability.cadet_id = cadets.id_number join courses on courses.course_id = accountability.course_id join professor on courses.professor_id = professor.professor_id where accountability.cadet_id = '$cadet_id' and courses.department = '$secDept' order by date desc, time desc";

                $result = $conn->query($sql);

        
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()) {
                        $course_id = $row['course_id'];
                        $account_date = $row['date'];
                        $account_time = $row['time'];
                        $account_status = $row['status'];
                        $account_comments = $row['comments'];
                        $course_title = $row['course_title'];
                        $course_code = $row['course_code'];
                        $course_section = $row['section'];
                        if($course_section < 10){
                            $course_section = "0".$course_section;
                        }
                        $course_department = $row['department'];
                        $course_day = $row['section_day'];
                        $course_time = $row['section_time'];
                        $course_end = $row['section_end'];
                        $prof_title = $row['title'];
                        $prof_first = $row['first_name'];
                        $prof_last = $row['last_name'];

                        echo "<tr><td><a href = 'courseDateAccountability.php?a=$account_date&b=$course_id'>$account_date</a></td>";
                        echo "<td>$account_time</td>";
                        
                        if($account_status == "Present"){
                            echo "<td style = 'background: green'><a style = 'color: white'>$account_status</a></td>";
                        }
                        else if($account_status == "Late"){
                            echo "<td style = 'background: Yellow'><a style =  'color: Black'>$account_status</a></td>";
                        }
                        else if($account_status == "Late Late"){
                            echo "<td style = 'background: Orange'><a style =  'color: Black'>$account_status</a></td>";
                        }
                        else{
                            echo "<td style = 'background: red'><a style =  'color: white'>$account_status</a></td>";
                        }

                        $course = $course_department." ".$course_code. "-".$course_section.": ".$course_title;

                        echo "<td>$account_comments</td>";
                        echo "<td>$course</td>";

                        $course_time = str_replace(':', '', $course_time);
                        $course_time = substr($course_time, 0,4);
                        $course_end = str_replace(':', '', $course_end);
                        $course_end = substr($course_end, 0,4);
                        $course_time = $course_time."-".$course_end;
                        echo "<td>$course_time</td>";

                        $prof = $prof_title." ".$prof_first." ".$prof_last;

                        echo "<td>$prof</td>";

                    
                        
                    }
                }
                else{
                    echo "<tr><td colspan = 7>No Results Found.</td><tr>";
                }

                ?>



            </table>
        </center>
    </div>
</body>
</html>