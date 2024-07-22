<?php
include('../db.php');
//include('admin_header.php');
include('config.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

    <div class="row">
        <div class="col-lg-12">
            <div class="top">
                <i class="fa fa-plus fa-fw">
                </i> Insert Product
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-money fa-fw"></i> Insert Products
                    </h3>
                </div>

                <div class="panel-body">
                    <form method="post" class="form-horizontal" enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="col-md-3 control-label">Product Title/Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="product_title" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Product Category</label>

                            <div class="col-md-6">
                                <select class="form-control" name="p_cat_id">

                                    <option>Select a Product Category</option>

                                    <?php

                                    $get_p_category = "select * from product_categories";
                                    $run_p_category = mysqli_query($con, $get_p_category);

                                    while ($p_cat_row = mysqli_fetch_array($run_p_category)) {

                                        $p_cat_id = $p_cat_row['p_cat_id'];
                                        $p_cat_title = $p_cat_row['p_cat_title'];

                                        echo "
                                        
                                        <option value='$p_cat_id'>$p_cat_title</option>  
                                        
                                    
                                        ";
                                    }

                                    ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Category</label>

                            <div class="col-md-6">
                                <select class="form-control" name="cat_id">

                                    <option>Select a Category</option>

                                    <?php

                                    $get_category = "select * from category";
                                    $run_category = mysqli_query($con, $get_category);

                                    while ($cat_row = mysqli_fetch_array($run_category)) {

                                        $cat_id = $cat_row['cat_id'];
                                        $cat_title = $cat_row['cat_title'];

                                        echo "
                                        
                                        <option value='$cat_id'>$cat_title</option>  
                                        
                                    
                                        ";
                                    }

                                    ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Product Image # 1</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" name="product_img1" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Product Image # 2</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" name="product_img2" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Product Price</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="product_price" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Product Keywords</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="product_keywords" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Product Description</label>

                            <div class="col-md-6">
                                <textarea class="form-control" name="product_desc" cols="19" rows="6"></textarea>
                            </div>
                        </div>

                        <div class="form-group" style="display: flex;justify-content:center">
                            <div class="col-md-3">
                                <input name="submit" type="submit" class="btn btn-primary form-control" value="Insert Product">
                            </div>
                        </div>
                        <div class="form-group" style="display: flex;justify-content:center">
                        <div class="col-md-3">
                            <a href="manage_products.php" class="btn btn-default form-control">Back</a>
                        </div></div>

                    </form>


                </div>
            </div>
        </div>
    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea'
        });
    </script>

</body>

</html>


<?php
if (isset($_POST['submit'])) {
    $p_cat_id = $_POST['p_cat_id'];
    $cat_id = $_POST['cat_id'];
    $product_title = $_POST['product_title'];
    $product_img1 = $_FILES['product_img1']['name'];
    $product_img2 = $_FILES['product_img2']['name'];
    $product_price = $_POST['product_price'];
    $product_keywords = !empty($_POST['product_keywords']) ? $_POST['product_keywords'] : '';
    $product_desc = $_POST['product_desc'];

    $temp_name1 = $_FILES['product_img1']['tmp_name'];
    $temp_name2 = $_FILES['product_img2']['tmp_name'];

    $target_dir = realpath(__DIR__ . '/../img/products') . '/';
    $target_file1 = $target_dir . basename($product_img1);
    $target_file2 = $target_dir . basename($product_img2);

    // Debugging statements
    echo "Target Directory: $target_dir <br>";
    echo "Target File 1: $target_file1 <br>";
    echo "Target File 2: $target_file2 <br>";
    echo "Temp Name 1: $temp_name1 <br>";
    echo "Temp Name 2: $temp_name2 <br>";

    if (is_uploaded_file($temp_name1) && is_uploaded_file($temp_name2)) {
        if (move_uploaded_file($temp_name1, $target_file1) && move_uploaded_file($temp_name2, $target_file2)) {
            $stmt = $con->prepare("INSERT INTO products (p_cat_id, cat_id, date, product_title, product_img1, product_img2, product_price, product_keywords, product_desc, stats) VALUES (?, ?, NOW(), ?, ?, ?, ?, ?, ?, 1)");
            
            if ($stmt) {
                $stmt->bind_param("iisssiss", $p_cat_id, $cat_id, $product_title, $product_img1, $product_img2, $product_price, $product_keywords, $product_desc);
                if ($stmt->execute()) {
                    echo "<script>alert('Product Inserted')</script>";
                    echo "<script>window.open('insert_product.php','_self')</script>";
                } else {
                    echo "<script>alert('Error: Could not insert product - " . $stmt->error . "')</script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('Error: Could not prepare statement - " . $con->error . "')</script>";
            }
        } else {
            echo "<script>alert('Error: Could not move uploaded images')</script>";
            // Additional debugging information
            if (!move_uploaded_file($temp_name1, $target_file1)) {
                echo "Error moving file 1: " . error_get_last()['message'] . "<br>";
            }
            if (!move_uploaded_file($temp_name2, $target_file2)) {
                echo "Error moving file 2: " . error_get_last()['message'] . "<br>";
            }
        }
    } else {
        echo "<script>alert('Error: No files uploaded or file upload error')</script>";
    }
}
?>