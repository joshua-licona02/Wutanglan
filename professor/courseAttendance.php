<?php
session_start();
if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "Professor") {
//allow
}else{
    
    echo "<script> alert('No user is logged in. Please login using your VMI credentials!'); window.location = 'login.php';</script>";
    
}

   include ("../config.php");

    if(isset($_GET['a'])){
        $course_id= $_GET['a'];
    }

    //user_id
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
        <a href="profHome.php">Home</a>
        <div class="dropdown">
            <button class="dropbtn" onclick="myFunction()">Courses
            <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content" id="myDropdown">
                <?php 

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
    <div>
        <center>
            <h1>Attendance Report for 
                <?php
                $sql = "SELECT * FROM courses join professor on courses.professor_id = professor.professor_id where course_id = '$course_id'";

                $result = $conn->query($sql);


                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()){
                        $course_code = $row['course_code'];
                        $course_dept = $row['department'];
                        $course_section = $row['section'];
                        $course_code = $course_dept." ".$course_code."-".$course_section;
                        $prof_first = $row['first_name'];
                        $prof_last = $row['last_name'];
                        $prof_rank = $row['title'];

                        $prof = $prof_rank. " ".$prof_first. " ".$prof_last;
                        $course_title = $row['course_title'];
                        $course_title = $row['course_title'];

                        $section_day = $row['section_day'];
                        $section_start = $row['section_time'];
                        $section_end = $row['section_end'];

                        $section_start = str_replace(':', '', $section_start);
                        $section_start = substr($section_start, 0,4);
                        $section_end = str_replace(':', '', $section_end);
                        $section_end = substr($section_end, 0,4);


                        $section_time = $section_start."-".$section_end;


                    }
                }
                echo $course_code.": ".$course_title;
                ?>
            
        </h1>
           <h2>
                Faculty: <?php echo $prof;?>
            </h2>
            <h3><?php echo $section_day." ".$section_time;?></h3>
            <table class = "prof_attendance sortable">
                <th>Date</th>
                <th>Time Submitted</th>
                <th>Course</th>
                <th>Course Time</th>
                <th>Submitted By</th>
                
               
                <?php

                $sql = "SELECT accountability.course_id, date, time, course_title, courses.department, course_code, section, section_day, section_time, section_end, cadets.first_name, cadets.last_name, submitted_by, submitted_by_role from accountability join cadets on accountability.submitted_by = cadets.id_number join courses on courses.course_id = accountability.course_id join professor on courses.professor_id = professor.professor_id where accountability.course_id = '$course_id' group by date order by date desc, time desc";



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
                        

                        $course = $course_department." ".$course_code. "-".$course_section.": ".$course_title;

                       
                        echo "<td>$course</td>";

                        $course_time = str_replace(':', '', $course_time);
                        $course_time = substr($course_time, 0,4);
                        $course_end = str_replace(':', '', $course_end);
                        $course_end = substr($course_end, 0,4);
                        $course_time = $course_time."-".$course_end;
                        echo "<td>$course_time</td>";

                        
                        //submitted by
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $cadet_id = $row['submitted_by'];
                        $submitted_by_role = $row['submitted_by_role'];

                        if($submitted_by_role == "Cadet"){
                            $cadet = "CDT ".$first_name." ".$last_name;
                            echo "<td>$cadet</td>";
                        }
                        else{
                            $prof_name = $_SESSION['prof_name'];
                            echo "<td>$prof_name</td>";
                        }

                        

                    
                        
                    }
                }
                else{
                    echo "<tr><td colspan = 5>No Results Found.</td><tr>";
                }

                ?>



            </table>
        </center>
    </div>
</body>
</html>