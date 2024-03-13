<?php
    session_start();

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

?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VMI E-Section Marcher | Add Course</title>
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
        <a class = "active">Add Courses</a>
        <a href="enrollCadets.php">Enroll Cadets</a>
        <a href="editCourseEnrollment.php">Course Roster Edit</a>
        <a href="courseOverride.php">Course Override</a>
        <a id = "logout" href="logout.php">Logout</a>
    </div>

   
<body>
    <center>
        <h2>Add Course</h2>

    <div class = "loginForm" border = "solid">
    <form action = "insertCourse.php" class = "addCadet" method="POST">

        <table class = "addCourseTable" style = "border: solid; border-collapse: collapse;">
            <tr class="emailLog">
                <td><label>Course Title:</label></td>
                <td><input id = "course_title" name = "course_title" type = "text" required></td>
            </tr>
            <tr>
                <td><label class = "emailLog">Major: </label></td>
                <td>
                <select id="major" name="major" required>
                <option selected value="CIS">CIS</option>
                <option value="BI">BI</option>
                <option value="CH">CH</option>
                <option value="PS">PS</option>
                <option value="HI">HI</option>
                <option value="PY">PY</option>
                <option value="CE">CE</option>
                <option value="ME">ME</option>
                <option value="ERH">ERH</option>
                <option value="EE">EE</option>
                <option value="AM">AM</option>
                <option value="EC">EC</option>
                <option value="IS">IS</option>
                <option value="ML">ML</option>
                <option value="BU">BU</option>
                <option value="AS">AS</option>
                </select>
                </td>
            </tr>


            <tr>
                <td><label class = "emailLog">Course Code (Ex: 431): </label></td>
                <td><input id = "course_code" name = "course_code" type = "text" required></td>
            </tr>
            <tr>
                <td><label class = "emailLog">Section (Ex: 1): </label></td>
                <td><input id = "section" name = "section" type = "text" required></td>
            </tr>
            <tr>
               
                <td><label>Section Days:</label>
                <td><input style = "width: 5%;" type="checkbox" id="Monday" name="Monday" value="M"></td>
                <td><label for="vehicle1">Monday</label></td>
                <td><input style = "width: 5%;" type="checkbox" id="Tuesday" name="Tuesday" value="T"></td>
                <td><label for="vehicle1">Tuesday</label></td>
                <td><input style = "width: 5%;" type="checkbox" id="Wednesday" name="Wednesday" value="W"></td>
                <td><label for="vehicle1">Wednesday</label></td>
                <td><input style = "width: 5%;" type="checkbox" id="Thursday" name="Thursday" value="R"></td>
                <td><label for="vehicle1">Thursday</label></td>
                <td><input style = "width: 5%;" type="checkbox" id="Friday" name="Friday" value="F"></td>
                <td><label for="vehicle1">Friday</label></td>
                
            </tr>


            <tr>

                <td><label class = "emailLog">Section Start Time: </label></td>
                <td><input id = "section_start" name = "section_start" type = "time" value="09:00" required></td>

            </tr>
            <tr>

                <td><label class = "emailLog">Section End Time: </label></td>
                <td><input id = "section_end" name = "section_end" type = "time" value="09:50" required></td>

            </tr>

            <tr>

                <td><label class = "emailLog">Semester: </label></td>
                <td><input id = "semester" name = "semester" type = "text" value="SP24" required></td>

            </tr>

            <tr>
 



                <td><label class = "emailLog">Instructor</label></td>
                <td><select id="professor" name="professor" required>
                    <?php 

                    $sql = "select * from professor";

                    $result = $conn->query($sql);
   
    
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()) {
                            $prof_id = $row['professor_id'];
                            $title = $row['title'];
                            $professor_first = $row['first_name'];
                            $professor_last = $row['last_name'];
                            $prof_full = $title." ".$professor_first." ".$professor_last;
                            echo "<option value='$prof_id'>$prof_full</option>";
                        }
                    }
                    ?>
                </select></td>
            </tr>

            <tr><td><label class = "emailLog">Building</label></td>
                <td><select id="building" name="building" required>

                    <?php 

                    $sql = "select * from building";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()) {
                            
                            $building_name = $row['building_name'];
                            echo "<option value='$building_name'>$building_name</option>";
                        }
                    }
                    ?>

                </select></td>
            </tr>

            <tr><td><label class = "emailLog">Classroom</label></td>
                <td><input id="classroom" name = "classroom" type="number"></td>
            </tr>





            <tr>
                <td align = "center" colspan="5" class = "submitLine"><input type = "submit" name = "submit" id = "submitBtn"></td>
            </tr>
        </table>
    </form>  
    </div>
    </center>
    <footer class="six" style = "margin-top: 5.5%;">
        <center>
            <p>&copy; Capstone Team 6</p>
        </center>
    </footer>
</body>

</html>