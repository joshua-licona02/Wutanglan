<?php
    session_start();
    if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "Cadet") {
    //allow
    }
    else{
    
    echo "<script> alert('No user is logged in. Please login using your VMI credentials!'); window.location = 'login.php';</script>";
    }


    if(isset($_GET['a'])){
    $_SESSION['accountability']= $_GET['a'];
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
                <?php 

                if($zero_Section == $num_of_courses){


                }
                else{
                    for($i=0; $i<count($course_ids); $i++){
                    echo "<a href = 'newCourse.php?a=$course_ids[$i]'>$full_codes[$i]</a></td>";
                }
                }
                
            ?>
            </div>
        </div> 
        <a>History</a>
        <a href = "cadetInstructions.php">Instructions</a>
        <a href="cadetInfo.php">Cadet Info</a>
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


    <div style="padding: 2%;">

        <center>
            <?php 

            $sql = "select first_name, last_name from cadets where id_number = '$id'";
            $result = $conn->query($sql);

             if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                   
                   $cadet_name = $row['first_name']." ".$row['last_name'];

                }
            }

            echo "<h2>Reports submitted by Cadet $cadet_name</h2>";

            ?>
            
            
            <table class = "cadet_courses" style = "width: 50%;">
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

            $account_id = $_SESSION['accountability'];
            
            $sql = "select cadets.first_name, cadets.last_name, cadets.class, cadets.rank, accountability.status, accountability.comments from accountability join cadets on accountability.cadet_id = cadets.id_number JOIN courses on courses.course_id = accountability.course_id where accountability_id >= '$account_id'";

        
            $result = $conn->query($sql);

            $cadetNum = 1;

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {

                    $first_name = $row['first_name'];
                    $last_name = $row['last_name'];
                    $class = $row['class'];
                    $rank = $row['rank'];
                    $status = $row['status'];
                    $comments = $row['comments'];
                    
                    echo "<tr><td>$cadetNum</td>";
                    echo "<td>$first_name</td>";
                    echo "<td>$last_name</td>";
                    echo "<td>$class</td>";
                    echo "<td>$rank</td>";
                    echo "<td>$status</td>";
                    echo "<td>$comments</td>";
                    echo "</tr>";
                    $cadetNum++;
                }
            }
            
            ?>
        </table>
        </center>
    </div>
</body>
</html>