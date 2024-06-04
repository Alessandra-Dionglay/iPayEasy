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
            <br>
            <br>
            <br>
    <div class="d-flex justify-content-center">
        <div class="flex-fill" style="width: 30%;"></div>
        <div class="flex-fill" style="display: flex;
                    justify-items: center;
                    align-items: center;
                    height: calc(100vh - 500px); ">
            <div style="width: 100%;">
                <h3 class="py-3 text-center">Create an Account</h3>
                <div class="alert alert-danger username-exist" role="alert">
                    Username already exist!
                </div>
                <form id="register-form" action="/php/customerRegister.php" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" name="firstname" id="firstName" placeholder=""
                                value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" name="lastname" id="lastName" placeholder=""
                                value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-3">
                            <label for="firstName">Username</label>
                            <input type="text" minlength="6" class="form-control" name="username" id="firstName"
                                placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="lastName">Password</label>
                            <input type="password" minlength="6" class="form-control" name="password" id="lastName"
                                placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Register</button>
                </form>
            </div>
        </div>
        <div class="flex-fill" style="width: 30%;"></div>
    </div>
    <?php include '../scripts.php'; ?>
    <script>
        $(document).ready(function () {
            $(".username-exist").hide();
            $("#register-form").submit(function (e) {

                const formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: '/php/customerRegister.php',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        if (response === 'exist') {
                            $(".username-exist").show();
                        }
                        if (response === 'success') {
                            location.reload();
                        }
                    }
                });
                e.preventDefault();
            });
        })
    </script>
</body>

</html>