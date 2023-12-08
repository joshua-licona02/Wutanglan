<?php
    session_start();
    if(isset($_GET['a']) /*you can validate the link here*/){
    $_SESSION['course_id']= $_GET['a'];
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

    $email = $_SESSION['email'];
    $course_id = $_SESSION['course_id'];

    $sql = "SELECT cadets.first_name as cadet_first,cadets.last_name as cadet_last, courses.department as course_dept,courses.course_code, courses.section, courses.course_title, courses.section_time, courses.section_end, courses.section_day, course_enrollment.course_id, course_enrollment.semester, professor.title,professor.first_name,professor.last_name FROM cadets join course_enrollment on cadets.id_number = course_enrollment.cadet_id JOIN courses ON courses.course_id = course_enrollment.course_id join professor on courses.professor_id = professor.professor_id WHERE course_enrollment.course_id = '$course_id'";

    $result = $conn->query($sql);


    if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()) {

                        //basic section marcher/course info
                     $cadet_first = $row['cadet_first'];
                     $cadet_last = $row['cadet_last'];
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



                for($i = 0; $i < strlen($section_day); $i++) 
                {
                        

                    if($section_day[$i] == "M"){
                        $string = $string . "Monday";
                    }
                     if($section_day[$i] == "T"){
                        $string = $string . "Tuesday";
                    }
                     if($section_day[$i] == "W"){
                        $string = $string . "Wednesday";
                    }
                     if($section_day[$i] == "R"){
                        $string = $string . "Thursday";
                    }
                     if($section_day[$i] == "F"){
                        $string = $string . "Friday";
                    }
                    


                        
                        


                        if($length == 1) {
                            break;
                        }
                        $length--;
                        $string = $string . '/';
                    }

                    $section_day = $string;
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
                <a class = "active">CIS-480-02</a>
                <a href="#">CIS-402-01</a>
                <a href="#">HPW-327-03</a>
            </div>
        </div> 
        <a href="cadetHistory.php">History</a>
        <a href="cadetInstructions.php">Instructions</a>
        <a href = "cadetInfo.php">Cadet Info</a>
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


    <div style="padding: 1%;">

        <center>
            <h3><?php echo $_SESSION['first_name']?>, you are the 1st Section Marcher for <?php echo $department . " " . $course_code . ": " . $course?></h3>
            <h4>Faculty: <?php echo $rank . " ".$prof_first . " " . $prof_last?></h4>
            <h4>Class Period: <?php echo $section_start ."-".$section_end?></h4>
            <h5><?php echo $section_day?></h5>
            <h5><?php echo $sem?></h5>
            <form action = "" method="post">
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
                    $cadetNum = 1;
                   if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()) {
                    
                        
                        $id = $row["id_number"];
                        $email = $row["email"];
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
                        <select id='status' name='status' required>
                        <option selected value='Present'>Present</option>
                        <option value='Late'>Late <5 mins</option>
                        <option value='Late Late'>Late 5-15 mins</option>
                        <option value='Absent'>Absent</option>
                            </select></td>";
                        echo "<td style = 'padding-top: 1%;'><input style = 'width: 85%;' name = 'comments' type='textarea'>
                        </td></tr>";
                        $cadetNum++;
        }
    }
                ?>
                <tr><td style = "padding-top: 2%;"align = "center" colspan="7">
                <input style="width: 30%;" type = "submit"></td>
                <tr>
            </form>
            </table>
        </center>
    </div>
</body>
</html>