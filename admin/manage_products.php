<?php
include('../db.php');
include('admin_header.php');
include('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin_style.css">
    <!-- <style>
        
    </style> -->
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Manage Products
                <small>View All Products</small>
            </h1>
            <p class="bg-success">
                <?php
                if (isset($_SESSION['product_message'])) {
                    echo $_SESSION['product_message'];
                    unset($_SESSION['product_message']);
                }
                ?>
            </p>
            <div class="mb-3">
                <a href="insert_product.php" class="btn btn-success">Insert New Product</a>
            </div>

            <form class="form-inline mb-3" method="get">
                <div class="form-group mr-2">
                    <label for="search">Search: &ensp;</label>
                    <input type="text" class="form-control" id="search" name="search" placeholder="Enter product title">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            <form class="form-inline mb-3" method="get">
                <div class="form-group mr-2">
                    <label for="filter">Filter by Category: &ensp;</label>
                    <select class="form-control" id="filter" name="filter">
                        <option value="">Select Category</option>
                        <?php
                        $cat_query = "SELECT * FROM product_categories";
                        $cat_result = mysqli_query($con, $cat_query);
                        while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                            $p_cat_id = $cat_row['p_cat_id'];
                            $p_cat_title = $cat_row['p_cat_title'];
                            echo "<option value='$p_cat_id'>$p_cat_title</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Apply Filter</button>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image1</th>
                            <th>Image2</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Edit</th>
                            <th>Change Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM products";

                        if (isset($_GET['search'])) {
                            $search = $_GET['search'];
                            $query .= " WHERE product_title LIKE '%$search%'";
                        }

                        if (isset($_GET['filter']) && !empty($_GET['filter'])) {
                            $filter = $_GET['filter'];
                            if (strpos($query, 'WHERE') !== false) {
                                $query .= " AND p_cat_id = '$filter'";
                            } else {
                                $query .= " WHERE p_cat_id = '$filter'";
                            }
                        }

                        $result = mysqli_query($con, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $product_id = $row['products_id'];
                            $product_title = $row['product_title'];
                            $product_price = $row['product_price'];
                            $product_img1 = $row['product_img1'];
                            $product_img2 = $row['product_img2'];
                            $product_stats = $row['stats'];
                            $p_cat_id = $row['p_cat_id'];

                            // Ambil judul kategori
                            $cat_query = "SELECT p_cat_title FROM product_categories WHERE p_cat_id='$p_cat_id'";
                            $cat_result = mysqli_query($con, $cat_query);
                            $cat_row = mysqli_fetch_assoc($cat_result);
                            $category_title = $cat_row['p_cat_title'];

                            if($product_stats==1){
                                $stats = "Active";
                            }
                            else{
                                $stats = "Inactive";
                            }

                            echo "<tr>";
                            echo "<td>$product_id</td>";
                            echo "<td>$product_title</td>";
                            echo "<td><img src='../img/products/$product_img1' alt='Product Image'></td>";
                            echo "<td><img src='../img/products/$product_img2' alt='Product Image'></td>";
                            echo "<td>$product_price</td>";
                            echo "<td>$category_title</td>";
                            echo "<td>$stats</td>";
                            echo "<td><a href='edit_product.php?edit_product=$product_id' class='btn btn-warning'>Edit</a></td>";
                            echo "<td><a href='delete_product.php?delete_product=$product_id&product_stats=$product_stats' class='btn btn-danger'>Change</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include('admin_footer.php'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
