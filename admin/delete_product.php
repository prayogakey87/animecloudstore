<?php
include('../db.php');
//include('admin_header.php');

if (isset($_GET['delete_product'])) {
    $del_id = $_GET['delete_product'];
    $get_stat = $_GET['product_stats'];
    if($get_stat==1){
    $update_product = "UPDATE products SET stats = 0 WHERE products_id = '$del_id'";
    $run_update = mysqli_query($con, $update_product);
    if ($run_update) {
        echo "<script>alert('Produk berhasil dinonaktifkan')</script>";
        echo "<script>window.open('manage_products.php','_self')</script>";
    } else {
        echo "<script>alert('Gagal menonaktifkan produk');</script>";
    }
}
if($get_stat==0){
    $update_product = "UPDATE products SET stats = 1 WHERE products_id = '$del_id'";
    $run_update = mysqli_query($con, $update_product);
    if ($run_update) {
        echo "<script>alert('Produk berhasil diaktifkan')</script>";
        echo "<script>window.open('manage_products.php','_self')</script>";
    } else {
        echo "<script>alert('Gagal aktifkan produk');</script>";
    }
}


    
}

include('admin_footer.php');
?>
