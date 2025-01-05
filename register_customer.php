<?php
session_start();
require_once('DBconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $street_no = $_POST['street_no'];
    $house_no = $_POST['house_no'];


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<p class='error'>Invalid email format</p>";
    } else {

        
        $stmt = $conn->prepare("INSERT INTO customer (username, password, email, phone_no, street_no, house_no) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $password, $email, $phone_no, $street_no, $house_no);
        if ($stmt->execute()) {
            $_SESSION['email'] = $email;
            header("Location: customer_login.php?registration=success"); 
            exit; 
        } else {
            echo "<p class='error'>Registration failed: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    $conn->close();
}
?>