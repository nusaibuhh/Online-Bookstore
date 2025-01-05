<?php
session_start();
require_once('DBconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];


    
        
        $stmt = $conn->prepare("INSERT INTO requestbk (title, author) VALUES (?, ?)");
        $stmt->bind_param("ss", $title, $author);
        if ($stmt->execute()) {
            header("Location: book_request.php?request=success"); 
            exit; 
        } else {
            echo "<p class='error'>Registration failed: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    $conn->close();

?>