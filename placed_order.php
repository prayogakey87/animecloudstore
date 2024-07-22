<?php
$active = "placed_order";
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
                    <span>Order Details</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="checkout-section spad">
    <div class="container">
        <form class="checkout-form" method="post" action="placed_order">
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
                                <?php 
                                // Mengambil order_id dari URL
                                $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;
                                // Memanggil fungsi detailOrder dengan order_id yang diambil dari URL
                                detailOrder($order_id); 
                                ?>
                                <li class="fw-normal">SUBTOTAL <span><?php list($subtotal, $total, $ppn) = total_order(); echo "IDR " . number_format($subtotal, 2); ?></span></li>
                                <li class="fw-normal">PPN 11% <span><?php echo "IDR " . ppn(); ?></span></li>
                                <li class="total-price">Total <span><?php echo "IDR " . number_format($total, 0); ?></span></li>
                            </ul>
                            <div class="order-btn">
                                <button type="button" class="site-btn place-btn" style="margin-left: 10px;" onclick="window.location.href='account.php?orders'">Back</button>
                            </div>
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
function ppn() {
    list($subtotal, $total, $ppn) = total_order();
    return number_format($ppn, 0);
}
?>
