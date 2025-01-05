<?php
session_start();
require_once('DBconnect.php');

if (!isset($_SESSION['customer_email'])) {
    die("User not logged in.");
}

$email = $_SESSION['customer_email'];


$query = "
    SELECT c.book_id, c.quantity, c.tprice, o.approval_status
    FROM cart c
    LEFT JOIN orders o ON c.customer_email = o.email
    WHERE c.customer_email = ?
";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result_cart = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .cart-container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ccc;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .cart-total {
            text-align: right;
            font-size: 1.2em;
            margin-top: 20px;
        }
        .proceed-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .paid-statement {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #6c757d;
            color: white;
            text-align: center;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <h1>Your Cart</h1>
        <?php
            if (mysqli_num_rows($result_cart) > 0) {
                while ($row = mysqli_fetch_assoc($result_cart)) {
                    echo '<div class="book">';
                    echo '<h3>' . htmlspecialchars($row['book_id']) . '</h3>';
                    echo '<p>Quantity: ' . htmlspecialchars($row['quantity']) . '</p>';
                    echo '<p>Total Price: $' . htmlspecialchars($row['tprice']) . '</p>';
                    echo '</div>';
                }
                
                $order_approved = false;
                mysqli_data_seek($result_cart, 0); 
                while ($row = mysqli_fetch_assoc($result_cart)) {
                    if ($row['approval_status'] == 'approved') {
                        $order_approved = true;
                        break;
                    }
                }
                if ($order_approved) {
                    
                    $deleteCart = $conn->prepare("DELETE FROM cart WHERE customer_email = ?");
                    $deleteCart->bind_param("s", $email);
                    $deleteCart->execute();
                    $deleteCart->close();

                    
                    $deleteOrder = $conn->prepare("DELETE FROM orders WHERE email = ?");
                    $deleteOrder->bind_param("s", $email);
                    $deleteOrder->execute();
                    $deleteOrder->close();
                    
                    echo '<div class="paid-statement">Paid</div>';
                } else {
                    echo '<a href="payment.php" class="proceed-button">Proceed to Payment</a>';
                }
            } else {
                echo '<p>No books available.</p>';
            }
        ?>
    </div>
</body>
</html>