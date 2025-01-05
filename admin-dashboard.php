<?php
session_start();
require_once('DBconnect.php');
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true || !isset($_SESSION['admin_verified']) || $_SESSION['admin_verified'] !== true) {
    header("Location: admin_login.php"); 
    exit;

}


$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles3.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
    </header>
    <div class="sidebar">
        <a href="#dashboard"><i class="fas fa-chart-line"></i> Dashboard</a>
        <a href="#manage-books"><i class="fas fa-book"></i> Bestsellers</a>
        <a href="#categories"><i class="fas fa-tags"></i> Featured</a>
        <a href="#orders"><i class="fas fa-shopping-cart"></i> Orders</a>
        <a href="admin_logout.php" class="fas fa-users">Logout</a>

    </div>
    <div class="main-content">
        <div class="card" id="dashboard">
            <h2>Dashboard Overview</h2>
            <p>Welcome, Admin! Here's an overview of what you can do:</p>
            <ul>
                <li>Add/delete best selling books!</li>
                <li>Add/Delete featured books!</li>
                <li>Approve orders!</li>
            </ul>
        </div>
        <div class="card" id="manage-books">
            <h2>Bestsellers</h2>
            <?php
            if (isset($_GET['add']) && $_GET['add'] == 'success') {
                echo "<p style='color:green;'>Book Added successfully!</p>";
            }
            ?>
            <form action="add_bestsellers.php" method="post">
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
            <h2>Delete Bestsellers</h2>
            <?php
            if (isset($_GET['delete']) && $_GET['delete'] == 'success') {
                echo "<p style='color:green;'>Book deleted successfully!</p>";
            }
            ?>
            <form action="delete_bestsellers.php" method="post">
                <label for="ISBN">Book ISBN:</label>
                <input type="text" id="ISBN" name="ISBN" required><br>
                <input type="submit" value="Delete Book">
            </form>
        </div>
        <div class="card" id="categories">
            <h2>Featured</h2>
            <?php
            if (isset($_GET['feat']) && $_GET['feat'] == 'success') {
                echo "<p style='color:green;'>Book added successfully!</p>";
            }
            ?>
            <form action="add_featured.php" method="post">
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
                <!-- <label for="publish_date">Publish Date:</label> -->
                <input type="date" id="publish_date" name="publish_date" required><br>
                <input type="submit" value="submit", name="submit">
            </form>
            <h2>Delete Featured</h2>
            <?php
            if (isset($_GET['dfeat']) && $_GET['dfeat'] == 'success') {
                echo "<p style='color:green;'>Book deleted successfully!</p>";
            }
            ?>
            <form action="delete_featured.php" method="post">
                <label for="ISBN">Book ISBN:</label>
                <input type="text" id="ISBN" name="ISBN" required><br>
                <input type="submit" value="Delete Book">
            </form>
        </div>
        <div class="container">
            <h2>All Orders</h2>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Email</th>
                    <th>House No</th>
                    <th>Street No</th>
                    <th>Approval Status</th>
                </tr>
                <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['order_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['house_no']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['street_no']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['approval_status']) . "</td>";
                    echo "<td>
                            <form action='update_order_status.php' method='post'>
                                <input type='hidden' name='order_id' value='" . htmlspecialchars($row['order_id']) . "'>
                                <button type='submit' name='approve' value='approve'>Approve</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No orders found.</td></tr>";
            }
            ?>
        </table>
    </div>
    <footer>
        <p>&copy; 2024 Admin Dashboard for Online Bookstore</p>
    </footer>
</body>
</html>