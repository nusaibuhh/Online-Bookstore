<?php
session_start();
require_once( 'DBconnect.php' );

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM supplier WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $_SESSION['supplier_loggedin'] = true;
        $_SESSION['supplier_username'] = $username; 
        header('Location: supplier_verification.php');
        exit;
    } 
    else {
        echo '<div class="alert alert-danger">not supplier</div>';
        header ('Location: supplier_login.php?slogin=failed');
    }
}
?>