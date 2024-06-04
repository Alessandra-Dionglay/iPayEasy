<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: /admin/login.php");
    die();
}

require_once '../php/config.php';

// Function to delete an admin account
function deleteAdmin($admin_id)
{
    global $con;
    $sql = "DELETE FROM admins WHERE admin_id='$admin_id'";
    if ($con->query($sql) === TRUE) {
        return true; // Successfully deleted
    } else {
        return false; // Failed to delete
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Customers</title>
    <?php include('../assets.php'); ?>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php
    $active = 'customers';
    include('../header.php');
    ?>
    <div class="container" style="margin-top: 30px;">
        <div>
            <div class="d-flex justify-content-between">
                <div>
                    <h3>List of Customers</h3>
                </div>
                <div>
                    <button type="button" class="btn btn-dark add-product-btn">
                        <i class="fa-solid fa-plus"></i>
                        Add Customer</button>
                </div>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Address</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="list-of-customers">
                <?php
                $query = "SELECT * FROM `customers`";
                $result = mysqli_query($con, $query);
                while ($fetch = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr class="customer-<?php echo $fetch['customer_id']; ?>">
                        <td><?php echo $fetch['firstname'] . ' ' . $fetch['lastname']; ?></td>
                        <td><?php echo $fetch['username']; ?></td>
                        <td><?php echo $fetch['address']; ?></td>
                        <td>
                            <button type="button" customer-id="<?php echo $fetch['customer_id']; ?>" class="btn btn-light delete-customer" style="margin-right: 5px; margin-bottom: 10px;">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <button customer="<?php echo htmlspecialchars(json_encode($fetch)); ?>" type="button" class="btn btn-dark edit-customer" style="margin-bottom: 10px;">
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

    <!-- Add Customer Modal -->
    <div class="modal fade" id="add-new-customer-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal-title">Add New Customer</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" placeholder="Juan" name="firstname" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" placeholder="Delacruz" name="lastname" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" minlength="6" class="form-control" id="username" placeholder="delacruz02" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" class="form-control" id="address" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-save">Save Customer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include('../footer.php'); ?>

    <script>
        $(document).ready(function() {
            // Function to handle deletion of customers
            function deleteCustomer(customer_id) {
                $.post("/php/deleteCustomer.php", {
                    customer_id: customer_id
                }, function(result) {
                    $(".customer-" + customer_id).remove();
                });
            }

            // Open modal to add a new customer
            $(".add-product-btn").click(function() {
                $(".btn-save").text("Add Customer");
                $("#modal-title").text("Add New Customer");
                $("#add-new-customer-modal").modal("show");
            });

            // Handle click on delete customer button
            $(document).on('click', '.delete-customer', function() {
                const customer_id = $(this).attr("customer-id");
                const confirmation = confirm("Are you sure you want to delete this customer?");
                if (confirmation) {
                    deleteCustomer(customer_id);
                }
            });
            
        $("#add-form").submit(function(e) {

            const formData = new FormData(this);
            formData.append('type', isEdit ? 'edit' : 'add');
            formData.append('customer_id', selected_customer_id);
            $.ajax({
                type: 'POST',
                url: '/php/addOrEditCustomer.php',
                data: formData,
                contentType: false,
                dataType: 'html',
                cache: false,
                processData: false,
                beforeSend: function() {
                    // $('.submitBtn').attr("disabled", "disabled");
                    // $('#fupForm').css("opacity", ".5");
                },
                success: function(response) {
                    if (isEdit) {
                        $(`.customer-${selected_customer_id}`).replaceWith(
                            response);
                    } else {
                        $(`.list-of-products`).append(response);
                    }
                    $("#add-new-product-modal").modal("hide");
                }
            });

            e.preventDefault();

        });
    })
    </script>

</body>

</html>