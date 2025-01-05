<?php
session_start();
require_once('DBconnect.php');


$sql_featured = "SELECT ISBN, title, author, price FROM featured";
$result_featured = mysqli_query($conn, $sql_featured);


$sql_bestsellers = "SELECT ISBN, title, author, price FROM bestsellers";
$result_bestsellers = mysqli_query($conn, $sql_bestsellers);

$sql_fiction = "SELECT ISBN, title, author, price FROM book WHERE genre = 'Fiction'";
$result_fiction = mysqli_query($conn, $sql_fiction);

$sql_nonfiction = "SELECT ISBN, title, author, price FROM book WHERE genre = 'Non-Fiction'";
$result_nonfiction = mysqli_query($conn, $sql_nonfiction);


$default_image_url = 'default/default.jpg';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookstore</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5ebee;
            width : 100%;
            height: 100vh;
        }
        header {
            background-color: #f2dce2;
            color: black;
            padding: 10px 20px;
            text-align: center;
        }
        h2 {
          margin: 1em, auto;
          text-align: center;
        
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #000;
        }
        nav a {
            color: pink;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
        }
        nav a:hover {
            background-color: #fc2d65;
        }
        .container {
            padding: 20px;
        }
        .featured, .books, .search-bar {
            margin-top: 30px;
            width: 100vw;
            max-width: 500px;
            min-width: 300px;
            margin: 0 auto;
            padding-bottom: 2em;
        }
        .book {
            background-color: #fff;
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
            text-align: center;
            width: 200px;
        }
        .book img {
            max-width: 100%;
            height: auto;
        }        
        .search-bar input {
            width: 80%;
            padding: 10px;
        }
        .search-bar button {
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Online Bookstore</h1>
    </header>
 <nav>
    <a href="#home"><i class="fas fa-home"></i> Home</a>
    <a href="#bestsellers"><i class="fas fa-chart-line"></i> Bestsellers</a>
    <a href="#fiction"><i class="fas fa-book"></i> Fiction</a>
    <a href="#non-fiction"><i class="fas fa-book-open"></i> Non-Fiction</a>
    <a href="all_books.php"><i class="fas fa-search"></i> Browse</a>
    <a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
    <a href="customer_login.php"><i class="fas fa-user"></i> Log In</a>
</nav>

    <div class="featured" id="home">
        <h2>Featured Books</h2>
        <div class="featured">
        <?php
            if (mysqli_num_rows($result_featured) > 0) {
                while ($row = mysqli_fetch_assoc($result_featured)) {
                    echo '<div class="book">';
                    echo '<img src="' . $default_image_url . '" alt="' . htmlspecialchars($row['title']) . '">';
                    echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['author']) . '</p>';
                    echo '<p>' . htmlspecialchars($row['price']) . '</p>';
                    echo '<form action="add_to_cart.php" method="post">';
                    echo '<input type="hidden" name="book_id" value="' . htmlspecialchars($row['ISBN']) . '">';
                    echo '<button type="submit">Add to Cart</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>No featured books available.</p>';
            }
            ?>
        </div>
    </div>
    <div class="books" id="bestsellers">
        <h2>Bestsellers</h2>
        <div class="books">
        <?php
            if (mysqli_num_rows($result_bestsellers) > 0) {
                while ($row = mysqli_fetch_assoc($result_bestsellers)) {
                    echo '<div class="book">';
                    echo '<img src="' . $default_image_url . '" alt="' . htmlspecialchars($row['title']) . '">';
                    echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['author']) . '</p>';
                    echo '<p>' . htmlspecialchars($row['price']) . '</p>';
                    echo '<form action="add_to_cart.php" method="post">';
                    echo '<input type="hidden" name="book_id" value="' . htmlspecialchars($row['ISBN']) . '">';
                    echo '<button type="submit">Add to Cart</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>No bestsellers available.</p>';
            }
            ?>
        </div>
        </div>
    <button href="all_books.php" class="see-more-btn" data-section="bestsellers">See More</button>
</div>
    </div>
    <div class="books" id="fiction">
        <h2>Fiction</h2>
        <div class="books">
        <?php
            if (mysqli_num_rows($result_fiction) > 0) {
                while ($row = mysqli_fetch_assoc($result_fiction)) {
                    echo '<div class="book">';
                    echo '<img src="' . $default_image_url . '" alt="' . htmlspecialchars($row['title']) . '">';
                    echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['author']) . '</p>';
                    echo '<p>' . htmlspecialchars($row['price']) . '</p>';
                    echo '<form action="add_to_cart.php" method="post">';
                    echo '<input type="hidden" name="book_id" value="' . htmlspecialchars($row['ISBN']) . '">';
                    echo '<button type="submit">Add to Cart</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>No fiction books available.</p>';
            }
            ?>
        </div>
        </div>
    <button href="all_books.php" class="see-more-btn" data-section="fiction">See More</button>
</div>
    </div>
    <div class="books" id="non-fiction">
        <h2>Non-Fiction</h2>
        <div class="books">
        <?php
            if (mysqli_num_rows($result_nonfiction) > 0) {
                while ($row = mysqli_fetch_assoc($result_nonfiction)) {
                    echo '<div class="book">';
                    echo '<img src="' . $default_image_url . '" alt="' . htmlspecialchars($row['title']) . '">';
                    echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['author']) . '</p>';
                    echo '<p>' . htmlspecialchars($row['price']) . '</p>';
                    echo '<form action="add_to_cart.php" method="post">';
                    echo '<input type="hidden" name="book_id" value="' . htmlspecialchars($row['ISBN']) . '">';
                    echo '<button type="submit">Add to Cart</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>No non-fiction books available.</p>';
            }
            ?>
        </div>
        </div>
    <button href="all_books.php" class="see-more-btn" data-section="non-fiction">See More</button>
</div>
    </div>
  <footer>
        <p>&copy; 2024 Online Bookstore. All rights reserved.</p>
        <p>Follow us:
            <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
            <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
            <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
        </p>
    </footer>
</body>
</html>