<?php

include ("../config.php");

    $id_number = $_POST['id_number'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hash = password_hash($password, PASSWORD_DEFAULT);
    //echo $hash;
    //$2y$10$AshKyFFiEdhQzhwVU9JzqO7ZWN9h1y1xPSUkhKyeWx/fHVLfXD.ya
    //exit;





    $class = $_POST['class'];
    $rank = $_POST['rank'];
    $major = $_POST['major'];
    $company = $_POST['company'];

    $sql = "INSERT INTO cadets (id_number, first_name, last_name, email, password, class, rank, major, company) VALUES ('$id_number', '$first_name', '$last_name', '$email', '$hash', '$class', '$rank', '$major', '$company')";

    if ($conn->query($sql) === TRUE) {
    header('Location: adminAddCadets.html');
    echo "<script> alert('Account Successfully Created.)</script>";
        exit;
    }

    else { 
    echo "<script> alert('Account was not created. Please try again.)</script>";
} 

?>