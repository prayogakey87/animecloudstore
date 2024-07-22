<?php
$active = "Login";
include("db.php");
include("functions.php");
include("header.php");
// Verifikasi sesi login
?>

<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="index.php"><i class="fa fa-home"></i> Home</a>
                    <span>Login</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Form Section Begin -->

<!-- Register Section Begin -->
<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="login-form">
                    <h2>Login</h2>
                    <form action="login" method="post">
                        <div class="group-input">
                            <label for="username">Email *</label>
                            <input type="text" id="username" name="cemail" required>
                            <div id="email_error"></div>
                        </div>
                        <div class="group-input">
                            <label for="pass">Password *</label>
                            <input type="password" id="pass" name="password" required>
                            <div id="password_error"></div>
                        </div>

                        <button name="logins" class="site-btn login-btn">Sign In</button>
                    </form>
                    <div class="switch-login">
                        <a href="register.php" class="or-login">Or Create An Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form Section End -->

<?php
include('footer.php');
?>

</body>

</html>

<?php

if (isset($_POST['logins'])) {
    $log_email = mysqli_real_escape_string($con, $_POST['cemail']);
    $log_pass = mysqli_real_escape_string($con, $_POST['password']);

    // Query untuk mengambil data customer berdasarkan email
    $sel_customer = "SELECT * FROM customer WHERE customer_email = '$log_email'";
    $run_sel_c = mysqli_query($con, $sel_customer);

    if (mysqli_num_rows($run_sel_c) > 0) {
        $customer_data = mysqli_fetch_assoc($run_sel_c);
        $hashed_password = $customer_data['customer_pass'];

        // Memeriksa apakah password cocok menggunakan password_verify
        if (password_verify($log_pass, $hashed_password)) {
            $c_id = $log_email;

            // Jika login berhasil
            $_SESSION['customer_email'] = $log_email;

            // Redirect sesuai kondisi (contoh: ke index.php jika tidak ada cart)
            if (check_cart_condition($con, $c_id)) {
                echo "<script>window.open('check-out.php','_self')</script>";
            } else {
                echo "<script>window.open('index.php?stat=1','_self')</script>";
            }
        } else {
            // Jika password tidak cocok
            echo "<script>
                    bootbox.alert({
                        message: 'Invalid Username or Password',
                        backdrop: true
                    });
                </script>";
        }
    } else {
        // Jika email tidak ditemukan
        echo "<script>
                bootbox.alert({
                    message: 'Invalid Username or Password',
                    backdrop: true
                });
            </script>";
    }
}

function check_cart_condition($con, $c_id) {
    // Query untuk memeriksa cart
    $select_cart = "SELECT * FROM cart WHERE c_id = '$c_id'";
    $run_sel_cart = mysqli_query($con, $select_cart);
    $check_cart = mysqli_num_rows($run_sel_cart);

    return $check_cart > 0;
}
?>

