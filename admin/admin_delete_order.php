<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../db.php');
include('admin_header.php');

if (!isset($_GET['order_id'])) {
    echo "<script>window.open('admin_orders.php', '_self')</script>";
    exit;
}
else {
	$order_id = $_GET['order_id'];
	$delete_query = "DELETE FROM orders WHERE order_id=?";
    $stmt = mysqli_prepare($con, $delete_query);

    mysqli_stmt_bind_param($stmt, "i", $order_id);
    $run_delete = mysqli_stmt_execute($stmt);

    if ($run_delete) {
        echo "<script>alert('Order deleted successfully!')</script>";
        echo "<script>window.open('admin_orders.php', '_self')</script>";
    } else {
        echo "<script>alert('Failed to delete order')</script>";
    }

    mysqli_stmt_close($stmt);
}

include('admin_footer.php');
?>

