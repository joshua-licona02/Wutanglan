<?php
session_start();
if($_SESSION['loggedIn'] && $_SESSION['privilege'] == "Sec") {
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

    $sql = "SELECT dept from secretary where id_number = '$id'";   
    $result = $conn->query($sql);
    if($result->num_rows > 0){
    	while($row = $result->fetch_assoc()) {
    		$department = $row['dept'];
    		$_SESSION['dept'] = $department;
    	}
    }

    


?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VMI E-Section Marcher | Secretary</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link href="style.css" rel="stylesheet"/>
</head>
<body>
    <div class = "header">
            <img id = "mainImg" src = "vmilogo.svg" id = "logo">
            <h1 id = "esection">E-Section Marcher</h1>
    </div>

    <div class="navbar">
        <a class = "active">Home</a>
        <a href="sectSearch.php">Search</a>
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
            <h2>Welcome <?php echo $_SESSION['first_name'] . '!';?></h2>
            <table>
            <?php date_default_timezone_set('America/New_York');
			for($i = 0; $i < 9; $i++){
				$date = date('m/d/Y',strtotime('-'.$i.'days'));
				$timestamp = strtotime($date);
				$day = date('l', $timestamp);
				if($day == "Saturday" || $day == 'Sunday'){

			}else{
				echo "<tr><td><a target = '_blank' href='deptaccountReport.php?a=$date'>Pull Daily Report for " .$date. " (".$day.")</a></td></tr>";
			}			}
            
        ?>

            </table>
        </center>
    </div>
</body>
</html>