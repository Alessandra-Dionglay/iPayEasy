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
    ?>
</head>

<body>
    <div class="container" style="height: calc(100vh - 420px);">
        <div class="py-2 text-center">
            <div class="py-4 text-center">
                <h2 style="font-size: 60px; "><i style="color: #29a929;" class="fa-solid fa-circle-check"></i></h2>
            </div>
        </div>
        <div class="text-center">
            <h2 style="color: #29a929;">Order Successfully Placed</h2>
        </div>

        <div class="text-center">
            <a href="shop.php">
                <button class="btn btn-outline-secondary" type="submit">Back to shopping</button>
            </a>
        </div>

    </div>

    <?php include 'footer.php' ?>
</body>

</html>