<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPayEasy | Settings</title>
    <?php include ('../assets.php'); ?>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/cart.css">
    <style>
        .my-account a {
            font-size: 22px;
        }

        .link-active {
            font-weight: bold;
        }
    </style>
</head>

<body>
  
    <?php
    $active = 'my-account';
    include ('../header.php');
    require ('../php/config.php');

    if (empty($_SESSION['customer_login'])) {
        header("Location: /shop.php");
    }

    $username = $_SESSION['customer_login'];

    $query = "SELECT * FROM customers where username = '$username'";
    $result = mysqli_query($con, $query);

    $firstname = "";
    $lastname = "";
    $password = "";
    $contact = "";
    $email = "";
    $address = "";

    while ($fetch = mysqli_fetch_assoc($result)) {
        $firstname = $fetch['firstname'];
        $lastname = $fetch['lastname'];
        $password = $fetch['password'];
        $contact = $fetch['contact'];
        $email = $fetch['email'];
        $address = $fetch['address'];
    }

    ?>

    <div class="container padding-bottom-3x mb-1" style="padding-bottom: 100px;">

        <nav class="nav my-account py-4">
            <a class="nav-link <?php echo $active === 'my-account' ? 'link-active' : '' ?>" aria-current="page"
                href="/account/settings.php">My Account</a>
            <a class="nav-link  <?php echo $active === 'customer-order' ? 'link-active' : '' ?>"
                href="/account/orders.php">Orders</a>
        </nav>
        <div class="py-4">
            <h2><i class="fa-solid fa-gear"></i> Settings</h2>
        </div>
        <div class="alert alert-success update-success" style="display: none;" role="alert">
            Account successfully updated!
        </div>
        <div class="row">
            <div class="col-md-4 order-md-1">
                <form id="settings-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="mb-3">
                            <label for="firstName">Username</label>
                            <input type="text" class="form-control" name="firstname" id="firstName" placeholder=""
                                value="<?php echo $username; ?>" readonly required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" name="firstname" id="firstName" placeholder=""
                                value="<?php echo $firstname; ?>" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" name="lastname" id="lastName" placeholder=""
                                value="<?php echo $lastname; ?>" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="firstName">Password</label>
                            <input type="password" minlength="6" class="form-control" name="password" id="password"
                                placeholder="" value="<?php echo $password; ?>" required>
                            <div class="invalid-feedback">
                                Valid Password is required.
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="mb-3">
                        <label for="username">Contact Number</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="contact" id="contact-number"
                                value="<?php echo $contact; ?>" placeholder="Contact Number">
                            <div class="invalid-feedback" style="width: 100%;">
                                Your Contact Number is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" class="form-control" value="<?php echo $email; ?>" name="email" id="email"
                            placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" value="<?php echo $address; ?>"
                            id="address" placeholder="1234 Main St">
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <button class="btn btn-dark btn-block" type="submit">Update Account</button>
                </form>
            </div>
            <div class="col-md-8 order-md-2">
    <!-- Image of an iPhone -->
    <img src="https://creatoom.com/wp-content/uploads/2022/11/iphone-14-pro-on-white-background-v2-front-view.jpg" alt="iPhone" class="img-fluid mb-3">
</div>
        </div>

    </div>

    <?php include ('../footer.php'); ?>
    <script>
        $("#settings-form").submit(function (e) {

            const formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: '/php/updateSettings.php',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (response === "success") {
                        $(".update-success").show();
                        window.setTimeout(function () {
                            $(".update-success").fadeTo(500, 0).slideUp(500,
                                function () {
                                    $(this).remove();
                                });
                        }, 4000);
                    }
                }
            });

            e.preventDefault();

        });
    </script>
</body>

</html>