<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPayEasy | Orders</title>
    <?php include('../assets.php'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/cart.css">
    <style>
        .my-account a {
            font-size: 22px;
        }

        .link-active {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .container {
            margin-top: 20px;
        }

        .text-center h2 {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    $active = 'customer-order';
    include('../header.php');
    require('../php/config.php');

    if (!isset($_SESSION['customer_login'])) {
        header("Location: /shop.php");
        exit();
    }
    

    $username = mysqli_real_escape_string($con, $_SESSION['customer_login']);
    $query = "SELECT * FROM orders WHERE customer_id = '$username'";
    $result = mysqli_query($con, $query);

    $count = mysqli_num_rows($result);
    ?>

    <div class="container padding-bottom-3x mb-1" style="padding-bottom: 40px;">
        <nav class="nav my-account py-4">
            <a class="nav-link <?php echo $active === 'my-account' ? 'link-active' : '' ?>" aria-current="page"
                href="/account/settings.php">My Account</a>
            <a class="nav-link <?php echo $active === 'customer-order' ? 'link-active' : '' ?>"
                href="/account/orders.php">Orders</a>
        </nav>

        <div class="py-4 text-center">
            <h2><i class="fa-solid fa-cart-flatbed"></i> Orders</h2>
        </div>

        <?php if ($count > 0) { ?>
        <div class="orders-list">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Order #</th>
                        <th scope="col">Items</th>
                        <th scope="col">Total</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fetch = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <th scope="row"><?php echo $fetch['order_id'] ?></th>
                        <td>
                            <?php
                            foreach (json_decode($fetch['product_orders']) as $x) {
                                $index = 0;
                                echo '<div style="padding: 10px 0;">';
                                foreach (json_decode(json_encode($x)) as $item) {
                                    if ($index === 1 || $index === 3 || $index === 4) {
                                        echo $item . ' ';
                                    }
                                    if ($index === 5) {
                                        echo 'Quantity: ' . $item;
                                    }
                                    $index++;
                                }
                                echo '</div>';
                            }
                            ?>
                        </td>
                        <td>&#8369;<?php echo $fetch['total'] ?></td>
                        <td><?php echo $fetch['order_date'] ?></td>
                        <td class="text-capitalize"><?php echo $fetch['status'] ?>
                            <?php if ($fetch['status'] === 'cancelled') { ?>
                            <div>Reason: <?php echo $fetch['reason']; ?> </div>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } else { ?>
        <h3 style="text-align: center;">0 Orders Placed</h3>
        <?php } ?>
    </div>

    <?php include('../footer.php'); ?>
</body>

</html>