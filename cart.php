<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPayEasy | Cart</title>
    <?php include ('assets.php'); ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        /* Your custom styles here */
        .product-image {
            width: 80px; /* Set the width to your desired size */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>

<body>
    <?php
    // Include header
    $active = 'cart';
    include('header.php');

    // Retrieve cart items from session
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    // Check if user is logged in
    $isLogin = isset($_SESSION['customer_login']);
    ?>
    <div class="container padding-bottom-3x mb-1">
        <div class="py-5 text-center">
            <h2><i class="fa-solid fa-cart-arrow-down"></i> My Cart</h2>
        </div>
        <!-- Shopping Cart -->
        <?php if (!empty($cart)) : ?>
            <div class="table-responsive shopping-cart">
                <table class="table table-cart">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">
                                <a class="btn btn-sm btn-outline-danger" href="/php/clearCart.php">Clear Cart</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $subtotal = 0;
                        foreach ($cart as $key) :
                            $subtotal += $key['quantity'] * $key['price'];
                        ?>
                            <tr>
                                <td>
                                    <div class="product-item">
                                        <img class="product-image" src="/uploads/<?php echo $key['image']; ?>" alt="Product">
                                        <div class="product-info">
                                            <h4 class="product-title"><?php echo $key['product_name']; ?></h4>
                                            <span><em>Size:</em> <?php echo $key['size']; ?></span>
                                            <span><em>Color:</em> <?php echo $key['color']; ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <input type="text" class="form-control input-quantity" value="<?php echo $key['quantity']; ?>" readonly>
                                </td>
                                <td class="text-center text-lg text-medium">&#8369;<?php echo $key['price']; ?></td>
                                <td class="text-center">
                                    <a class="remove-from-cart" href="/php/deleteCartItem.php?item=<?php echo $key['cart_item_id']; ?>">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="shopping-cart-footer">
                <div class="column"></div>
                <div class="column text-lg">Subtotal: <span class="text-medium" style="font-size: 18px;">&#8369;<span class="subtotal"><?php echo $subtotal; ?></span></span></div>
            </div>
            <div class="shopping-cart-footer">
                <div class="column">
                    <a class="btn btn-outline-secondary" href="/shop.php">
                        <i class="fa-solid fa-arrow-left-long"></i> &nbsp;Back to Shopping
                    </a>
                </div>
                <div class="column">
                    <a class="btn btn-secondary update-cart" href="#" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Your cart" data-toast-message="is updated successfully!">Update Cart</a>
                    <a class="btn btn-dark submit-cart" href="checkout.php">
                        <?php echo $isLogin ? 'Checkout' : 'Login to Checkout' ?>
                    </a>
                </div>
            </div>
        <?php else : ?>
            <!-- Display message if cart is empty -->
            <h4 style="text-align: center;">Your Cart is empty</h4>
            <h5 class="text-center">
                <a class="btn btn-outline-secondary" href="/shop.php">Go to Shopping</a>
            </h5>
        <?php endif; ?>
    </div>
            <br>
            <br>
            <br>
            <br>
            <br>
    <?php include('footer.php'); ?>

    <script>
    $(document).ready(function() {
        const cart = JSON.parse($(".table-cart").attr("cart-list"));
        const isArr = Array.isArray(cart);

        let cart_items = [];

        if (!isArr) {
            Object.keys(cart).forEach(a => {
                cart_items.push(cart[a]);
            })
        } else {
            cart_items = cart
        }

        $(".input-quantity").blur(function() {
            const cart_index = $(this).attr('input-index');

            const itemIndex = cart_items.findIndex(c => c.cart_item_id === cart_index);
            const price = $(this).attr('price');
            const quantity = $(this).attr('quantity');
            const subtotal = Number($(".subtotal").text());
            const oldPrice = quantity * price;
            const oldSubtotal = subtotal - oldPrice;

            const newQuantity = $(this).val();

            //set new quantity
            cart_items[itemIndex].quantity = newQuantity;


            $(this).attr("quantity", newQuantity);

            const newSubtotal = (price * newQuantity) + oldSubtotal
            $(".subtotal").text(newSubtotal)

        })


        $(".update-cart").click(function() {
            $.ajax({
                type: 'POST',
                url: '/php/updateCart.php',
                data: {
                    cart: cart_items
                },
                success: function(response) {
                    $(".cart-updated-success").show();
                    window.setTimeout(function() {
                        $(".cart-updated-success").fadeTo(500, 0).slideUp(500,
                            function() {
                                $(this).remove();
                            });
                    }, 4000);
                }
            });
        })

        $(".submit-cart").click(function() {
            console.log();
            if ($(this).attr("is-checkout") === '1') {
                $.ajax({
                    type: 'POST',
                    url: '/php/updateCart.php',
                    data: {
                        cart: cart_items
                    },
                    success: function(response) {
                        location.href = 'checkout.php'
                    }
                });
            } else {
                location.href = '/account/login.php'
            }
        })
    })
    </script>
</body>

</html>