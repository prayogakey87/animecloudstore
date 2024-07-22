<?php
include('db.php');
include("functions.php");
include("header.php");

if (!isset($_GET['order_id'])) {
    echo "<script>window.open('index.php', '_self')</script>";
}

$order_id = $_GET['order_id'];
$query = "SELECT * FROM orders WHERE order_id = '$order_id'";
$run_query = mysqli_query($con, $query);
$order = mysqli_fetch_array($run_query);
$final_price = $order['order_price'];
$order_date = $order['date'];
$payment_due = date('Y-m-d H:i:s', strtotime($order_date . ' + 1 day'));
$bukti_tf = $order['bukti_tf'];
?>

<!-- Payment Section Begin -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title">Payment Information</div>
            <p>Your order has been placed successfully. Please transfer the total amount to the following bank account within 1 day.</p>
            <ul>
                <li>Bank: BCA</li>
                <li>Account Name: Prayoga Kurniawan</li>
                <li>Account Number: 7015392894</li>
                <li>Total Amount: IDR <?php echo number_format($final_price, 0); ?></li>
                <li>Payment Due: <?php echo $payment_due; ?></li>
            </ul>
            <p>After transferring the amount, please upload the payment receipt below:</p>
            
            <!-- Display uploaded receipt if exists -->
            <?php if ($bukti_tf): ?>
                <div class="mb-3">
                    <img src="img/buktitf/<?php echo $bukti_tf; ?>" alt="Bukti Transfer" style="max-width: 500px; max-height: 500px;">
                </div>
                <p>Receipt already uploaded.</p>
            <?php else: ?>
                <p>Belum ada bukti transfer yang diupload.</p>
            <?php endif; ?>

            <!-- Form to upload or replace payment receipt -->
            <form action="payment?order_id=<?php echo $order_id; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                <div class="form-group row">
                    <label for="bukti_tf" class="col-sm-2 col-form-label">Upload Receipt:</label>
                    <div class="col-sm-10">
                        <input type="file" name="bukti_tf" id="bukti_tf" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" name="upload_bukti" class="btn btn-primary">Upload</button>
                        <a href="account.php?orders" class="btn btn-secondary ml-2">View Orders</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Payment Section End -->

<?php include('footer.php'); ?>

</body>
</html>

<?php
if (isset($_POST['upload_bukti'])) {
    $order_id = $_GET['order_id'];
    $bukti_tf = $_FILES['bukti_tf']['name'];
    $bukti_tf_tmp = $_FILES['bukti_tf']['tmp_name'];
    $target_dir = "img/buktitf/";

    // Check if the directory exists, if not, create it
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Check if there is an existing file and delete it
    $query = "SELECT bukti_tf FROM orders WHERE order_id = '$order_id'";
    $run_query = mysqli_query($con, $query);
    $order = mysqli_fetch_array($run_query);
    $old_bukti_tf = $order['bukti_tf'];

    if ($old_bukti_tf && file_exists($target_dir . $old_bukti_tf)) {
        unlink($target_dir . $old_bukti_tf);
    }

    // Move the uploaded file to the target directory
    $target_file = $target_dir . basename($bukti_tf);
    move_uploaded_file($bukti_tf_tmp, $target_file);

    // Update the database with the new file name
    $update_order = "UPDATE orders SET bukti_tf='$bukti_tf' WHERE order_id='$order_id'";
    $run_update = mysqli_query($con, $update_order);

    if ($run_update) {
        echo "<script>alert('Payment receipt uploaded successfully.');</script>";
        echo "<script>window.open('account.php?orders', '_self');</script>";
    } else {
        echo "<script>alert('There was an error uploading the payment receipt.');</script>";
    }
}
?>
