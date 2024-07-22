<?php

if (isset($_SESSION['customer_email'])) {

    $c_id = $_SESSION['customer_email'];

    $query = "SELECT * FROM customer WHERE customer_email= '$c_id'";
    $run_query = mysqli_query($con, $query);
    $get_query = mysqli_fetch_array($run_query);

    $custom_id = $get_query['customer_id'];

    $get_items = "SELECT * FROM orders WHERE c_id = '$custom_id' ORDER BY date DESC";
    $run_items = mysqli_query($db, $get_items);

    echo "
    <div class='cart-table' style='min-height: 150px;'>
        <table class='table table-bordered'>
            <thead class='thead-dark'>
                <tr>
                    <th>Order ID</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
    ";

    if (mysqli_num_rows($run_items) > 0) {
        while ($row_items = mysqli_fetch_array($run_items)) {
            $o_id = $row_items['order_id'];
            $o_qty = $row_items['order_qty'];
            $o_price = $row_items['order_price'];
            $o_date = $row_items['date'];
            $o_status = $row_items['status'];
            $formattedPrice = number_format($o_price);
            $formatted_date = date('d-m-Y', strtotime($o_date));

            echo "
            <tr>
                <td>$o_id</td>
                <td>IDR $formattedPrice</td>
                <td>$o_qty</td>
                <td>$formatted_date</td>
                <td>$o_status</td>
                <td>
                    <a href='placed_order.php?order_id=$o_id' class='btn btn-secondary'>Details</a>";
            
            if ($o_status != 'Cancelled' && $o_status !="Processed" && $o_status !="Shipped") {
                echo "
                    <a href='payment.php?order_id=$o_id' class='btn btn-primary' style='margin-left: 5px;'>Payment</a>";
            }

            echo "
                </td>
            </tr>";
        }
    } else {
        echo "
        <tr>
            <td colspan='6' class='text-center'>Belum ada orderan</td>
        </tr>";
    }

    echo "
            </tbody>
        </table>
    </div>";
}

?>