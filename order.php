<?php
session_start();
require_once('DBconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $house_no = $_POST['house_no'];
    $street_no = $_POST['street_no'];
    $approval_status = "Pending";


    
        
        $stmt = $conn->prepare("INSERT INTO orders (email, house_no, street_no, approval_status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $email, $house_no, $street_no, $approval_status);
        if ($stmt->execute()) {
            header("Location: payment.php?status=success"); 
            exit; 
        } else {
            echo "<p class='error'>Registration failed: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    $conn->close();

?>