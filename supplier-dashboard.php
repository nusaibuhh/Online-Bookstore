<?php
session_start();
if (!isset($_SESSION['supplier_loggedin']) || $_SESSION['supplier_loggedin'] !== true || !isset($_SESSION['supplier_verified']) || $_SESSION['supplier_verified'] !== true) {
    header("Location: supplier_login.php"); 
    exit;
}

require_once('DBconnect.php');

$sql_all_bks = "SELECT title, author FROM requestbk";
$result_bk = mysqli_query($conn, $sql_all_bks);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Dashboard</title>
</head>
<body>
    <header>
        <h1>Supplier Dashboard</h1>
    </header>
    <nav>
        <a href="index.php">Logout</a>
    </nav>
    <div class="sidebar">
        <a href="#dashboard"><i class="fas fa-chart-line"></i> Dashboard</a>
        <a href="#add-new-books"><i class="fas fa-book"></i> Add New Books</a>
        <a href="#delete-book"><i class="fas fa-tags"></i> Delete Books</a>
        <a href="#requests"><i class="fas fa-users"></i> Requests</a>
        <a href="supplier_logout.php" class="fas fa-users">Logout</a>
    </div>
    <div class="main-content">
        <div class="card" id="dashboard">
            <h2>Dashboard Overview</h2>
            <p>Welcome, Supplier! Here's an overview of what you can do:</p>
            <ul>
                <li>Add books!</li>
                <li>Delete books!</li>
                <li>See book requests!</li>
            
            </ul>
        </div>
        <div class="card" id="manage-books">
        <h2>Add New Books</h2>
        <?php
            if (isset($_GET['addb']) && $_GET['addb'] == 'success') {
                echo "<p style='color:green;'>Book Added successfully!</p>";
            }
            ?>
        <form action="add_book.php" method="post">
            <label for="ISBN">ISBN:</label>
            <input type="text" id="ISBN" name="ISBN" required><br>            
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required><br>
            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" required><br>            
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required><br>
            <label for="publish_date">Publish Date:</label>
            <input type="date" id="publish_date" name="publish_date" required><br>
            <input type="submit" value="submit", name="submit">
        </form>
        <h2>Delete Book</h2>
        <?php
            if (isset($_GET['deleteb']) && $_GET['deleteb'] == 'success') {
                echo "<p style='color:green;'>Book deleted successfully!</p>";
            }
            ?>
        <form action="delete_book.php" method="post">
            <label for="ISBN">Book ISBN:</label>
            <input type="text" id="ISBN" name="ISBN" required><br>
            <input type="submit" value="Delete Book">
        </form>
    </div>
    <div class="card" id="requests">
        <h2>Request Books</h2>
        <div class="requestbk">
        <?php
            if (mysqli_num_rows($result_bk) > 0) {
                while ($row = mysqli_fetch_assoc($result_bk)) {
                    echo '<div class="book">';
                    echo '<h3>' . $row['title'] . '</h3>';
                    echo '<p>' . $row['author'] . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No books available.</p>';
            }
            ?>
        </form>
    </div>
</div>
    <footer>
        <p>&copy; 2024 Supplier Dashboard for Online Bookstore</p>
    </footer>
</body>
</html>