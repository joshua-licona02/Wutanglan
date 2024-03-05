<?php
session_start();
if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "Professor") {
//allow
}else{
    
    echo "<script> alert('No user is logged in. Please login using your VMI credentials!'); window.location = 'login.php';</script>";
    
}

   include ("../config.php");
    $id = $_SESSION['id_number'];

    $sql = "SELECT * from courses where professor_id = '$id' order by course_code asc, section asc";

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
    <title>VMI E-Section Marcher | Secretary</title>
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
            <h2>Welcome <?php echo $_SESSION['first_name'] . '!';?></h2>
            <h3>Below are your current courses:</h3>
            <table class = "cadet_courses">
                <tr>
                    <th>Course Number</th>
                    <th>Course Title</th>
                    <th>Day</th>
                    <th>Time</th>
                    
                </tr>
                    <?php

                    $sql = "SELECT * from courses where professor_id = '$id' order by course_code asc, section asc";

                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()) {
            
                        $course_id = $row['course_id'];
                        $department = $row['department'];
                        $course_code = $row['course_code'];
                        $course = $row['course_title'];
                        $section = $row['section'];
                        if($section < 10){
                            $section = '0'.$section;
                        }
                        $full_code = $department . " " .$course_code . "-" . $section;
                        $course = $row['course_title'];
                        $section_time = $row['section_time'];
                                       $section_end = $row['section_end'];
                                       $section_day = $row['section_day'];

                       $section_start = str_replace(':', '', $section_time);
                       $section_start = substr($section_start, 0,4);

                       $section_end = str_replace(':', '', $section_end);
                       $section_end = substr($section_end, 0,4);

                       $section_time = $section_start."-".$section_end;
       
                        echo "<tr><td><a href = 'courseResults.php?a=$course_id'>$full_code</a></td>";
                        echo "<td>$course</td>";
                        echo "<td>$section_day</td>";
                        echo "<td>$section_time</td>";
                        echo "</tr>";
                    }}
                    ?>
            </table>

        </center>
    </div>
</body>
</html>