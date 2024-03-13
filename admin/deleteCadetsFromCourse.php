<?php


//COMPLETELY EDIT THIS!!!!!!!!!

include ("../config.php");


    if(isset($_POST['checkSubmit'])){

        if(isset($_POST['cadet_ids'])){
            
            foreach($_POST['cadet_ids'] as $selected){

                $cadet_id = $selected;
                $sql = "DELETE FROM course_enrollment WHERE cadet_id = '$cadet_id'";

                if ($conn->query($sql) === TRUE) {
                    continue;
                }
                else{
                    echo "<script> alert('Cadet not removed from course!')</script>";
                    exit;
                }



            }

        }

        
        //fix this alert
        //echo "<script> alert('Cadets successfully removed from course.')</script>";
        echo "<script>alert('Cadets successfully removed from course'); window.location = 'editCourseEnrollment.php'</script>";
        exit;

        
    }

   
    
?>