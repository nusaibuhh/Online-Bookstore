<?php
session_start();
require_once('DBconnect.php');


$search_query = '';
$result_book = null;

if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
    $sql_search = "SELECT ISBN, title, author, price FROM book WHERE title LIKE '%$search_query%' OR author LIKE '%$search_query%'";
    $result_book = mysqli_query($conn, $sql_search);
    if (!$result_book) {
        die("Search query failed: " . mysqli_error($conn));
    }
} else {
    $sql_all_books = "SELECT ISBN, title, author, price FROM book";
    $result_book = mysqli_query($conn, $sql_all_books);
    if (!$result_book) {
        die("All books query failed: " . mysqli_error($conn));
    }
}


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
            width: 100%;
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
    <a href="home.php"><i class="fas fa-home"></i> Home</a>
    <a href="#browse"><i class="fas fa-search"></i> Browse</a>
    <a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
    <a href="book_request.php"><i class="fas fa-shopping-cart"></i> Book Request</a>
</nav>
    <div class="container" id="browse">
        <h2>Browse Books</h2>
        <div class="search-bar">
            <form action="all_books.php" method="post">
                <input type="text" name="search" placeholder="Search for books..." value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit">Search</button>
            </form>
        </div>
      </div>
    <div class="container" id="home">
        <h2>All Books</h2>
        <div class="featured">
        <?php
            if (mysqli_num_rows($result_book) > 0) {
                while ($row = mysqli_fetch_assoc($result_book)) {
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
            }   else {
                echo '<p>No books available.</p>';
            }
            ?>
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