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

    $id_number = $_REQUEST['id_number'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $class = $_REQUEST['class'];
    $rank = $_REQUEST['rank'];
    $major = $_REQUEST['major'];

    $sql = "INSERT INTO cadets (id_number, first_name, last_name, email, password, class, rank, major) VALUES ('$id_number', '$first_name', '$last_name', '$email', '$password', '$class', '$rank', '$major')";

    echo $sql;
    exit;

    if ($conn->query($sql) === TRUE) {
    header('Location: adminAddCadets.php');
    echo "<script> alert('Account Successfully Created.)</script>";
        exit;
    }

    else { 
    echo "<script> alert('Account was not created. Please try again.)</script>";
} 

?>