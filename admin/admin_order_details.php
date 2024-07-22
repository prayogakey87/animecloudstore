<?php
include('../db.php');
include('../functions.php');
include('admin_header.php'); // Assumsi ada header khusus admin

if (!isset($_GET['order_id'])) {
    echo "<script>window.open('admin_orders.php', '_self')</script>";
}

$order_id = $_GET['order_id'];
$query = "SELECT * FROM orders WHERE order_id = '$order_id'";
$run_query = mysqli_query($con, $query);
$order = mysqli_fetch_array($run_query);

$c_id = $order['c_id'];
$order_price = $order['order_price'];
$order_date = $order['date'];
$order_status = $order['status'];
$bukti_tf = $order['bukti_tf'];

$get_customer = "SELECT * FROM customer WHERE customer_id = '$c_id'";
$run_customer = mysqli_query($con, $get_customer);
$customer = mysqli_fetch_array($run_customer);
$customer_email = $customer['customer_email'];
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Order Details</h2>
            <ul>
                <li>Order ID: <?php echo $order_id; ?></li>
                <li>Customer Email: <?php echo $customer_email; ?></li>
                <li>Total Price: IDR <?php echo $order_price; ?></li>
                <li>Order Date: <?php echo $order_date; ?></li>
                <li>Status: <?php echo $order_status; ?></li>
                <li>
                    Payment Proof:
                    <?php
                    if ($bukti_tf) {
                        echo "<img src='../img/buktitf/$bukti_tf' alt='Bukti Transfer' style='max-width: 100%; height: auto;'>";
                    } else {
                        echo "No payment proof uploaded.";
                    }
                    ?>
                </li>
            </ul>
            <a href="admin_orders.php" class="btn btn-secondary">Back to Orders</a>
        </div>
    </div>
</div>

<?php include('admin_footer.php'); ?>
