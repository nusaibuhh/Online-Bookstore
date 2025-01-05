<?php
session_start();
require_once( 'DBconnect.php' );

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("Location: admin_login.php"); 
    exit;
}


if(isset($_POST['isadmin'])) {
    $isadmin = $_POST['isadmin'];
    $sql = "SELECT * FROM admin WHERE isadmin = '$isadmin'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $_SESSION['admin_verified'] = true;
        header('Location: admin-dashboard.php');
        exit;
    } 
    else {
        echo '<div class="alert alert-danger">not admin</div>';
        header ("Location: admin_verification.php?verify=failed");
    }
}
?>