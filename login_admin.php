<?php
session_start();
require_once( 'DBconnect.php' );

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $_SESSION['admin_loggedin'] = true;
        $_SESSION['admin_username'] = $username; 
        header('Location: admin_verification.php');
        exit;
    } 
    else {
        echo '<div class="alert alert-danger">not admin</div>';
        header ('Location: admin_login.php?login=failed');
    }
}
?>