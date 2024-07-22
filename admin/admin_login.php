<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/admin_style.css" rel="stylesheet">
</head>

<body class="bg-light text-center">

    <div class="login-container">
        <form class="form-signin" action="admin_process_login" method="post">
            <img class="login-logo" src="../img/logo.png" alt="">
            <h1 class="h3 mb-3 font-weight-normal">Admin Login</h1>

            <?php if (isset($_GET['error']) && $_GET['error'] == 'true') : ?>
                <div class="alert alert-danger" role="alert">
                    Invalid credentials. Please try again.
                </div>
            <?php endif; ?>

            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
            <button class="btn btn-lg btn-primary btn-block mt-3" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2024</p>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
