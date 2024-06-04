<?php
if (!isset($_SESSION)) {
    session_start();
}


$query = $_SERVER['PHP_SELF'];
$path = pathinfo($query);
$current_url = $path['dirname'];

include 'php/config.php';

$username = "";
$cart_items = array();
$cart_count = 0;

if (isset($_SESSION['customer_login']) && $current_url !== '/admin') {
    $username = $_SESSION['customer_login'];

    $query = "SELECT * FROM customers where username = '$username'";
    $result = mysqli_query($con, $query);


    while ($fetch = mysqli_fetch_assoc($result)) {
        $cart_items = $fetch['cart'];
    }

    if (!empty($cart_items)) {
        $cart_items = json_decode($cart_items);
    }
    $cart_count = !empty($cart_items) ? count($cart_items) : 0;
}

?>
<?php


if ($current_url !== '/admin') {

    ?>
    <section id="header" style="background-color: #CCCCCC;">
        <a href="/"><img src="<?php echo "/images/logo.png" ?>" class="logo"></a>
        <nav >
            <ul id="navbar">
                <li><a class="item-nav <?php echo $active === 'home' ? 'active' : '' ?>" href="/">Home</a></li>
                <li><a class="item-nav <?php echo $active === 'shop' ? 'active' : '' ?>" href="/shop.php">Shop</a></li>
                <li><a class="item-nav <?php echo $active === 'about' ? 'active' : '' ?>" href="/about.php">About</a></li>
                <li><a class="item-nav <?php echo $active === 'contact' ? 'active' : '' ?>" href="/contact.php">Contact</a>
                </li>
                <a href="/cart.php">
                    <li class="cart-list-button iconClass" id="lg-bag">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="cart-count rounded-pill badge alert-success">
                            <?php echo $cart_count; ?>
                        </span>
                    </li>
                </a>
                <?php

                if (isset($_SESSION['customer_login'])) {
                    ?>
                    <div class="dropdown-center" style="margin-left: 20px;">
                        <a style="font-size: 18px;
    text-decoration: none; text-transform: capitalize;" class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <?php echo $_SESSION['customer_login']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-list">
                            <li><a class="dropdown-item" href="/account/settings.php">
                                    <i class="fa-solid fa-gear"></i>
                                    <span s tyle="margin-left: 3px;">Settings</span>
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="/account/orders.php">
                                    <i class="fa-solid fa-cart-arrow-down"></i>
                                    <span s tyle="margin-left: 3px;">Orders</span>
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="/php/customerLogout.php">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <span s tyle="margin-left: 3px;">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php
                } else {
                    ?>

                    <li><a style="text-decoration: none;" class="<?php echo $active === 'contact' ? 'active' : '' ?>"
                            href="/account/login.php">
                            <i class="fa-solid fa-user"></i>
                        </a></li>
                    <?php
                }
                ?>
            </ul>
        </nav>
    </section>

    <?php

} else {

    if (isset($_SESSION["login"])) {
        ?>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="/images/logo.png" alt="iPayEasy" style="width: 150px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?php echo $active === 'admins' ? 'page-active' : '' ?>" aria-current="page"
                                href="/admin/admins.php">Admins</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $active === 'customers' ? 'page-active' : '' ?>" aria-current="page"
                                href="/admin">Customers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $active === 'products' ? 'page-active' : '' ?>" aria-current="page"
                                href="/admin/products.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $active === 'orders' ? 'page-active' : '' ?>" aria-current="page"
                                href="/admin/orders.php">Orders</a>
                        </li>

                    </ul>
                    <div class="d-flex" role="search">
                        <span style="margin-right: 10px;"><i class="fa-solid fa-user-tie"></i>
                            <span style="color: #ee8a0e;">

                                <?php echo $_SESSION['login']; ?></span>
                        </span>
                        <span id="logout-btn" style="cursor: pointer;">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Logout</span>
                    </div>
                </div>
            </div>
        </nav>

        <?php
    }
?>
<?php
}
?>
<?php

if ($current_url !== '/admin') {

?>
<?php

}

?>