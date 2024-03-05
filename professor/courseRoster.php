<?php
session_start();
if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "Professor") {
//allow
}else{
    
    echo "<script> alert('No user is logged in. Please login using your VMI credentials!'); window.location = 'login.php';</script>";
    
}

   include ("../config.php");

    if(isset($_GET['a'])){
        $course_id = $_GET['a'];
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
    <title>VMI E-Section Marcher | Professor</title>
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
            <h1>Course Roster for 
                <?php
                $sql = "SELECT * FROM courses where course_id = '$course_id'";
 
                $result = $conn->query($sql);

                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()) {
                        /*
                        $cadet_first = $row['first_name'];
                        $cadet_last = $row['last_name'];
                        $cadet_class = $row['class'];
                        $cadet_rank = $row['rank'];
                        $cadet_email = $row['email'];
                        */
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
                        $course = $course_department." ".$course_code. "-".$course_section.": ".$course_title;
                    }

                }





            echo "$course";?></h1>

            <table class = "cadet_courses">
                <?php 
                $cadet_number = 1;
                ?>

                <th>Cadet Number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Rank</th>
                <th>Class</th>
                 
                <?php

                $sql = "SELECT * from course_enrollment join cadets on cadets.id_number = course_enrollment.cadet_id join rank on rank.rank = cadets.rank where course_id = '$course_id' order by rank_id, class, last_name";

                
                

                $result = $conn->query($sql);

                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()) {

                        $cadet_first = $row['first_name'];
                        $cadet_last = $row['last_name'];
                        $rank = $row['rank'];
                        $class = $row['class'];
                        $status = $row['status'];
                        $comments = $row['comments'];


                        echo "<tr><td>$cadet_number</td>";
                        echo "<td>$cadet_first</td>";
                        echo "<td>$cadet_last</td>";
                        echo "<td>$class</td>";
                        echo "<td>$rank</td>";




                        $cadet_number++;

                    }
                }
                ?>
                

            </table>
        </center>
    </div>
</body>
</html>