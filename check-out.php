<?php
$active = "Checkout";
include('db.php');
include("functions.php");
include("header.php");
?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="index.php"><i class="fa fa-home"></i> Home</a>
                    <a href="shop.php">Shop</a>
                    <span>Check Out</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="checkout-section spad">
    <div class="container">
        <form class="checkout-form" method="post" action="check-out">
            <div class="row">
                <div class="col-lg-6" <?php if (!($_SESSION['customer_email'] == 'unset')) { echo "style='margin: 0 auto'"; } ?>>
                    <div class="checkout-content">
                        <a href="shop.php" class="content-btn">Continue Shopping</a>
                    </div>
                    <div class="place-order">
                        <h4>Your Order</h4>
                        <div class="order-total">
                            <ul class="order-table">
                                <li>Products <span>Total</span></li>
                                <?php checkoutProds(); ?>
                                <li class="fw-normal">SUBTOTAL <span><?php list($subtotal, $total, $ppn) = total_price(); echo "IDR " . number_format($subtotal, 2); ?></span></li>
                                <li class="fw-normal">PPN 11% <span><?php echo "IDR " . calculate_ppn(); ?></span></li>
                                <li class="total-price">Total <span><?php echo "IDR " . number_format($total, 0); ?></span></li>
                            </ul>
                            <?php
                            // Check if cart is empty
                            $c_id = $_SESSION['customer_email'];
                            $get_items = "SELECT * FROM cart WHERE c_id = '$c_id'";
                            $run_items = mysqli_query($db, $get_items);
                            if (mysqli_num_rows($run_items) > 0) {
                                echo '<div class="order-btn">
                                    <button type="submit" name="place_order" class="site-btn place-btn">Place Order</button>
                                    </div>';
                            } else {
                                // echo '<div class="order-btn">
                                //     <button type="button" class="site-btn place-btn" disabled>No Items in Cart</button>
                                //     </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Shopping Cart Section End -->

<?php include('footer.php'); ?>

</body>
</html>

<?php
if (isset($_POST['place_order'])) {
    echo "<script>console.log('Order button clicked');</script>";

    $c_id = $_SESSION['customer_email'];
    $query = "SELECT * FROM customer WHERE customer_email = '$c_id'";
    $run_query = mysqli_query($con, $query);

    if (!$run_query) {
        die("Query Failed: " . mysqli_error($con));
    }

    $get_query = mysqli_fetch_array($run_query);
    $custom_id = $get_query['customer_id'];

    $get_items = "SELECT * FROM cart WHERE c_id = '$c_id'";
    $run_items = mysqli_query($db, $get_items);

    if (!$run_items) {
        die("Query Failed: " . mysqli_error($db));
    }

    $total_q = 0;
    $sub_total = 0;

    while ($row_items = mysqli_fetch_array($run_items)) {
        $p_id = $row_items['products_id'];
        $pro_qty = $row_items['qty'];
        $get_item = "SELECT * FROM products WHERE products_id = '$p_id'";
        $run_item = mysqli_query($db, $get_item);
        
        while ($row_item = mysqli_fetch_array($run_item)) {
            $pro_price = $row_item['product_price'];
            $total_q += $pro_qty;
            $pro_total_p = $pro_price * $pro_qty;
            $sub_total += $pro_total_p; // Menghitung subtotal sebelum PPN
        }
    }

    // Hitung PPN (11% dari subtotal)
    $ppn_rate = 0.11;
    $ppn = $sub_total * $ppn_rate;

    // Hitung final_price (subtotal + PPN)
    $final_price = $sub_total + $ppn;

    // Insert ke tabel orders
    $order_query = "INSERT INTO orders (order_qty, order_price, c_id, status, date, bukti_tf) VALUES ('$total_q', '$final_price', '$custom_id', 'New', NOW(), NULL)";
    $run_order = mysqli_query($con, $order_query);

    if (!$run_order) {
        die("Failed to place order: " . mysqli_error($con));
    }

    $order_id = mysqli_insert_id($con);

    $ip_add = getRealIpUser();
    $get_items = "SELECT * FROM cart WHERE c_id = '$c_id' ORDER BY date DESC";
    $run_items = mysqli_query($db, $get_items);

    while ($row_items = mysqli_fetch_array($run_items)) {
        $p_id = $row_items['products_id'];
        $size = $row_items['size'];
        $pro_qty = $row_items['qty'];
        
        $placed_query = "INSERT INTO placed_order (order_id, products_id, ip_add, qty, size, date, c_id) VALUES ('$order_id', '$p_id', '$ip_add', '$pro_qty', '$size', NOW(), '$c_id')";
        $run_placed = mysqli_query($con, $placed_query);

        if (!$run_placed) {
            die("Failed to insert placed order: " . mysqli_error($con));
        }
    }

    // Hapus item dari keranjang setelah berhasil melakukan order
    $cart_clear = "DELETE FROM cart WHERE c_id = '$c_id'";
    $run_clear = mysqli_query($con, $cart_clear);

    if (!$run_clear) {
        echo "<script>alert('Failed to place order!')</script>";
        die("Query Failed: " . mysqli_error($con));
    } else {
        echo "<script>alert('Order Placed. Thank you for Shopping. You will be redirected to the payment page.')</script>";
        echo "<script>window.location.href='payment.php?order_id=$order_id';</script>";
    }
}
?>
