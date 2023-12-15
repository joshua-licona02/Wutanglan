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

    if(isset($_POST['searchSubmit'])){
        if(!empty($_POST['search'])){
            $search = $_POST['search'];
            $sql = "SELECT * FROM cadets WHERE first_name like '%$search%' or last_name like '%$search%' or id_number like '%$search%'";
            $result = $conn->query($sql);
            $conn->close();
        }
        else{

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
        <a class = "active">Search</a>
        <a href="">Instructions</a>
        <a href="">Template</a>
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
    <div>
        <center>
            <form method="POST" style="margin-top: 2%;">
                <table class = "search">
                    <tr>
                        <td style="text-align: center;">
                            <label for = "search" style = "font-weight: bold;">Search for Cadets, Courses, Sections, Instructors</label>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <input id = "searchBar" name = "search" style="width: 95%" type = "text" minlength="3">
                        </td>
                    </tr>
                    <tr>
                        <td align="center"><input type = "submit" text = "submit" name = "searchSubmit" style = "width: 20%;">
                        </td>
                    </tr>
                </table>
            </form>

            <section>

                <table width="98%" border="solid">
                    

                    <?php
                    echo "<tr>
                    <th>Results</th>
                    </tr>";
                // LOOP TILL END OF DATA
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {


                    echo "<tr><td><a>$test</a></td></tr>";
                }
            }
            ?>
                </table>
            </section>

        </center>
    </div>
</body>
</html>