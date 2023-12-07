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

    $email = $_SESSION['email'];

    $sql = "SELECT * FROM cadets WHERE email = '$email'";
    $result = $conn->query($sql);

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
        }
    }
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
                <a href="templateCourse.php">CIS-480-02</a>
                <a href="#">CIS-402-01</a>
                <a href="#">HPW-327-03</a>
            </div>
        </div> 
        <a href="cadetHistory.php">History</a>
        <a href="cadetInstructions.php">Instructions</a>
        <a class = "active">Cadet Info</a>
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


    <div style="padding: 2%;">

        <center>
            <table class = "cadet_info">
                <th colspan="2">Cadet Info</th>
                
                <tr>
                    <td style = "font-weight: bold;">ID Number</td>
                    <td><?php echo $id;?></td>
                </tr>

                <tr>
                    <td style = "font-weight: bold;">Email</td>
                    <td><?php echo $email;?></td>
                </tr>

                <tr>
                    <td style = "font-weight: bold;">First Name</td>
                    <td><?php echo $first_name;?></td>
                </tr>
                <tr>
                    <td style = "font-weight: bold;">Last Name</td>
                    <td><?php echo $last_name;?></td>
                </tr>
                <tr>
                    <td style = "font-weight: bold;">Class</td>
                    <td><?php echo $class;?></td>
                </tr>
                <tr>
                    <td style = "font-weight: bold;">Company/Staff</td>
                    <td><?php echo $company;?></td>
                </tr>
                <tr>
                    <td style = "font-weight: bold;">Rank</td>
                    <td><?php echo $rank;?></td>
                </tr>
            </table>
        </center>
    </div>
</body>
</html>