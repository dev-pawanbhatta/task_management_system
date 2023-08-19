<?php
session_start();
if (isset($_SESSION['email'])) {
    echo header('Location:dashboard.php');
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Register | Task Management System</title>

    <style>
    @media screen and (min-width:1000px) {
        .login-box {
            margin-top: 10%;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 mt-5">
                <img class="w-100" src="assets/images/login-image.png" alt="Login">
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 login-box">

                <h3 class="text-center fw-bold text-danger">Register</h3>
                <hr>
                <?php
                if (isset($_GET['error'])) {
                ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?= $_GET['error'] ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php
                }
                ?>
                <form action="backend/authentication/register.php" method="post" class="my-5">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Register</button>
                </form>
                <div class="text-center">
                    <span>Already Registered? </span><a href="index.php">Login</a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>