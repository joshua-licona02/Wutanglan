<?php
session_start();
if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "COMM") {
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



    if(isset($_POST['submit'])){
        if(!empty($_POST['role']) && $_POST['role'] == "Cadet"){
            $_GET['role'] = $_POST['role'];
            $search = $_POST['role'];
            $list_role = "Cadet";
            $sql = "SELECT * FROM cadets order by last_name, class";
            $result = $conn->query($sql);
        }
        
        else if(!empty($_POST['role']) && $_POST['role'] == "Department"){
            $_GET['role'] = $_POST['role'];
            $list_role = "Department";
            $search = $_POST['role'];
            $sql = "SELECT * FROM courses join professor on professor.professor_id = courses.professor_id order by courses.department, course_code, section, section_time";
            $result = $conn->query($sql);
        }
        
    }

        $conn->close();
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
        <a href="commStaffHome.php">Home</a>
        <a href="commSearch.php">Search</a>
        <a class = "active">Find</a>
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
            <h2>Display by: </h2>
            <form method="POST" style="margin-top: 2%;">
                
                    <select id="role" name="role" required>
                        <?php 

                        if($_GET['role'] == "Cadet"){
                            echo "
                            <option selected value='Cadet'>Cadet</option>
                            <option value='Department'>Department</option>
                            <option value='Course'>Course</option>";
                        }
                        else if($_GET['role'] == "Department"){
                            echo "
                            <option value='Cadet'>Cadet</option>
                            <option selected value='Department'>Department</option>
                            <option value='Course'>Course</option>";
                        }
                        else if($_GET['role'] == "Course"){
                            echo "
                            <option value='Cadet'>Cadet</option>
                            <option value='Department'>Department</option>
                            <option selected value='Course'>Course</option>";
                        }
                        else{
                            echo "
                            <option selected value='Cadet'>Cadet</option>
                            <option value='Department'>Department</option>
                            <option value='Course'>Course</option>";
                        }


                        ?>

                    </select>
                    <br><br>

                    <input style = "width: 6%;" type="submit" name="submit" value = "Go">

                
            </form>

            <section>
                
                <?php


               echo "<table class = 'results' width='100%' border='solid'>";
                    

                    if($list_role == "Cadet"){
                    if ($result->num_rows > 0) {
                        echo "<tr>
                        <th>ID Number</td>
                        <th>First Name</td>
                        <th>Last Name</td>
                        <th>Rank</td>
                        <th>Class</td>
                        <th>E-mail</td>
                        </tr>";
                        while($row = $result->fetch_assoc()) {
                            $id_num = $row['id_number'];
                            echo "<tr><td><a href = 'cadetResults.php?a=$id_num'>$id_num</a></td>";
                            echo "<td>".$row['first_name']."</td>";
                            echo "<td>".$row['last_name']."</td>";
                            echo "<td>".$row['rank']."</td>";
                            echo "<td>".$row['class']."</td>";
                            echo "<td><a href = 'mailto:".$row['email']."'>".$row['email']."</td>";
                            echo "</tr>";
                        }
                    }
                }

                else if($list_role == "Department"){
                    if ($result->num_rows > 0) {
                        echo "<tr>
                        <th>Course Code</td>
                        <th>Course Title</td>
                        <th>Section Day</td>
                        <th>Section Time</td>
                        <th>Professor</td>
                        <th>Classroom</td>
                        </tr>";
                        while($row = $result->fetch_assoc()) {
                            $course_id = $row['course_id'];
                            $course_title = $row['course_title'];
                            $section = $row['section'];
                            $section_time = $row['section_time'];
                            $section_end = $row['section_end'];
                            $section_start = str_replace(':', '', $section_time);
                            $section_start = substr($section_start, 0,4);

                            $section_end = str_replace(':', '', $section_end);
                            $section_end = substr($section_end, 0,4);

                            $section_time = $section_start."-".$section_end;
                            $course_dept = $row['department'];
                            $course_code = $row['course_code'];

                            if($section < 10){
                            $section = '0'.$section;
                            }

                            $course_code = $course_dept . " " . $course_code."-".$section;
                            echo "<tr><td><a href = 'courseResults.php?a=$course_id'>$course_code</a></td>";
                            echo "<td>$course_title</td>";

                            $section_day = $row['section_day'];

                            $title = $row['title'];
                            $prof_first = $row['first_name'];
                            $prof_last = $row['last_name'];

                            $prof = $title . " ".$prof_first . " " . $prof_last;
                            $prof_id = $row['professor_id'];

                            $building = $row['building'];
                            $classroom = $row['classroom'];
                            $classroom = $building." ".$classroom;

                            echo "<td>$section_day</td>";
                            echo "<td>$section_time</td>";
                            echo "<td><a href = 'profResults.php?a=$prof_id'>$prof</a></td>";
                            echo "<td>$classroom</td>";

                            echo "</tr>";

                        }
                    }

                }


            $result->free();
            ?>
                </table>
            </section>

        </center>
    </div>
</body>
</html>