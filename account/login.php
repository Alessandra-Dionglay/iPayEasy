<?php
session_start();

if (isset($_SESSION["customer_login"])) {
    header("Location: /shop.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPayEasy | Login</title>
    <?php include ('../assets.php'); ?>
</head>

<body>

    <?php
    $active = 'customers';
    include ('../header.php');
    include ('../php/config.php');
    ?>

    <br>
    <br>
    <br>

    <div class="d-flex justify-content-center">
        <div class="flex-fill"></div>
        <div class="flex-fill" style="display: flex;
                    justify-items: center;
                    align-items: center;
                    height: calc(100vh - 500px); ">
            <div style="width: 100%;">
                <h2 style="padding: 10px 0; text-align: center;">Login your account</h2>
                <div class="alert alert-danger login-error" role="alert">
                    Invalid username/password!
                </div>
                <form id="login-form" enctype="multipart/form-data">
                    <div class=" form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" name="username" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter username" required>
                    </div>
                    <div style="margin-top: 15px;" class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                            placeholder="Password" required>
                    </div>
                    <div style="margin-top: 10px;" class="form-group">
                        <button type="submit" class="btn btn-primary form-control">Login</button>
                    </div>

                    <div class="py-4">
                        <h5 class="text-center">
                            <a href="/account/register.php">Create an account</a>
                        </h5>
                    </div>

                </form>
            </div>
        </div>
        <div class="flex-fill"></div>
    </div>
    <?php include '../scripts.php'; ?>
    <script>
        $(document).ready(function () {
            $(".login-error").hide();
            $("#login-form").submit(function (e) {

                const formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: '/php/customerLogin.php',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        if (response === "success") {
                            window.location.href = "/shop.php";
                            l
                        } else {
                            $(".login-error").show();
                        }
                    }
                });

                e.preventDefault();

            });

        })
    </script>
</body>

</html>