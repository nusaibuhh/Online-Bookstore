<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: admin_verification.php"); // Redirect to admin dashboard if already logged in
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
    <title>Login - Online Bookstore</title>   
</head>
<body>
    <section class="login">
        <div class="login_box">
            <header>
                <h1>Online Bookstore</h1>
            </header>
            <h2>Admin Login</h2>
            <?php
            if (isset($_GET['login']) && $_GET['login'] == 'failed') {
                echo "<p style='color:red;'>Wrong Password!</p>";
            }
            ?>
            <form class="login_form" action="login_admin.php" method="post">
                <input type="text" id="username" name="username" placeholder="username" required/>
                <input type="password" id="password" name="password" placeholder="Password" required/>
                <button type="submit" value="Submit" name="submit">Submit</button>
            </form>
        </div>
    </section>
</body>
</html>