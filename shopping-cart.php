<?php
$active = "Shopping Cart";
include("db.php");
include("functions.php");
include('header.php');
?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="index.php"><i class="fa fa-home"></i> Home</a>
                    <a href="shop.php">Shop</a>
                    <span>Shopping Cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="shopping-cart" method="post">
                    <div class="cart-table" style="min-height: 150px;">
                        <table>
                            <tbody>
                                <?php cart_items(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="shop.php" class="primary-btn continue-shop">Continue shopping</a>
                                <button type="submit" name="update_cart" class="primary-btn up-cart">Update cart</button>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span><?php list($subtotal, $total, $ppn) = total_price(); echo "IDR " . number_format($subtotal, 0); ?></span></li>
                                    <li class="cart-total">Total <span><?php list($subtotal, $total, $ppn) = total_price(); echo "IDR " . number_format($total, 0); ?></span></li>
                                </ul>
                                <a href="check-out.php" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

<?php
if (isset($_POST['update_cart'])) {
    $c_id = $_SESSION['customer_email'];

    foreach ($_POST['qty'] as $p_id => $qty) {
        $qty = intval($qty); 
        $size = $_POST['size'][$p_id]; 

        if ($qty > 0 && $qty <= 99) {
            $query = "UPDATE cart SET qty='$qty' WHERE products_id='$p_id' AND size='$size' AND c_id='$c_id'";
            $run_query = mysqli_query($db, $query);

            if ($run_query) {
                //echo "<script>alert('Updated $p_id with size $size to quantity $qty');</script>";
            } else {
                echo "<script>alert('Failed to update $p_id with size $size');</script>";
            }
        }
    }

    echo "<script>window.open('shopping-cart.php','_self');</script>";
}

if (isset($_GET['del']) && isset($_GET['size'])) {
    $p_id = $_GET['del'];
    $size = $_GET['size'];
    $c_id = $_SESSION['customer_email']; // Get customer id
    $query = "DELETE FROM cart WHERE products_id='$p_id' AND size='$size' AND c_id='$c_id'";
    $run_query = mysqli_query($db, $query);
    echo "<script>window.open('shopping-cart.php','_self');</script>";
}

include('footer.php');
?>

</body>
</html>

