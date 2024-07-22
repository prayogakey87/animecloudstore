<?php
include('../db.php');
include('../functions.php');
include('admin_header.php');
include('config.php');

?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Manage Orders</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Email</th>
                        <th>Total Price</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_orders = "SELECT * FROM orders ORDER BY date DESC";
                    $run_orders = mysqli_query($con, $get_orders);

                    while ($order = mysqli_fetch_array($run_orders)) {
                        $order_id = $order['order_id'];
                        $c_id = $order['c_id'];
                        $order_price = $order['order_price'];
                        $order_date = $order['date'];
                        $order_status = $order['status'];
                        
                        $get_customer = "SELECT * FROM customer WHERE customer_id = '$c_id'";
                        $run_customer = mysqli_query($con, $get_customer);
                        $customer = mysqli_fetch_array($run_customer);
                        $customer_email = $customer['customer_email'];

                        echo "
                        <tr>
                            <td>$order_id</td>
                            <td>$customer_email</td>
                            <td>IDR $order_price</td>
                            <td>$order_date</td>
                            <td>$order_status</td>
                            <td>
                                <a href='admin_order_details.php?order_id=$order_id' class='btn btn-primary btn-sm'>View</a>
                                <a href='admin_update_status.php?order_id=$order_id' class='btn btn-warning btn-sm'>Update Status</a>
                                <a href='admin_delete_order.php?order_id=$order_id' class='btn btn-secondary btn-sm'>Delete</a>
                            </td>
                        </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('admin_footer.php'); ?>
