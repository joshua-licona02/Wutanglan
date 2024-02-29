<?php
session_start();
if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "Professor") {
//allow
}else{
    
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
    if(isset($_GET['a'])){
    $course_id = $_GET['a'];
    }

    
    $sql = "SELECT * FROM courses join professor on courses.professor_id = professor.professor_id where course_id = '$course_id'";

    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $course_code = $row['course_code'];
            $course_dept = $row['department'];
            
            $course_section = $row['section'];
            if($course_section < 10){
                $course_section = "0".$course_section;
            }
            $course_code = $course_dept." ".$course_code."-".$course_section;
            $prof_first = $row['first_name'];
            $prof_last = $row['last_name'];
            $prof_rank = $row['title'];

            $prof = $prof_rank. " ".$prof_first. " ".$prof_last;
            
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


?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VMI E-Section Marcher | Comm Search</title>
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
        <a href = "commSearch.php">Search</a>
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
            
            <h1>
                <?php
                echo $course_code.": ".$course_title;
                ?>
            </h1>

            <h2>
                Faculty: <?php echo $prof;?>
            </h2>
            <h3><?php echo $section_day." ".$section_time;?></h3>


            <a href = "courseAttendance.php?a=<?php echo $course_id?>">View Course Attendance</a>
        </center>
    </div>
</body>
</html>