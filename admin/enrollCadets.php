<?php
session_start();
if($_SESSION['loggedIn']) {
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

    


?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VMI E-Section Marcher | Admin Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href="style.css" rel="stylesheet"/>
</head>
<body>
    <div class = "header">
            <img id = "mainImg" src = "vmilogo.svg" id = "logo">
            <h1 id = "esection">E-Section Marcher</h1>
    </div>

    <div class="navbar">
        <a href="adminHome.php">Home</a>
        <a href="adminOrdersSM.html">Re-Order SM</a>
        <a href="adminAddCadets.html">Add Cadets</a>
        <a href="adminAddCourse.html">Add Courses</a>
        <a class = "active">Enroll Cadets</a>
        <a id = "logout" href="logout.php">Logout</a>
    </div>

    <div>
        <center>
            <h1>Enroll Cadets</h1>
            
            <table>
                <form action = "insertEnroll.php" class = "addCadet" method="POST">
                    <tr><td>
                    <label>Select Cadet     </label></td>
                    <td><select id="cadet" name="cadet" required>
                        <?php 
                        $sql = "SELECT * FROM cadets order by last_name";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()) {

                            $cadet_id = $row['id_number'];
                            $cadet_first = $row['first_name'];
                            $cadet_last = $row['last_name'];
                            echo "<option value = '$cadet_id'>$cadet_first $cadet_last</option>";
                        }
                    }
                    ?>
                    </select></td></tr>

                    <tr>

                    <td><label>Select Course     </label></td>
                    <td><select id="course" name="course" required>
                    <?php
                    $sql = "SELECT * FROM courses join professor on professor.professor_id = courses.professor_id order by courses.department";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()) {
                            $course_id = $row['course_id'];
                            $department = $row['courses.department'];
                            $course_code = $row['course_code'];
                            $section = $row['section'];
                            if($section < 10){
                                $section = "0".$section;
                            }
                            $prof_id = $row['professor_id'];
                            $title = $row['title'];
                            $professor_first = $row['first_name'];
                            $professor_last = $row['last_name'];
                            $prof_full = $title." ".$professor_first." ".$professor_last;
                            $course = $department. " ".$course_code."-".$section;

                            echo "<option value = '$course_id'>$course - $prof_full</option>";
                        }
                    }
                    ?>
                     </select></td></tr>

                     <tr ><td colspan = "2"><input type="submit" name="submit" style = "width: 100%;"></td></tr>

        </form>
        </table>
        </center>
    </div>
</body>
</html>