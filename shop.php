<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPayEasy | Shop</title>
    <?php include ('assets.php'); ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/shop.css">
</head>

<body>
    <?php
    $active = 'shop';
    include ('header.php');
    ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src='uploads/feat1.jpg' class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src='uploads/feat2.jpg' class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src='uploads/feat3.jpg' class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src='uploads/feat4.jpg' class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container">
        <div class="shop-container">
            <div class="products-sidebar">
                <h4>Categories</h4>
                <ul class="product-categories">
                    <li class="all-products category-active">All Products</li>
                    <li class="best-sellers">Best Sellers</li>
                    <li class="new arrivals">New Arrivals</li>
                    <li class="brand-new">Brand New</li>
                </ul>
            </div>
            <div class="products-catalog">
                <div class="product-container">
                    <h3>All Products</h3>
                    <div class="products-list">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Cart Modal -->
    <div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog cart-modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div style="display: flex; justify-content: flex-end; margin-right: 20px;">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="product-preview">
                        <div class="preview-photo">
                            <img class="preview-image" src="uploads/ip15max.png" alt="">
                        </div>
                        <div class="product-preview-info">
                            <h2 style="margin-bottom: 15px;">Iphone 15 Pro Max (Brand New)
                            </h2>
                            <div>
                                <span class="badge-best-seller badge alert-success">Best Seller</span>
                                <span class="badge-brand-new badge alert-info">Brand New</span>
                            </div>
                            <p class="cart-product-description">
                                iPhone 15 Pro and iPhone 15 Pro Max ; Battery life that's positively Pro. Even with so
                                many
                                advanced new features, iPhone 15 Pro still gives you amazing all‑day ...
                            </p>
                            <div class="quantity-price">
                                <div>
                                    <label>QUANTITY</label>
                                    <div class="quantity-buttons">
                                        <button class="decrease-quantity">-</button>
                                        <div class="item-quantity-count">1</div>
                                        <button class="add-quantity">+</button>
                                    </div>
                                </div>
                                <div>
                                    <label>PRICE</label>
                                    <div class="price-cart">&#8369;55000</div>
                                </div>
                            </div>

                            <div class="add-to-cart-container">
                                <?php
                                if (isset($_SESSION['customer_login'])) {
                                    ?>
                                    <button class="add-to-cart">ADD TO CART</button>

                                    <?php
                                } else {

                                    ?>
                                    <button class="login-account">Login your account</button>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include ('footer.php'); ?>

    <!-- SCRIPTING LANGUAGE -->
    <script>
        let item_cart_quantity = 1;
        let selected_product;
        let cart_count = 0;

        function showCartModal(element) {

            $("#cart-modal").modal('show');
            //reset
            $(".badge-best-seller").show();
            $(".badge-brand-new").show();
            item_cart_quantity = 1;
            $(".item-quantity-count").text(item_cart_quantity)

            const product = $(element).attr('product');
            // console.log(product)
            selected_product = JSON.parse(product)

            if (selected_product.best_seller === "0") {
                $(".badge-best-seller").hide();
            }

            if (selected_product.brand_new === "0") {
                $(".badge-brand-new").hide();
            }
            //badge



            $(".preview-image").attr('src', `uploads/${selected_product.image}`);
            $(".product-preview-info h2").text(selected_product.product_name);
            $(".cart-product-description").text(selected_product.description);
            $(".price-cart").text(selected_product.price);
        }

        $(document).ready(function () {
            $("#cart-modal-list").modal('show');
            let allProducts = [];


            $(".item-quantity-count").text(item_cart_quantity);

            $(".decrease-quantity").click(function () {

                if (item_cart_quantity !== 1) {
                    item_cart_quantity -= 1;
                    $(".item-quantity-count").text(item_cart_quantity)
                }

            })

            $(".add-quantity").click(function () {

                if (item_cart_quantity >= 0) {
                    item_cart_quantity += 1;
                    $(".item-quantity-count").text(item_cart_quantity)
                }

            })

            $(".login-account").click(function () {
                location.href = 'account/login.php'
            })

            $(".add-to-cart").click(function () {

                const product = {
                    ...selected_product,
                    cart_item_id: Date.now(),
                    quantity: item_cart_quantity,
                }

                $.ajax({
                    type: 'POST',
                    url: '/php/addToCart.php',
                    data: {
                        product: product
                    },
                    success: function (response) {
                        console.log('response', response);
                        const prev_cart_count = Number($(".cart-count").text());
                        $(".cart-count").text(prev_cart_count + 1);
                        $("#cart-modal").modal('hide');
                    }
                });
            })

            function createProductList(products, title) {

                // reset
                $(`.products-list`).empty();
                products.forEach(product => {

                    const pr = JSON.stringify(product);

                    $(`.products-list`).append(`
                <label label class= "product"
                            for= "cart-modal"
                            product = '${JSON.stringify(product)}'
                            onclick = 'showCartModal(this)'
                >
                <div class="product-each">
                    <div class="product-image-container">
                        <img class="product-image" src="uploads/${product.image}" />
                    </div>
                    <div style="margin-top: 5px;">
                        <span class="product-size badge alert-info">${product.size || 'Unavailable'}</span>
                        <span class="product-color badge alert-info">${product.color || 'Unavailable'}</span>
                    </div>
                    <div class="product-info">
                        <div class="product-name">
                            ${product.product_name}
                        </div>
                        <div class="product-price">
                            &#8369;${product.price}
                        </div>
                    </div>
                </div>
                            </label >
                    `);
                });
            }


            $.get("/php/getProducts.php", function (data, status) {
                allProducts = JSON.parse(data);
                // allProducts = [...JSON.parse(data), ...JSON.parse(data), ...JSON.parse(data), ...JSON.parse(
                //     data)];

                // // All Iphones
                createProductList(allProducts, 'All Products');
            });

            $(".product-categories li").click(function (e) {
                const category = e.currentTarget.innerText;

                const categories = [{
                    class: 'all-products',
                    label: 'All Products'
                }, {
                    class: 'best-sellers',
                    label: 'Best Sellers'
                },
                {
                    class: 'new-arrivals',
                    label: 'New Arrivals'
                },
                {
                    class: 'brand-new',
                    label: 'Brand New'
                }
                ];

                const selected_class = categories.find(c => c.label === category);

                categories.forEach(function (e) {
                    $(`.${e.class}`).removeClass('category-active');
                    $(`.${selected_class.class}`).addClass('category-active');
                })

                // change Title based on category clicked
                $(".product-container h3").text(category);

                if (category === 'All Products') {
                    const bestSellers = allProducts.filter(product => product.best_seller === "1");
                    createProductList(allProducts, 'All Products')
                }

                if (category === 'Best Sellers') {
                    const bestSellers = allProducts.filter(product => product.best_seller === "1");
                    createProductList(bestSellers, 'Best Sellers')
                }

                if (category === 'New Arrivals') {
                    const newArrivals = allProducts.filter(product => product.new_arrival === "1");
                    createProductList(newArrivals, 'New Arrivals')
                }

                if (category === 'Brand New') {
                    const brandNew = allProducts.filter(product => product.brand_new === "1");
                    createProductList(brandNew, 'Brand New')
                }

            })
        })
    </script>
</body>

</html>