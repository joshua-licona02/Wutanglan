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
            <h3><?php echo $_SESSION['first_name']?>, you are the 1st Section Marcher for CIS-480-02.</h3>
            <h4>Faculty: Dr. Dennis Gracanin</h4>

            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Class</th>
                    <th>Rank</th>
                    <th>Status</th>
                    <th>Comments (Optional)</th>
                </tr>

                    <tr>
                        <td>Jacob</td>
                        <td>Johnston</td>
                        <td>2024</td>
                        <td>CPT</td>
                        <td>
                           <select id="status" name="status" required>
                                <option selected value="Present">Present</option>
                                <option value="Late">Late <5 mins</option>
                                <option value="Late Late">Late 5-15 mins</option>
                                <option value="Absent">Absent</option>
                            </select>
                        </td>
                        <td>
                            <input type="textarea">
                        </td>
                    </tr>
                    <tr>
                        <td>Jacob</td>
                        <td>Hill</td>
                        <td>2024</td>
                        <td>1LT</td>
                        <td>
                           <select id="status" name="status" required>
                                <option selected value="Present">Present</option>
                                <option value="Late">Late <5 mins</option>
                                <option value="Late Late">Late 5-15 mins</option>
                                <option value="Absent">Absent</option>
                            </select>
                        </td>
                        <td>
                            <input type="textarea">
                        </td>



                    </tr>

                    <tr>
                        <td>Rachel</td>
                        <td>Greathouse</td>
                        <td>2025</td>
                        <td>PVT</td>
                        <td>
                           <select id="status" name="status" required>
                                <option selected value="Present">Present</option>
                                <option value="Late">Late <5 mins</option>
                                <option value="Late Late">Late 5-15 mins</option>
                                <option value="Absent">Absent</option>
                            </select>
                        </td>
                        <td>
                            <input type="textarea">
                        </td>
                    </tr>

                
                



            </table>



        </center>
    </div>
</body>
</html>