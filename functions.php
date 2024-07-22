<?php

$db = mysqli_connect('localhost', 'root', '', 'threaderz_store');


function getRealIpUser()
{

    switch (true) {

        case (!empty($_SERVER['HTTP_X_REAL_IP'])):
            return $_SERVER['HTTP_X_REAL_IP'];
        case (!empty($_SERVER['HTTP_CLIENT_IP'])):
            return $_SERVER['HTTP_CLIENT_IP'];
        case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
            return $_SERVER['HTTP_X_FORWARDED_FOR'];

        default:
            return $_SERVER['REMOTE_ADDR'];
    }
}


function addCart() {
    global $db;

    if (isset($_GET['add_cart'])) {
        // Pastikan session sudah dimulai
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $ip_add = getRealIpUser();

        if (isset($_SESSION['customer_email'])) {
            $c_id = mysqli_real_escape_string($db, $_SESSION['customer_email']);
        } else {
            // Redirect ke halaman login jika customer belum login
            echo "<script>alert('Please log in first.')</script>";
            echo "<script>window.open('login.php', '_self')</script>";
            return;
        }

        $p_id = mysqli_real_escape_string($db, $_GET['add_cart']);
        $qty = isset($_POST['product_qty']) ? mysqli_real_escape_string($db, $_POST['product_qty']) : 1;
        $size = isset($_POST['size']) ? mysqli_real_escape_string($db, $_POST['size']) : '';

        // Cek apakah produk sudah ada di keranjang
        $check_product = "SELECT * FROM cart WHERE c_id = '$c_id' AND products_id = '$p_id' AND size = '$size'";
        $run_check = mysqli_query($db, $check_product);

        if (mysqli_num_rows($run_check) > 0) {
            echo "<script>alert('Product already added.')</script>";
            echo "<script>window.open('product.php?product_id=$p_id', '_self')</script>";
        } else {
            $query = "INSERT INTO cart (products_id, ip_add, qty, size, date, c_id) VALUES ('$p_id', '$ip_add', '$qty', '$size', NOW(), '$c_id')";
            $run_query = mysqli_query($db, $query);

            if ($run_query) {
                echo "<script>alert('Product added to Cart. Keep Shopping.')</script>";
                echo "<script>window.open('product.php?product_id=$p_id', '_self')</script>";
            } else {
                // Tampilkan pesan error jika query gagal
                //$error = mysqli_error($db);
                echo "<script>alert('Failed to add product to cart. Please try again.')</script>";
                echo "<script>window.open('product.php?product_id=$p_id', '_self')</script>";
            }
        }
    }
}






// Retrieve Women Products for index slider

function getWProduct()
{
    global $db;

    $get_products = "select * from products where cat_id=2 AND stats=1 order by RAND() LIMIT 7";
    $run_products = mysqli_query($db, $get_products);



    while ($row_products = mysqli_fetch_array($run_products)) {

        $products_id = $row_products['products_id'];
        $product_title = $row_products['product_title'];
        $product_price = $row_products['product_price'];
        $product_img1 = $row_products['product_img1'];
        $price = number_format($product_price,0);




        echo "
        
        <div class='product-item'>
        <div class='pi-pic' style='max-height:300px'>
            <img src='img/products/$product_img1' alt='$product_title'>
            <ul>
                <li class='quick-view'><a href='product.php?product_id=$products_id' style='background:#fe4231;color:white'>View Details</a></li>
            </ul>
        </div>
        <div class='pi-text'>
            <a href='product.php?product_id=$products_id'>
                <h5>$product_title</h5>
            </a>
            <div class='product-price'>
               IDR $price
            </div>
        </div>
    </div>

    ";
    }
}

// Retrieve men Products for index slider

function getMProduct()
{
    global $db;

    $get_products = "select * from products where cat_id=1 AND stats=1 order by RAND() LIMIT 7";
    $run_products = mysqli_query($db, $get_products);



    while ($row_products = mysqli_fetch_array($run_products)) {

        $products_id = $row_products['products_id'];
        $product_title = $row_products['product_title'];
        $product_price = $row_products['product_price'];
        $product_img1 = $row_products['product_img1'];
        $price = number_format($product_price,0);

        echo "
        
        <div class='product-item'>
        <div class='pi-pic' style='max-height:300px'>
            <img src='img/products/$product_img1' alt='$product_title'>
            <ul>
                <li class='quick-view'><a href='product.php?product_id=$products_id' style='background:#fe4231;color:white'>View Details</a></li>
            </ul>
        </div>
        <div class='pi-text'>
            <a href='#'>
                <h5>$product_title</h5>
            </a>
            <div class='product-price'>
            IDR $price
            </div>
        </div>
    </div>

    ";
    }
}


// Retrieve Products Catergories

function getProdCat()
{

    global $db;

    $get_p_cats = "select * from product_categories";
    $run_p_cats = mysqli_query($db, $get_p_cats);



    while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {

        $p_cat_id = $row_p_cats['p_cat_id'];
        $p_cat_title = $row_p_cats['p_cat_title'];


        echo "


        <li><a href='shop.php?p_cat_id=$p_cat_id'>$p_cat_title</a></li>

        ";
    }
}

// Retrieve Catergories

function getCat()
{

    global $db;

    $get_cats = "select * from category";
    $run_cats = mysqli_query($db, $get_cats);



    while ($row_cats = mysqli_fetch_array($run_cats)) {

        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];


        echo "

        <li class='hovclass'><a href='shop.php?cat_id=$cat_id'>$cat_title</a></li>

        ";
    }
}

function getPcatProd()
{
    global $db;

    if (isset($_GET['p_cat_id'])) {

        $p_cat_id = $_GET['p_cat_id'];

        $get_p_cat = "select * from product_categories where p_cat_id='$p_cat_id'";
        $run_p_cat = mysqli_query($db, $get_p_cat);

        $row_p_cat = mysqli_fetch_array($run_p_cat);

        $p_cat_title = $row_p_cat['p_cat_title'];
        $p_cat_desc = $row_p_cat['p_cat_desc'];

        $get_products = "select * from products where p_cat_id='$p_cat_id' AND stats=1";
        $run_products = mysqli_query($db, $get_products);

        $count = mysqli_num_rows($run_products);
        
        if ($count == 0) {

            echo "
                <div class='card' style='font-weight:bold; color:#fe4231'>
                    <div class='card-body'>No Products Available</div>
                </div>

                    ";
        } else {



            while ($row_products = mysqli_fetch_array($run_products)) {

                $products_id = $row_products['products_id'];
                $product_title = $row_products['product_title'];
                $product_price = $row_products['product_price'];
                $product_img1 = $row_products['product_img1'];

                $price = number_format($product_price,0);

                echo "
        
                <div class='col-lg-4 col-sm-6'>
                <div class='product-item'>
                    <div class='pi-pic' style='max-height:350px'>
                        <img src='img/products/$product_img1' alt='$product_title'>
                        <ul>
                            <li class='quick-view'><a href='product.php?product_id=$products_id' style='background:#fe4231;color:white'>View Details</a></li>
                        </ul>
                    </div>
                    <div class='pi-text'>
                        <div class='catagory-name'></div>
                        <a href='product.php?product_id=$products_id'>
                            <h5>$product_title</h5>
                        </a>
                        <div class='product-price'>
                        IDR $price                    
                        </div>
                    </div>
                </div>
            </div>

    ";
            }
        }
    }
}


function getcatProd()
{
    global $db;

    if (isset($_GET['cat_id'])) {

        $cat_id = $_GET['cat_id'];

        $get_cat = "select * from category where cat_id='$cat_id'";
        $run_cat = mysqli_query($db, $get_cat);

        $row_cat = mysqli_fetch_array($run_cat);

        $p_cat_title = $row_cat['cat_title'];
        $p_cat_desc = $row_cat['cat_desc'];

        $get_products = "select * from products where cat_id='$cat_id' AND stats=1";
        $run_products = mysqli_query($db, $get_products);

        $count = mysqli_num_rows($run_products);





        if ($count == 0) {

            echo "
                <div class='card' style='font-weight:bold; color:#fe4231'>
                    <div class='card-body'>No Products Available</div>
                </div>

                    ";
        } else {



            while ($row_products = mysqli_fetch_array($run_products)) {

                $products_id = $row_products['products_id'];
                $product_title = $row_products['product_title'];
                $product_price = $row_products['product_price'];
                $product_img1 = $row_products['product_img1'];

                $price = number_format($product_price,0);

                echo "
        
                <div class='col-lg-4 col-sm-6'>
                <div class='product-item'>
                    <div class='pi-pic' style='max-height:350px'>
                        <img src='img/products/$product_img1' alt='$product_title'>
                        <ul>
                            <li class='quick-view'><a href='product.php?product_id=$products_id' style='background:#fe4231;color:white'>View Details</a></li>
                        </ul>
                    </div>
                    <div class='pi-text'>
                        <div class='catagory-name'></div>
                        <a href='product.php?product_id=$products_id'>
                            <h5>$product_title</h5>
                        </a>
                        <div class='product-price'>
                        IDR $price                    
                        </div>
                    </div>
                </div>
            </div>

    ";
            }
        }
    }
}

function getProd()
{
    global $db;

    if (isset($_GET['product_id'])) {

        $product_id = $_GET['product_id'];

        $get_product_id = "select * from products where products_id='$product_id' AND stats=1";
        $run_product_id = mysqli_query($db, $get_product_id);

        $row_products = mysqli_fetch_array($run_product_id);

        $product_title = $row_products['product_title'];
        $product_price = $row_products['product_price'];
        $product_desc = $row_products['product_desc'];
        $product_img1 = $row_products['product_img1'];
        $product_img2 = $row_products['product_img2'];


        $get_p_cat_name = "select p_cat_title from products as P,product_categories as C where P.p_cat_id=C.p_cat_id and products_id=$product_id";
        $run_get_p_cat_name = mysqli_query($db, $get_p_cat_name);


        $row_p_cat_name = mysqli_fetch_array($run_get_p_cat_name);


        $p_cat_name = $row_p_cat_name['p_cat_title'];
        
        $price = number_format($product_price,0);


        echo "
        
    <div class='col-lg-6' style='margin:0 auto'>
        <div class='product-pic-zoom  col-md-8' style='max-height:400px;margin: 0 0 30px 0'>
            <img class='product-big-img' src='img/products/$product_img1' alt='$product_title'>
            <div class='zoom-icon'>
                <i class='fa fa-search-plus'></i>
            </div>
        </div>
        <div class='product-thumbs'>
            <div class='product-thumbs-track ps-slider owl-carousel'>
                <div class='pt active' data-imgbigurl='img/products/$product_img1'><img src='img/products/$product_img1' alt='$product_title'></div>
                <div class='pt' data-imgbigurl='img/products/$product_img2'><img src='img/products/$product_img2' alt='$product_title'></div>
              </div>
        </div>
    </div>
    <div class='col-lg-6'>
        <div class='product-details'>
            <div class='pd-title'>
                <h3>$product_title</h3>
            </div>
           
            <div class='pd-desc'>
                <p>$product_desc</p>
                <h4>IDR $price</h4>
            </div>

            <ul class='pd-tags'>
                <li><span>CATEGORY</span>: $p_cat_name</li>
            </ul>
        
        ";
    }
}


function relatedProducts()
{
    global $db;

    if (isset($_GET['product_id'])) {

        $product_id = $_GET['product_id'];


        $get_p_cat_id = "select C.p_cat_id,C.p_cat_title from products as P,product_categories as C where P.p_cat_id=C.p_cat_id and products_id=$product_id";
        $run_get_p_cat_id = mysqli_query($db, $get_p_cat_id);

        $row_p_cat_id = mysqli_fetch_array($run_get_p_cat_id);

        $pcat_id = $row_p_cat_id['p_cat_id'];

        $get_r_products = "select * from products where p_cat_id=$pcat_id AND stats=1 LIMIT 1,4";
        $run_get_r_products = mysqli_query($db, $get_r_products);


        while ($row_get_r_products = mysqli_fetch_array($run_get_r_products)) {



            $p_id = $row_get_r_products['products_id'];
            $p_name = $row_get_r_products['product_title'];
            $p_img1 = $row_get_r_products['product_img1'];
            $p_price = $row_get_r_products['product_price'];


            if ($p_id != $product_id) {
                echo "


        <div class='col-lg-3 col-sm-6'>
            <div class='product-item' >
                <div class='pi-pic' style='max-height:300px'>
                    <img src='img/products/$p_img1' alt='$p_name'>
                    <ul>
                        <li class='quick-view'><a href='product.php?product_id=$p_id' style='background:#fe4231;color:white'>View Details</a></li>
                    </ul>
                </div>
                <div class='pi-text'>
                    <a href='#'>
                        <h5>$p_name</h5>
                    </a>
                    <div class='product-price'>
                        IDR $p_price
                    </div>
                </div>
            </div>
        </div>
        
        ";
            }
        }
    }
}


function items()
{

    global $db;

    $ip_add = getRealIpUser();
    $c_id = $_SESSION['customer_email'];

    $get_items = "select * from cart where c_id = '$c_id'";
    $run_items = mysqli_query($db, $get_items);

    $count_items = mysqli_num_rows($run_items);

    echo $count_items;
}


function total_price() {
    global $db;

    $c_id = $_SESSION['customer_email'];
    $ppn_rate = 0.11;
    $subtotal = 0;

    $get_items = "SELECT * FROM cart WHERE c_id = '$c_id'";
    $run_items = mysqli_query($db, $get_items);

    while ($row_items = mysqli_fetch_array($run_items)) {
        $p_id = $row_items['products_id'];
        $pro_qty = $row_items['qty'];

        $get_price = "SELECT * FROM products WHERE products_id = '$p_id'";
        $run_price = mysqli_query($db, $get_price);

        while ($row_price = mysqli_fetch_array($run_price)) {
            $product_price = $row_price['product_price'];
            $sub_price = $product_price * $pro_qty;
            $subtotal += $sub_price;
        }
    }

    $ppn = $subtotal * $ppn_rate;
    $total = $subtotal + $ppn;

    return [$subtotal, $total, $ppn];
}

function total_order() {
    global $db;

    $c_id = $_SESSION['customer_email'];
    $orderID = $_GET['order_id'];
    $ppn_rate = 0.11;
    $subtotal = 0;

    $get_items = "SELECT * FROM placed_order WHERE c_id = '$c_id' AND order_id = '$orderID'";
    $run_items = mysqli_query($db, $get_items);

    while ($row_items = mysqli_fetch_array($run_items)) {
        //$p_id = $row_items['products_id'];
        $pro_qty = $row_items['qty'];
        $product_price = $row_items['product_price'];
        $sub_price = $product_price * $pro_qty;
        $subtotal += $sub_price;
        //$get_price = "SELECT * FROM products WHERE products_id = '$p_id'";
       // $run_price = mysqli_query($db, $get_price);

        // while ($row_price = mysqli_fetch_array($run_price)) {
            
            
        // }
    }

    $ppn = $subtotal * $ppn_rate;
    $total = $subtotal + $ppn;

    return [$subtotal, $total, $ppn];
}


function calculate_ppn() {
    list($subtotal, $total, $ppn) = total_price();
    return number_format($ppn, 0);
}



$countrows = 0;

function cart_items() {
    global $db;
    $c_id = $_SESSION['customer_email'];
    $get_items = "SELECT * FROM cart WHERE c_id = '$c_id' ORDER BY date DESC";
    $run_items = mysqli_query($db, $get_items);
    $countrows = mysqli_num_rows($run_items);

    if ($countrows == 0) {
        echo "<div class='card col-md-3 col-10' style='margin:0 auto; border-radius:25px 5px;box-shadow: inset -12px -8px 40px #e5e5e5;'>
            <div class='card-body'>
               <h5 style='text-align:center;font-weight:500'> No items in Cart </h5>
            </div>
        </div>";
    } else {
        echo "<thead style='font-size: larger;'>
                <tr>
                    <th>Image</th>
                    <th class='p-name'>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>";

        while ($row_items = mysqli_fetch_array($run_items)) {
            $p_id = $row_items['products_id'];
            $pro_qty = $row_items['qty'];
            $size = $row_items['size']; // Mengambil ukuran langsung dari tabel cart

            $get_item = "SELECT * FROM products WHERE products_id = '$p_id'";
            $run_item = mysqli_query($db, $get_item);
            $row_item = mysqli_fetch_array($run_item);

            $pro_id = $row_item['products_id'];
            $pro_name = $row_item['product_title'];
            $pro_price = $row_item['product_price'];
            $pro_img1 = $row_item['product_img1'];
            $pro_total_p = $pro_price * $pro_qty;
            $price = number_format($pro_price, 0);
            $price2 = number_format($pro_total_p, 0);

            echo "<tr style='border-bottom: 0.5px solid #ebebeb'>
                <td class='cart-pic first-row'><img src='img/products/$pro_img1' alt='$pro_name' style='max-height:100px'></td>
                <td class='cart-title first-row'>
                    <h5><a href='product.php?product_id=$pro_id' style='color:black;font-weight:bold'>$pro_name</a></h5>
                    <span>Size: $size</span>
                    <input type='hidden' name='size[$p_id]' value='$size'>
                </td>
                <td class='p-price first-row'>IDR $price</td>
                <td class='qua-col first-row'>
                    <div class='quantity'>
                        <div class='pro-qty'>
                            <input name='qty[$p_id]' type='text' value='$pro_qty' maxlength='2'>
                        </div>
                    </div>
                </td>
                <td class='total-price first-row'>IDR $price2</td>
                <td class='close-td first-row'>
                    <a href='shopping-cart.php?del=$p_id&size=$size'><i class='ti-close' style='color:black'></i></a>
                </td>
            </tr>";
        }

        echo "</tbody>";
    }
}


function cart_icon_prod()
{

    global $db;

    $c_id = $_SESSION['customer_email'];
    $ip_add = getRealIpUser();


    $get_items = "select * from cart where c_id = '$c_id' ORDER BY date DESC LIMIT 0,2";
    $run_items = mysqli_query($db, $get_items);



    if (mysqli_num_rows($run_items) == 0) {
        echo  " 

        
        <p style='text-align:center; font-weight:500;color:#fe4231'>Cart Empty </p>
    
           
        ";
    } else {

        while ($row_items = mysqli_fetch_array($run_items)) {
            $p_id = $row_items['products_id'];
            $pro_qty = $row_items['qty'];

            $get_item = "select * from products where products_id = '$p_id' ORDER BY date DESC";
            $run_item = mysqli_query($db, $get_item);

            while ($row_item = mysqli_fetch_array($run_item)) {

                $pro_name = $row_item['product_title'];
                $pro_price = $row_item['product_price'];
                $pro_img1 = $row_item['product_img1'];

                $pro_total_p = $pro_price * $pro_qty;
                $price = number_format($pro_price,0);
            }

            echo "
        <tr>
        <td class='si-pic'><img src='img/products/$pro_img1' alt='$pro_name' style='max-height:70px'></td>
        <td class='si-text'>
            <div class='product-selected'>
                <p>IDR $price x $pro_qty</p>
                <h6>$pro_name</h6>
            </div>
        </td>
        <td class='si-close'>
        <a href='shopping-cart.php?delcart=$p_id'> <i class='ti-close' style='color:black'></i></a>
        </td>
    </tr>
    ";
        }
    }
}


function checkoutProds() {
    global $db;

    $c_id = $_SESSION['customer_email'];

    $get_items = "SELECT * FROM cart WHERE c_id = '$c_id' ORDER BY date DESC";
    $run_items = mysqli_query($db, $get_items);

    if (mysqli_num_rows($run_items) == 0) {
        echo  "<li class='fw-normal' style='text-align:center;font-weight:bold;font-size:larger;color:#fe4231'>No Items in Cart</li>";
    } else {
        while ($row_items = mysqli_fetch_array($run_items)) {
            $p_id = $row_items['products_id'];
            $pro_qty = $row_items['qty'];

            $get_item = "SELECT * FROM products WHERE products_id = '$p_id' ORDER BY date DESC";
            $run_item = mysqli_query($db, $get_item);

            while ($row_item = mysqli_fetch_array($run_item)) {
                $pro_name = $row_item['product_title'];
                $pro_price = $row_item['product_price'];

                $pro_total_p = $pro_price * $pro_qty;

                // Format harga dan total harga dengan number_format() dengan desimal 0
                $pro_price_formatted = number_format($pro_price, 0);
                $pro_total_p_formatted = number_format($pro_total_p, 0);
                
                echo "
                    <li class='fw-normal'>$pro_name x $pro_qty <span>IDR $pro_total_p_formatted</span></li>
                ";
            }
        }
    }
}

//detailOrder($orderid);

function detailOrder($orderid) {
    global $db;

    if (isset($_SESSION['customer_email'])) {
        $c_id = $_SESSION['customer_email'];

        // Mendapatkan customer_id berdasarkan email
        // $query = "SELECT customer_id FROM customer WHERE customer_email = '$c_id'";
        // $run_query = mysqli_query($db, $query);
        // $get_query = mysqli_fetch_array($run_query);
        // $customer_id = $get_query['customer_id'];

        // Mendapatkan data pesanan berdasarkan customer_id dan order_id
        $get_items = "SELECT * FROM placed_order WHERE c_id = '$c_id' AND order_id = '$orderid' ORDER BY date DESC";
        $run_items = mysqli_query($db, $get_items);

        if (mysqli_num_rows($run_items) == 0) {
            echo "<li class='fw-normal' style='text-align:center;font-weight:bold;font-size:larger;color:#fe4231'>No Items in Order</li>";
        } else {
            while ($row_items = mysqli_fetch_array($run_items)) {
                $p_id = $row_items['products_id'];
                $pro_qty = $row_items['qty'];

                // Mendapatkan data produk berdasarkan products_id
                $get_item = "SELECT * FROM products WHERE products_id = '$p_id'";
                $run_item = mysqli_query($db, $get_item);

                while ($row_item = mysqli_fetch_array($run_item)) {
                    $pro_name = $row_item['product_title'];
                    $pro_price = $row_item['product_price'];

                    $pro_total_p = $pro_price * $pro_qty;

                    $pro_price_formatted = number_format($pro_price, 0);
                    $pro_total_p_formatted = number_format($pro_total_p, 0);
                    
                    echo "
                        <li class='fw-normal'>$pro_name x $pro_qty <span>IDR $pro_total_p_formatted</span></li>
                    ";
                }
            }
        }
    } else {
        echo "<li class='fw-normal' style='text-align:center;font-weight:bold;font-size:larger;color:#fe4231'>Please log in to view your orders.</li>";
    }
}
?>
