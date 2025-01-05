<?php
session_start();
require_once( 'DBconnect.php' );

if (!isset($_SESSION['supplier_loggedin']) || $_SESSION['supplier_loggedin'] !== true) {
    header("Location: supplier_login.php"); 
    exit;
}


if(isset($_POST['lisence'])) {
    $lisence = $_POST['lisence'];
    $sql = "SELECT * FROM supplier WHERE lisence = '$lisence'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $_SESSION['supplier_verified'] = true;
        header('Location: supplier-dashboard.php');
        exit;
    } 
    else {
        echo '<div class="alert alert-danger">not supplier</div>';
        header ('Location: supplier_verification.php?verification=failed');
    }
}
?>