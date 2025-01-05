<?php
session_start();
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("Location: admin_login.php"); 
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
            <h2>Admin Verification</h2>
            <p>Please enter the special password for verification.</p>
            <?php
            if (isset($_GET['verify']) && $_GET['verify'] == 'failed') {
                echo "<p style='color:red;'>Not Admin!</p>";
            }
            ?>
            <form class="login_form" action="verify_admin.php" method="post">
                <input type="password" id="isadmin" name="isadmin" placeholder="isadmin" required/>
                <button type="submit" value="Submit" name="submit">Submit</button>
            </form>
            <div class="links">
                <p><a href="admin_login.php">Back to Login</a></p>
            </div>
        </div>
    </section>
</body>
</html>