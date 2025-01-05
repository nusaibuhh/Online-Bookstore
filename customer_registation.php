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
                <h1 > Online Bookstore</h1>
            </header>
            <h2 style="color:RED">customer_register</h2>
            <?php
            if (isset($_GET['registration']) && $_GET['registration'] == 'success') {
                echo "<p style='color:green;'>Account Created successfully!</p>";
            }
            ?>
            <form class="registration_form" action="register_customer.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>

        <label for="email">Password:</label><br>
        <input type="password" id="password" name="password"required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="email">Phone_No:</label><br>
        <input type="phone_no" id="phone_no" name="phone_no" required><br>
        <label for="email">Street_No:</label><br>
        <input type="street_no" id="street_no" name="street_no" required><br>
        <label for="email">House_No:</label><br>
        <input type="house_no" id="house_no" name="house_no" required><br>

        <button type="submit" value="submit" name='submit'> Submit</button>
        
    </form>
        </div>
    </section>
</body>
</html>