<?php
session_start();
require_once('DBconnect.php');

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true || !isset($_SESSION['admin_verified']) || $_SESSION['admin_verified'] !== true) {
    header("Location: admin_login.php"); 
    exit;

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = isset($_POST['order_id']) ? trim($_POST['order_id']) : '';

    if (!empty($order_id)) {
        
        $approval_status = 'approved';
        $stmt = $conn->prepare("UPDATE orders SET approval_status = ? WHERE order_id = ?");
        $stmt->bind_param("si", $approval_status, $order_id);
        if ($stmt->execute()) {
            echo "Order status updated successfully.";
        } else {
            echo "Error updating order status: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Invalid input.";
    }
}

$conn->close();
header("Location: admin-dashboard.php");
exit;
?>