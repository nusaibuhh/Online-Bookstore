<?php
session_start();
require_once("DBconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $ISBN = isset($_POST['ISBN']) ? trim($_POST['ISBN']) : '';
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $author = isset($_POST['author']) ? trim($_POST['author']) : '';
    $genre = isset($_POST['genre']) ? trim($_POST['genre']) : '';
    $price = isset($_POST['price']) ? trim($_POST['price']) : '';
    $publish_date = isset($_POST['publish_date']) ? trim($_POST['publish_date']) : '';

    
    if (empty($ISBN) || empty($title) || empty($author) || empty($genre) || empty($price) || empty($publish_date)) {
        die("All fields are required.");
    }

    
    if (!is_numeric($price) || $price < 0) {
        die("Invalid price.");
    }

    if (!DateTime::createFromFormat('Y-m-d', $publish_date)) {
        die("Invalid publish date format. Use YYYY-MM-DD.");
    }


    $stmt = $conn->prepare("INSERT INTO featured (ISBN, title, author, genre, price, publish_date) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("ssssds", $ISBN, $title, $author, $genre, $price, $publish_date);

    if ($stmt->execute()) {
        echo "New book added successfully";
        header ("Location: admin-dashboard.php?feat=success");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>