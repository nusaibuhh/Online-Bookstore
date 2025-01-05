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
    <section class="request_section">
        <div class="login_box">
            <header>
                <h1 > Online Bookstore</h1>
            </header>
            <h2 style="color:blue">Order Request</h2>
            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'success') {
                echo "<p style='color:green;'>Order submitted successfully!</p>";
            }
            ?>
            <form class="request_form" action="order.php" method="post">
                <label for="email">Email:</label><br>
                <input type="text" id="email" name="email" required><br>

                <label for="house_no">House No.:</label><br>
                <input type="text" id="house_no" name="house_no"required><br>
                
                <label for="street_no">Street No.:</label><br>
                <input type="text" id="street_no" name="street_no"required><br>                

                <button type="submit" value="submit" name='submit'> Submit</button>

            </form>
        </div>
    </section>
</body>
</html>