<?php
include('config.php');
include('../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = $_POST['password']; // Password yang diinput oleh pengguna

    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
        $hashed_password = $admin['password']; 

        // Verifikasi password menggunakan password_verify
        if (password_verify($password, $hashed_password)) {
            $_SESSION['admin_email'] = $username;
            header("Location: index.php");
            exit();
        } else {
            // Password tidak cocok
            $_SESSION['error_message'] = "Invalid credentials. Please try again.";
            header("Location: admin_login.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Invalid credentials. Please try again.";
        header("Location: admin_login.php");
        exit();
    }
} else {
    header("Location: admin_login.php");
    exit();
}
?>
