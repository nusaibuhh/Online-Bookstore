<?php
session_start();
if (!isset($_SESSION['supplier_loggedin']) || $_SESSION['supplier_loggedin'] !== true) {
    header("Location: supplier_login.php"); // Redirect to login page if not logged in
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles2.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification - Online Bookstore</title>
</head>
<body>
    <section class="login">
        <div class="login_box">
            <header>
                <h1>Online Bookstore</h1>
            </header>
            <h2>Supplier Verification</h2>
            <p>Please enter lisence number for verification.</p>
            <?php
            if (isset($_GET['verification']) && $_GET['verification'] == 'failed') {
                echo "<p style='color:red;'>Not Supplier!</p>";
            }
            ?>
            <form class="login_form" action="verify_supplier.php" method="post">
                <input type="text" id="lisence" name="lisence" placeholder="lisence" required/>
                <button type="submit" value="Submit" name="submit">Submit</button>
            </form>
            <div class="links">
                <p><a href="supplier_login.php">Back to Login</a></p>
            </div>
        </div>
    </section>
</body>
</html>