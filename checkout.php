<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPayEasy | Checkout</title>
    <?php include ('assets.php'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
    <?php
    $active = 'cart';
    include ('header.php');

    $cart = array();

    if (!empty($_SESSION['cart']) && !empty($_SESSION['customer_login'])) {
        $cart = $_SESSION['cart'];
    } else {
        header("Location: /shop.php");
    }
    ?>
</head>

<body>
    <div class="container" style="height: calc(100vh - 420px);">
        <div class="column" style="margin-top: 30px;">
            <a class="" href="/cart.php">
                <i class="fa-solid fa-arrow-left"></i>
                Return to Cart
            </a>
        </div>

        <div class="py-4 text-center">
            <h2>Checkout</h2>
        </div>


        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
                    $total = 0;
                    foreach ($cart as $key) {
                        $total = $total + ($key['quantity'] * $key['price']);
                        ?>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><?php echo $key['quantity'] . ' x ' . $key['product_name']; ?></h6>
                            <small class="text-muted">
                                <?php echo $key['size']; ?> /
                                <?php echo $key['color']; ?>
                            </small>
                        </div>
                        <span class="text-muted">&#8369;<?php echo $key['quantity'] * $key['price']; ?></span>
                    </li>
                    <?php
                    }
                    ?>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (PHP)</span>
                        <strong></strong>&#8369;
                        <span id="total-amount"><?php echo $total; ?></span></strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form id="checkout-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" name="firstname" id="firstName" placeholder=""
                                value="<?php echo $_SESSION["firstname"]; ?>" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" name="lastname" id="lastName" placeholder=""
                                value="<?php echo $_SESSION["lastname"]; ?>" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username">Contact Number</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="<?php echo $_SESSION["contact"]; ?>"
                                name="contact" id="contact-number" placeholder="Contact Number" required>
                            <div class="invalid-feedback" style="width: 100%;">
                                Your Contact Number is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" class="form-control" value="<?php echo $_SESSION["email"]; ?>" name="email"
                            id="email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION["address"]; ?>"
                            name="address" id="address" placeholder="1234 Main St" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <button class="btn btn-primary btn-block" type="submit">Place Order</button>
                </form>
            </div>
        </div>

    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php include 'footer.php' ?>

    <script>
    $(document).ready(function() {
        $("#checkout-form").submit(function(e) {

            const formData = new FormData(this);
            formData.append('total', Number($("#total-amount").text()))

            $.ajax({
                type: 'POST',
                url: '/php/placeOrder.php',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    if (response === 'success') {
                        window.location = '/checkout-success.php'
                    }
                }
            });

            e.preventDefault();

        });
    })
    </script>
</body>

</html>