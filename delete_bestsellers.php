<?php
session_start();
require_once("DBconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ISBN = isset($_POST['ISBN']) ? trim($_POST['ISBN']) : '';

    if (empty($ISBN)) {
        die("ISBN is required.");
    }

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $stmt = $conn->prepare("DELETE FROM bestsellers WHERE ISBN = ?");
    if (!$stmt) {
        die("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("s", $ISBN);

    if ($stmt->execute()) {
        echo "Book deleted successfully";
        header ("Location: admin-dashboard.php?delete=success");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>