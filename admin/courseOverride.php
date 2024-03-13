<?php
session_start();
if($_SESSION['loggedIn']) {
//allow
}else{
    
    echo "<script> alert('No user is logged in. Please login using your VMI credentials!'); window.location = 'login.php';</script>";
    
}

    include ("../config.php");

    $id = $_SESSION['id_number'];


	$sql = "SELECT * FROM course_schedule";

	$result = $conn->query($sql);


	if($result->num_rows > 0){

		while($row = $result->fetch_assoc()) {
			$status = $row['isClassNormal'];

			if($status == '0'){
				
				$status = "False";
			}
			else if($status == '1'){
				
				$status = "True";
			}

	}

	


	}
	mysqli_free_result($result);

	
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
        <a href="enrollCadets.php">Enroll Cadets</a>
        <a href="editCourseEnrollment.php">Course Roster Edit</a>
        <a class = "active">Course Override</a>
        <a id = "logout" href="logout.php">Logout</a>
    </div>

    <div>

        <center>

        	<h1>Course Override</h1>

        	<?php 

        	echo "<h2 style = 'background-color: Black; color: white;'>Current Course Status: "; 

        	if($status == "False"){
        		echo "<a style = 'color: Red'>Overridden</a>";
        	}
        	else{
        		echo "<a style = 'color: Green'>Normal</a>";
        	}

        	?>
        	
        	</h2>

        	
        	<form onsubmit = "confirm('Are you sure you want to override the class schedule?');" action = "override.php" method = "GET">
        		<table>
        		<tr><td>This button used to allow courses to be unlocked in the situation classes form up on different days than usual.</td></tr>
        		<tr><td style="padding-left: 43%;"><input style = "width: 20%;" type = "submit" name = "submit" value = "Override"></td></tr>
        		</table>


        	</form>



        	<div style = "margin-top: 5%">

	        	<form onsubmit = "confirm('Are you sure you want to return the class schedule to normal?');" action="returnCourseSchedule.php" method = "GET">
        		<table>
        		<tr><td>This button used to return courses to their normal days.</td></tr>
        		<tr><td style="padding-left: 20%;"><input style = "width: 75%;" type = "submit" name = "submit" value = "Return Course Schedule"></td></tr>
        		</table>


        	</form>


            </div>
            
        </center>
    </div>
</body>
</html>