<?php
session_start();
if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "COMM") {
//allow
}else{
    
    echo "<script> alert('No user is logged in. Please login using your VMI credentials!'); window.location = 'login.php';</script>";
    
}

    include ("../config.php");

    if(isset($_GET['a'])){
        $prof_id= $_GET['a'];
    }

    //user_id
    $id = $_SESSION['id_number'];

    $sql = "SELECT * FROM `professor` where professor_id = '$prof_id'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            $prof_first = $row['first_name'];
            $prof_last = $row['last_name'];
            $title = $row['title'];
            $prof_email = $row['email'];
            $department = $row['department'];

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
        <a href="commStaffHome.php">Home</a>
        <a href="commSearch.php">Search</a>
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
            <h1>Professor Result</h1>
            <h2><?php echo "$title $prof_first $prof_last";?></h2>
            <h3>Department: <?php echo $department;?></h3>
            <h4>ID Number: <?php echo "$prof_id";?></h3>
            <h4>Email: <?php echo "<a href = 'mailto: '$prof_email''>$prof_email</a>"?></h4>

            <table class = "cadet_courses" style = "width: 40%;">

                <th>Course Code</th>
                <th>Course Title</th>
                <th>Day</th>
                <th>Time</th>

                <?php 

                $sql = "SELECT * FROM courses where professor_id = '$prof_id' order by course_code, section";
                $result = $conn->query($sql);

                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()) {
                        $course_id = $row['course_id'];
                        $course_code = $row['course_code'];
                        $course_dept = $row['department'];
                        $course_section = $row['section'];
                        if($course_section < 10){
                            $course_section = "0".$course_section;
                        }
                        $course_code = $course_dept." ".$course_code."-".$course_section;
                        $course_title = $row['course_title'];

                        $section_day = $row['section_day'];
                        $section_start = $row['section_time'];
                        $section_end = $row['section_end'];

                        $section_start = str_replace(':', '', $section_start);
                        $section_start = substr($section_start, 0,4);
                        $section_end = str_replace(':', '', $section_end);
                        $section_end = substr($section_end, 0,4);


                        $section_time = $section_start."-".$section_end;

                        echo "<tr><td><a href = 'courseResults.php?a=$course_id'>$course_code</a></td>";
                        echo "<td>$course_title</td>";
                        echo "<td>$section_day</td>";
                        echo "<td>$section_time</td>";



                        echo "</tr>";
                    }
                }


                ?>
                

            </table>
        </center>
    </div>
</body>
</html>