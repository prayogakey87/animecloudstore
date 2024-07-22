<?php
include('../db.php');
include('../functions.php');
include('admin_header.php'); // Assumsi ada header khusus admin

if (!isset($_GET['order_id'])) {
    echo "<script>window.open('admin_orders.php', '_self')</script>";
}

$order_id = $_GET['order_id'];

if (isset($_POST['update_status'])) {
    $new_status = $_POST['status'];
    $update_query = "UPDATE orders SET status='$new_status' WHERE order_id='$order_id'";
    mysqli_query($con, $update_query);

    echo "<script>alert('Order status updated successfully!')</script>";
    echo "<script>window.open('admin_orders.php', '_self')</script>";
}

$query = "SELECT * FROM orders WHERE order_id = '$order_id'";
$run_query = mysqli_query($con, $query);
$order = mysqli_fetch_array($run_query);
$current_status = $order['status'];
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Update Order Status</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label for="status">Order Status:</label>
                    <select name="status" id="status" class="form-control">
                        <option value="New" <?php if ($current_status == 'New') echo 'selected'; ?>>New</option>
                        <option value="Processed" <?php if ($current_status == 'Processed') echo 'selected'; ?>>Processed</option>
                        <option value="Shipped" <?php if ($current_status == 'Shipped') echo 'selected'; ?>>Shipped</option>
                        <option value="Cancelled" <?php if ($current_status == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                    </select>
                </div>
                <button type="submit" name="update_status" class="btn btn-primary">Update Status</button>
                <a href="admin_orders.php" class="btn btn-secondary">Back to Orders</a>
            </form>
        </div>
    </div>
</div>

<?php include('admin_footer.php'); ?>
