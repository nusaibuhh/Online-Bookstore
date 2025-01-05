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
            <h2 style="color:blue">Book Request</h2>
            <?php
            if (isset($_GET['request']) && $_GET['request'] == 'success') {
                echo "<p style='color:green;'>Book requested successfully!</p>";
            }
            ?>
            <form class="request_form" action="request_book.php" method="post">
                <label for="title">Book name:</label><br>
                <input type="text" id="title" name="title" required><br>

                <label for="author">Author Name:</label><br>
                <input type="author" id="author" name="author"required><br>

                <button type="submit" value="submit" name='submit'> Submit</button>

            </form>
        </div>
    </section>
</body>
</html>