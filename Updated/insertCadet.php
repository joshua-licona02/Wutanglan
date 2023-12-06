<?php

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

    $id_number = $_POST['id_number'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $class = $_POST['class'];
    $rank = $_POST['rank'];
    $major = $_POST['major'];
    $company = $_POST['company'];

    $sql = "INSERT INTO cadets (id_number, first_name, last_name, email, password, class, rank, major, company) VALUES ('$id_number', '$first_name', '$last_name', '$email', '$password', '$class', '$rank', '$major', '$company')";

    if ($conn->query($sql) === TRUE) {
    header('Location: adminAddCadets.html');
    echo "<script> alert('Account Successfully Created.)</script>";
        exit;
    }

    else { 
    echo "<script> alert('Account was not created. Please try again.)</script>";
} 

?>