<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Products</title>
    <?php include('../assets.php'); ?>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: /admin/login.php");
        die();
    }

    $active = 'products';
    include('../header.php');
    include('../php/config.php');
    ?>
    <div class="container" style="margin-top: 30px;">
        <div>
            <div class="d-flex justify-content-between">
                <div>
                    <h3>List of Products</h3>
                </div>
                <div>
                    <button type="button" class="btn btn-dark add-product-btn">
                        <i class="fa-solid fa-plus"></i>
                        Add Product
                    </button>
                </div>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Color</th>
                    <th scope="col">Size</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Categories</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="list-of-products">
                <?php
                $query = "SELECT * FROM `products`";
                $result = mysqli_query($con, $query);

                while ($fetch = mysqli_fetch_assoc($result)) {
                ?>
                    <tr class="product-<?php echo $fetch['product_id']; ?>">
                        <td>
                            <img style="width: 50px;" src="<?php echo "/uploads/$fetch[image]" ?>" alt="">
                        </td>
                        <td>
                            <span style="display: inline-block; max-width: 12rem;" class="text-truncate"><?php echo $fetch['product_name']; ?></span>
                        </td>
                        <td data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $fetch['description']; ?>">
                            <span style="display: inline-block; max-width: 10rem;" class="text-truncate"><?php echo $fetch['description']; ?></span>
                        </td>
                        <td><?php echo $fetch['color']; ?></td>
                        <td><?php echo $fetch['size']; ?></td>
                        <td><?php echo $fetch['price']; ?></td>
                        <td><?php echo $fetch['quantity']; ?></td>
                        <td>
                            <?php echo $fetch['best_seller'] === '1' ? '<span class="badge-best-seller badge alert-success">Best Seller</span>' : ''; ?>
                            <?php echo $fetch['brand_new'] === '1' ? '<span class="badge-brand-new badge alert-info">Brand New</span>' : ''; ?>
                            <?php echo $fetch['new_arrival'] === '1' ? ' <span class="badge-brand-new badge alert-danger">New Arrival</span>' : ''; ?>
                        </td>
                        <td>
                            <button type="button" product-id="<?php echo $fetch['product_id']; ?>" class="btn btn-light delete-product" style="margin-right: 5px; margin-bottom: 10px;">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <button product="<?php echo htmlspecialchars(json_encode($fetch)); ?>" type="button" class="btn btn-dark edit-product" style="margin-bottom: 10px;">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="add-new-product-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3" id="photo-container" style="text-align: center;">
                            <img id="preview-image" style="width: 100px;" src="/uploads/ip15max.png" alt="">
                        </div>
                        <div class="mb-3">
                            <label for="file_photo" class="form-label">Product Image</label>
                            <input class="form-control" type="file" id="file_photo" name="file_photo">
                        </div>
                        <div class="mb-3">
                            <label for="product-name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product-name" placeholder="ex.Iphone X" name="productName" required>
                        </div>
                        <div class="mb-3">
                            <label for="product-description" class="form-label">Description</label>
                            <textarea name="productDescription" class="form-control" id="product-description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="product-price" class="form-label">Price</label>
                            <input type="number" name="productPrice" class="form-control" id="product-price" placeholder="ex. 35000" required>
                        </div>
                        <div class="mb-3">
                            <label for="product-quantity" class="form-label">Quantity</label>
                            <input type="number" name="productQuantity" class="form-control" id="product-quantity" placeholder="ex. 5" required>
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="flex-fill">
                                <label for="product-size" class="form-label">Size</label>
                                <select name="productSize" class="form-select" id="product-size" aria-label="Default select example">
                                    <option value="32GB">32GB</option>
                                    <option value="64GB">64GB</option>
                                    <option value="128GB">128GB</option>
                                    <option value="256GB">256GB</option>
                                    <option value="512GB">512GB</option>
                                    <option value="1TB">1TB</option>
                                </select>
                            </div>
                            <div class="flex-fill" style="margin-left: 10px;">
                                <label for="product-color" class="form-label">Color</label>
                                <select name="productColor" class="form-select" id="product-color" aria-label="Default select example">
                                    <option value="White">White</option>
                                    <option value="Black">Black</option>
                                    <option value="Space Gray">Space Gray</option>
                                    <option value="Rose Gold">Rose Gold</option>
                                    <option value="Pink">Pink</option>
                                    <option value="Red">Red</option>
                                    <option value="Blue">Blue</option>
                                </select>
                            </div>
                        </div>

                        <label for="category" class="form-label">Category</label>
                        <div class="form-check">
                            <input name="isBestSeller" class="form-check-input chk-best-seller" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Best Seller
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input chk-new-arrival" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                New Arrival
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input chk-brand-new" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Brand New
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-save">Save Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include('../footer.php'); ?>

    <script>
        let delete_product_id = null;
        let selected_product_id = 0;
        let selected_image = "";

        function deleteProduct(productId) {
            $.post("/php/deleteProduct.php", {
                product_id: productId
            }, function (result) {
                if (result.success) {
                    $(`.product-${productId}`).remove();
                    alert('Product deleted successfully.');
                } else {
                    alert('Failed to delete product.');
                }
            }, 'json');
        }

        const productName = $("#product-name");
        const productDescription = $("#product-description");
        const productPrice = $("#product-price");
        const productQuantity = $("#product-quantity");
        const productColor = $("#product-color");
        const productSize = $("#product-size");
        const bestSeller = $(".chk-best-seller");
        const newArrival = $(".chk-new-arrival");
        const brandNew = $(".chk-brand-new");

        $(document).ready(function () {
            let isEdit = false;

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#preview-image').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#file_photo").change(function () {
                $("#photo-container").show();
                readURL(this);
            });

            $(".add-product-btn").click(function () {
                $(".btn-save").text("Save Product");

                $("#photo-container").hide();
                $("#preview-image").attr("src", ``);

                productName.val("");
                productDescription.val("");
                productPrice.val("");
                productQuantity.val("");
                bestSeller.prop("checked", false);
                newArrival.prop("checked", false);
                brandNew.prop("checked", false);

                isEdit = false;
                $("#add-new-product-modal").modal("show");
            });

            $(document).on('click', '.edit-product', function () {
                console.log('edit click');
                isEdit = true;

                $(".btn-save").text("Update Product");
                const product = $(this).attr("product");
                const {
                    product_id,
                    product_name,
                    description,
                    color,
                    size,
                    quantity,
                    price,
                    best_seller,
                    new_arrival,
                    brand_new,
                    image
                } = JSON.parse(product);

                console.log(JSON.parse(product));

                $("#photo-container").show();
                $("#preview-image").attr("src", `/uploads/${image}`);

                brandNew.prop('checked', brand_new === "1");
                bestSeller.prop('checked', best_seller === "1");
                newArrival.prop('checked', new_arrival === "1");

                productName.val(product_name);
                productDescription.val(description);
                productQuantity.val(quantity);
                productPrice.val(price);
                productSize.val(size);
                productColor.val(color);

                selected_product_id = product_id;
                selected_image = image;

                $("#add-new-product-modal").modal("show");
            });

            $(document).on('click', '.delete-product', function () {
                delete_product_id = $(this).attr("product-id");
                if (confirm("Are you sure you want to delete this product?")) {
                    deleteProduct(delete_product_id);
                }
            });

            $("#add-form").submit(function (e) {
                const file_data = $('#file_photo').prop('files')[0];
                const formData = new FormData(this);

                formData.append('file_photo', file_data);
                formData.append('brandNew', brandNew.prop('checked') ? 1 : 0);
                formData.append('bestSeller', bestSeller.prop('checked') ? 1 : 0);
                formData.append('newArrival', newArrival.prop('checked') ? 1 : 0);
                formData.append('type', isEdit ? 'edit' : 'add');
                formData.append('product_id', selected_product_id);
                formData.append('image', selected_image);

                $.ajax({
                    type: 'POST',
                    url: '/php/addOrEditProduct.php',
                    data: formData,
                    contentType: false,
                    dataType: 'html',
                    cache: false,
                    processData: false,
                    success: function (response) {
                        if (isEdit) {
                            $(`.product-${selected_product_id}`).replaceWith(response);
                        } else {
                            productName.val("");
                            productDescription.val("");
                            productPrice.val("");
                            productQuantity.val("");
                            $(`.list-of-products`).append(response);
                        }
                        $("#add-new-product-modal").modal("hide");
                    }
                });

                e.preventDefault();
            });
        });
    </script>
</body>

</html>