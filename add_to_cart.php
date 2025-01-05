<?php
session_start();
require_once('DBconnect.php');

if (!isset($_SESSION['customer_email'])) {
    die("User not logged in.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_id'])) {
    $email = $_SESSION['customer_email'];
    $book_id = $_POST['book_id'];

    
    $query = $conn->prepare("SELECT title, price FROM book WHERE ISBN = ?");
    $query->bind_param("s", $book_id);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
        $title = $book['title'];
        $price = $book['price'];
        $quantity = 1; 
        $tprice = $price * $quantity;

        
        $checkCart = $conn->prepare("SELECT quantity FROM cart WHERE customer_email = ? AND book_id = ?");
        $checkCart->bind_param("ss", $email, $book_id);
        $checkCart->execute();
        $cartResult = $checkCart->get_result();

        if ($cartResult->num_rows > 0) {
            
            $cartItem = $cartResult->fetch_assoc();
            $new_quantity = $cartItem['quantity'] + $quantity;
            $new_tprice = $new_quantity * $price;
            $updateCart = $conn->prepare("UPDATE cart SET quantity = ?, tprice = ? WHERE customer_email = ? AND book_id = ?");
            $updateCart->bind_param("idss", $new_quantity, $new_tprice, $email, $book_id);
            $updateCart->execute();
        } else {
            
            $insertCart = $conn->prepare("INSERT INTO cart (customer_email, book_id, quantity, tprice) VALUES (?, ?, ?, ?)");
            $insertCart->bind_param("ssii", $email, $book_id, $quantity, $tprice);
            $insertCart->execute();
        }

        echo "Item added to cart!";
        header("Location: cart.php");
    } else {
        echo "Book not found.";
        header("Location: home.php");
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>

