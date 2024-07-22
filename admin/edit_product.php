<?php
include('../db.php');
include('admin_header.php');
include('config.php');
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Edit Product
            </h1>
        </div>
    </div>

    <?php
    if (isset($_GET['edit_product'])) {
        $edit_id = $_GET['edit_product'];

        $get_product = "SELECT * FROM products WHERE products_id=?";
        $stmt = $con->prepare($get_product);
        $stmt->bind_param('i', $edit_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row_product = $result->fetch_assoc();

        $product_id = $row_product['products_id'];
        $product_title = $row_product['product_title'];
        $product_img1 = $row_product['product_img1'];
        $product_img2 = $row_product['product_img2'];
        $product_price = $row_product['product_price'];
        $product_keywords = $row_product['product_keywords'];
        $product_desc = $row_product['product_desc'];
        $p_cat_id = $row_product['p_cat_id'];
        $cat_id = $row_product['cat_id'];

        $get_p_cat = "SELECT * FROM product_categories WHERE p_cat_id=?";
        $stmt = $con->prepare($get_p_cat);
        $stmt->bind_param('i', $p_cat_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row_p_cat = $result->fetch_assoc();
        $p_cat_title = $row_p_cat['p_cat_title'];

        $get_cat = "SELECT * FROM category WHERE cat_id=?";
        $stmt = $con->prepare($get_cat);
        $stmt->bind_param('i', $cat_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row_cat = $result->fetch_assoc();
        $cat_title = $row_cat['cat_title'];
    }
    ?>

    <div class="row">
        <div class="col-md-12">
            <form method="post" enctype="multipart/form-data" action="">
                <div class="form-group">
                    <label for="product_title">Product Title</label>
                    <input type="text" class="form-control" id="product_title" name="product_title" value="<?php echo htmlspecialchars($product_title); ?>" required>
                </div>

                <div class="form-group">
                    <label for="p_cat_id">Product Category</label>
                    <select class="form-control" id="p_cat_id" name="p_cat_id">
                        <?php
                        $get_p_cats = "SELECT * FROM product_categories";
                        $result = $con->query($get_p_cats);
                        while ($row_p_cats = $result->fetch_assoc()) {
                            $prod_cat_id = $row_p_cats['p_cat_id'];
                            $prod_cat_title = $row_p_cats['p_cat_title'];

                            echo "<option value='$prod_cat_id' ";
                            if ($prod_cat_id == $p_cat_id) {
                                echo "selected='selected'";
                            }
                            echo ">$prod_cat_title</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="cat_id">Category</label>
                    <select class="form-control" id="cat_id" name="cat_id">
                        <?php
                        $get_cats = "SELECT * FROM category";
                        $result = $con->query($get_cats);
                        while ($row_cats = $result->fetch_assoc()) {
                            $category_id = $row_cats['cat_id'];
                            $category_title = $row_cats['cat_title'];

                            echo "<option value='$category_id' ";
                            if ($category_id == $cat_id) {
                                echo "selected='selected'";
                            }
                            echo ">$category_title</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="product_img1">Product Image 1</label>
                    <input type="file" class="form-control" id="product_img1" name="product_img1">
                    <img src="../img/products/<?php echo htmlspecialchars($product_img1); ?>" width="100" height="100">
                </div>

                <div class="form-group">
                    <label for="product_img2">Product Image 2</label>
                    <input type="file" class="form-control" id="product_img2" name="product_img2">
                    <img src="../img/products/<?php echo htmlspecialchars($product_img2); ?>" width="100" height="100">
                </div>

                <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="text" class="form-control" id="product_price" name="product_price" value="<?php echo htmlspecialchars($product_price); ?>" required>
                </div>

                <div class="form-group">
                    <label for="product_keywords">Product Keywords</label>
                    <input type="text" class="form-control" id="product_keywords" name="product_keywords" value="<?php echo htmlspecialchars($product_keywords); ?>" required>
                </div>

                <div class="form-group">
                    <label for="product_desc">Product Description</label>
                    <textarea class="form-control" id="product_desc" name="product_desc" rows="6"><?php echo htmlspecialchars($product_desc); ?></textarea>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="update_product" value="Update Product">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['update_product'])) {
    $product_title = $_POST['product_title'];
    $p_cat_id = $_POST['p_cat_id'];
    $cat_id = $_POST['cat_id'];
    $product_price = $_POST['product_price'];
    $product_keywords = $_POST['product_keywords'];
    $product_desc = $_POST['product_desc'];

    // Check if new image is uploaded
    if ($_FILES['product_img1']['name'] != "") {
        $product_img1 = $_FILES['product_img1']['name'];
        $temp_name1 = $_FILES['product_img1']['tmp_name'];
        move_uploaded_file($temp_name1, "../img/products/$product_img1");
    } else {
        $product_img1 = $product_img1; // Use existing image if no new image uploaded
    }

    if ($_FILES['product_img2']['name'] != "") {
        $product_img2 = $_FILES['product_img2']['name'];
        $temp_name2 = $_FILES['product_img2']['tmp_name'];
        move_uploaded_file($temp_name2, "../img/products/$product_img2");
    } else {
        $product_img2 = $product_img2; 
    }

    $update_product = "UPDATE products SET 
        p_cat_id=?, 
        cat_id=?, 
        product_title=?, 
        product_img1=?, 
        product_img2=?, 
        product_price=?, 
        product_keywords=?, 
        product_desc=? 
        WHERE products_id=?";

    $stmt = $con->prepare($update_product);
    $stmt->bind_param('iisssissi', $p_cat_id, $cat_id, $product_title, $product_img1, $product_img2, $product_price, $product_keywords, $product_desc, $product_id);
    $run_update_product = $stmt->execute();

    if ($run_update_product) {
        echo "<script>alert('Product updated successfully')</script>";
        echo "<script>window.open('manage_products.php','_self')</script>";
    } else {
        echo "<script>alert('Product update failed: " . htmlspecialchars($stmt->error) . "')</script>";
    }
}
?>

<?php include('admin_footer.php'); ?>
