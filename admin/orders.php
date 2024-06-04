<?php
session_start();
if (isset($_SESSION["login"])) {
} else {
    header("Location: /admin/login.php");
    die();
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Orders</title>
    <?php include ('../assets.php'); ?>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .order-info h5 {
            font-size: 16px;
        }
    </style>
</head>

<body>
    <?php
    $active = 'orders';
    include ('../header.php');
    include ('../php/config.php');
    ?>
    <div class="container" style="margin-top: 30px;">
        <div>
            <div class="d-flex justify-content-between">
                <div>
                    <h3>List of Orders</h3>
                </div>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Address</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="list-of-products">

                <?php
                $query = "SELECT * FROM `orders`";
                $result = mysqli_query($con, $query);

                while ($fetch = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr class="order-<?php echo $fetch['order_id']; ?>""
                    class=" align-middle">
                        <td><?php echo $fetch['order_id']; ?></td>
                        <td><?php echo $fetch['customer_name']; ?></td>
                        <td><?php echo $fetch['order_date']; ?></td>
                        <td data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="<?php echo $fetch['address']; ?>">
                            <span class="text-truncate" style=" display: inline-block; max-width: 10rem;">

                                <?php echo $fetch['address']; ?>
                            </span>
                        </td>
                        <td><?php echo $fetch['contact']; ?></td>
                        <td><?php echo $fetch['status']; ?></td>
                        <td>
                            <button order="<?php echo htmlspecialchars(json_encode($fetch)); ?>" type=" button"
                                class="btn btn-dark edit-product" style="margin-bottom: 10px;"> View Order</button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="view-order-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="update-order-form" enctype="multipart/form-data">

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal-title">Add New Customer</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 order-info">
                            <h4 class="customer-name"></h4>
                            <h5 class="order-date"></h5>
                            <h5 class="customer-contact"></h5>
                            <h5 class="customer-email"></h5>
                            <h5 class="customer-address"></h5>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-select" id="order-status" aria-label="Satus">
                                <option value="processing">Processing</option>
                                <option value="delivery">Out for Delivery</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="mb-3 reason-field">
                            <label for="address" class="form-label">Reason for cancelling</label>
                            <textarea name="reason" class="form-control" id="reason" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-save">Save
                            Customer</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <?php include ('../footer.php'); ?>

    <script>
        let delete_customer_id = null;
        let selected_customer_id = 0;
        let selected_order_id = 0;

        function deleteProduct() {
            $.post("/php/deleteCustomer.php", {
                customer_id: delete_customer_id
            }, function (result) {
                $(`.order-${delete_customer_id}`).remove();
            });
        }


        const firstnameField = $("#firstname");
        const lastnameField = $("#lastname");
        const addressField = $("#address");
        const usernameField = $("#username");
        const passwordField = $("#password");
        $(document).ready(function () {
            let isEdit = false;
            $("#order-status").on('change', function () {
                const valueSelected = this.value;
                if (valueSelected === 'cancelled') {
                    $(".reason-field").show();
                } else {
                    $(".reason-field").hide();
                }

            })

            $(document).on('click', '.edit-product', function () {
                isEdit = true;
                $(".btn-save").text("Update Order");
                const order = $(this).attr("order");
                const {
                    order_id,
                    customer_id,
                    customer_name,
                    address,
                    contact,
                    email,
                    status,
                    reason,
                    order_date,
                } = JSON.parse(order)


                console.log(JSON.parse(order));

                $(".customer-name").text(customer_name);
                $(".customer-address").text(address);
                $(".customer-contact").text(contact);
                $(".order-date").text(order_date);
                if (email !== '') {
                    $(".customer-email").text(email);
                }

                $("#order-status").val(status);
                $("#reason").val(reason);

                if (status === 'cancelled') {
                    $(".reason-field").show();
                } else {
                    $(".reason-field").hide();
                }

                $("#modal-title").text("Order ID:" + order_id);

                selected_customer_id = customer_id;
                selected_order_id = order_id;

                $("#view-order-modal").modal("show");
            })

            $("#update-order-form").submit(function (e) {
                const formData = new FormData(this);
                // formData.append('type', isEdit ? 'edit' : 'add');
                formData.append('customer_id', selected_customer_id);
                formData.append('order_id', selected_order_id);
                $.ajax({
                    type: 'POST',
                    url: '/php/updateOrder.php',
                    data: formData,
                    contentType: false,
                    dataType: 'html',
                    cache: false,
                    processData: false,
                    success: function (response) {
                        console.log(response)
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