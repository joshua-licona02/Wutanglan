<?php
session_start();
if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "Sec") {
//allow
}else{
    
    echo "<script> alert('No user is logged in. Please login using your VMI credentials!'); window.location = 'login.php';</script>";
    
}

    include ("../config.php");

    $id = $_SESSION['id_number'];

    if(isset($_POST['searchSubmit'])){
        if(!empty($_POST['search'])){         
            $_GET['searchbar'] = $_POST['search'];
            $_GET['person'] = $_POST['role'];

            $search = $_POST['search'];
            $role = $_POST['role'];

            if($role == "Cadet"){
                
                $sql = "SELECT * FROM cadets WHERE first_name like '%$search%' or last_name like '%$search%' or id_number like '%$search%' or email like '%$search%' or class like '%$search%' order by last_name";
                $result = $conn->query($sql);
            }
            if($role == "Course"){
                $sql = "SELECT course_id, course_title,course_code, section, courses.department, first_name, last_name, title from courses JOIN professor on courses.professor_id = professor.professor_id where courses.department like '%$search%' or last_name like '%$search%' or course_title like '%$search%' or course_code like '%$search%' AND courses.department = 'CIS'";
                $result = $conn->query($sql);
            }

            if($role == "Professor"){
                $sql = "SELECT course_title,course_code, section, courses.department, first_name, last_name, title from courses JOIN professor on courses.professor_id = professor.professor_id where last_name like '%$search%'";
                $result = $conn->query($sql);
            }

            $conn->close();
        }
        else{

            $empty = true;

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
        <a href="sectHome.php">Home</a>
        <a class = "active">Search</a>
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
            <form method="POST" style="margin-top: 2%;">
                <label style = "font-weight: bold;">Search by:</label>
                <select style = "width:10%; font-size: 15px;"id="role" name="role" required>
                    <?php


                    if(isset($_GET['person'])){
                        if($_GET['person'] == "Cadet"){
                            echo "
                            <option selected value='Cadet'>Cadet</option>
                            <option value='Course'>Course</option>
                            <option value='Professor'>Instructor</option>";
                        } 
                        else if($_GET['person'] == "Course"){
                            echo "
                            <option value='Cadet'>Cadet</option>
                            <option selected value='Course'>Course</option>
                            <option value='Professor'>Instructor</option>";
                        } 
                        else{
                            echo "
                            <option value='Cadet'>Cadet</option>
                            <option value='Course'>Course</option>
                            <option selected value='Professor'>Instructor</option>";
                        }
                    } 
                    else{
                        echo "
                        <option selected value='Cadet'>Cadet</option>
                        <option value='Course'>Course</option>
                        <option value='Professor'>Instructor</option>"; 
                    }
                    
                    ?>
                        
                    </select>

                    <table class = "search">
                        <tr>
                        <td style="text-align: center;">
                            <label for = "search" style = "font-weight: bold;">Search for Cadets, Courses, Sections, Instructors</label>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <input name = "search" style="width: 95%" type = "text" minlength="3" value = "<?php echo $_GET['searchbar'];?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="center"><input type = "submit" text = "submit" name = "searchSubmit" style = "width: 20%;">
                        </td>
                    </tr>
                </table>
            </form>

            <section>
                <table class = 'results sortable' width='98%' border='solid'>

                <?php 
                    
                    if ($role == "Cadet" && $result->num_rows > 0) {
                        echo "<tr>
                        <th>ID Number</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Rank</th>
                        <th>Class</th>
                        <th>E-mail</th>
                        </tr>";
                        while($row = $result->fetch_assoc()) {
                            $cadet_id = $row['id_number'];
                            echo "<tr><td><a href = 'cadetResults.php?a=$cadet_id'>".
                            $row['id_number']."</a></td>";
                            echo "<td>".$row['first_name']."</td>";
                            echo "<td>".$row['last_name']."</td>";
                            echo "<td>".$row['rank']."</td>";
                            echo "<td>".$row['class']."</td>";
                            echo "<td><a href = 'mailto:".$row['email'].
                            "'>".$row['email']."</td>";
                            echo "</tr>";
                        }
                    }

                    else if($role == "Course" && $result->num_rows > 0){
                        echo "<tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Instructor</th>
                        </tr>";
                        while($row = $result->fetch_assoc()) {
                            $dept = $row['department'];
                            $code = $row['course_code'];
                            $section = $row['section'];
                            if($section < 10){
                                $section = '0'.$section;
                            }
                            $fullCode = $dept." ".$code."-".$section;

                            $first_name = $row['first_name'];
                            $last_name = $row['last_name'];
                            $rank = $row['title'];
 
                            $instructor = $rank." ".$first_name." ".$last_name;
                            $course_id = $row['course_id'];

                            echo "<tr><td><a href='courseResults.php?a=$course_id'>".$fullCode."</td>";
                            echo "<td>".$row['course_title']."</td>";
                            echo "<td><a href='profResults.php'>".$instructor."</a></td>";
                            echo "</tr>";

                    }
                }

                else if($role == "Professor" && $result->num_rows > 0){
                        echo "<tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Instructor</th>
                        </tr>";
                        while($row = $result->fetch_assoc()) {
                            $dept = $row['department'];
                            $code = $row['course_code'];
                            $section = $row['section'];
                            if($section < 10){
                                $section = '0'.$section;
                            }
                            $fullCode = $dept." ".$code."-".$section;

                            $first_name = $row['first_name'];
                            $last_name = $row['last_name'];
                            $rank = $row['title'];
 
                            $instructor = $rank." ".$first_name." ".$last_name;

                            echo "<tr><td><a href='courseResults.php'>".$fullCode."</td>";
                            echo "<td>".$row['course_title']."</td>";
                            echo "<td><a href='profResults.php'>".$instructor."</a></td>";
                            echo "</tr>";

                    }
                }

                else{
                   
                   if($empty == true){
                        echo "<h1 style = 'color: red;'>Nothing Entered! Please try again.</h1>";
                    }
                    if($empty == false && !empty($_POST['search'])){
                        echo "<h1 style = 'color: red;'>No Results Found! Please try again.</h1>";
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