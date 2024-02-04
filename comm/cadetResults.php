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

    if(isset($_GET['a'])){
        $cadet_id= $_GET['a'];
    }

    //user_id
    $id = $_SESSION['id_number'];

    $sql = "SELECT * FROM `cadets` where id_number = '$cadet_id'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            $cadet_first = $row['first_name'];
            $cadet_last = $row['last_name'];
            $cadet_class = $row['class'];
            $cadet_rank = $row['rank'];
            $cadet_email = $row['email'];

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
            <h1>Cadet Result</h1>
            <h2><?php echo "$cadet_rank $cadet_first $cadet_last: Class of $cadet_class";?></h2>
            <h3>ID Number: <?php echo "$cadet_id";?></h3>
            <h4>Email: <?php echo "<a href = 'mailto: '$cadet_email''>$cadet_email</a>"?></h4>

            <table>
                <tr><td><a href = "cadetAttendance.php?a=<?php echo "$cadet_id";?>">View Attendance</td></tr>
                <tr><td>View Submitted Section Marcher Reports</td></tr>

            </table>
        </center>
    </div>
</body>
</html>