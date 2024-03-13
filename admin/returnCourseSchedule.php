<?php

include ("../config.php");
require ("courseOverride.php");

if(isset($_GET['submit'])){
	
	$sql = "UPDATE course_schedule SET isClassNormal = 1 WHERE id = '2'";

	if ($conn->query($sql) === TRUE) {

		echo "<script>";
		echo "alert('Course Schedule has been returned to Normal!');";
		echo "window.location = 'courseOverride.php'"; // redirect with javascript, after page loads
		echo "</script>";

    }


}

?>