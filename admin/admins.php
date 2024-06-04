<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: /admin/login.php");
    die();
}

require_once '../php/config.php';

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Admins</title>
    <?php include('../assets.php'); ?>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?php
    $active = 'admins';
    include('../header.php');
    ?>
    <div class="container" style="margin-top: 30px;">
        <div>
            <div class="d-flex justify-content-between">
                <div>
                    <h3>List of Admins</h3>
                </div>
                <div>
                    <button type="button" class="btn btn-dark add-admin-btn">
                        <i class="fa-solid fa-plus"></i>
                        Add Admin</button>
                </div>
            </div>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Username</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="list-of-admins">
                <?php
                $query = "SELECT * FROM `admins`";
                $result = mysqli_query($con, $query);
                while ($fetch = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr class="admin-<?php echo $fetch['admin_id']; ?>">
                        <td><?php echo $fetch['username']; ?></td>
                        <td class="text-end">
                            <button type="button" admin-id="<?php echo $fetch['admin_id']; ?>" class="btn btn-light delete-admin" style="margin-right: 5px; margin-bottom: 10px;">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <button admin="<?php echo htmlspecialchars(json_encode($fetch)); ?>" type="button" class="btn btn-dark edit-admin" style="margin-bottom: 10px;">
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

    <!-- Add Admin Modal -->
    <div class="modal fade" id="add-new-admin-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-form" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modal-title">Add New Admin</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" minlength="6" class="form-control" id="username" placeholder="delacruz02" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" minlength="6" class="form-control" id="password" placeholder="********" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-save">Save Admin</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include('../footer.php'); ?>

    <script>
        let isEdit = false;
        let selected_admin_id = 0;

        $(document).ready(function() {
            // Function to handle deletion of admins
            function deleteAdmin(admin_id) {
                $.post("/php/deleteAdmin.php", {
                    admin_id: admin_id
                }, function(result) {
                    if (result === 'success') {
                        $(".admin-" + admin_id).remove();
                    } else {
                        alert("Failed to delete admin.");
                    }
                });
            }

            // Open modal to add a new admin
            $(".add-admin-btn").click(function() {
                isEdit = false;
                $(".btn-save").text("Add Admin");
                $("#modal-title").text("Add New Admin");
                $("#add-form")[0].reset(); // Clear input fields
                $("#add-new-admin-modal").modal("show");
            });

            // Handle click on delete admin button
            $(document).on('click', '.delete-admin', function() {
                const admin_id = $(this).attr("admin-id");
                const confirmation = confirm("Are you sure you want to delete this admin?");
                if (confirmation) {
                    deleteAdmin(admin_id);
                }
            });

            // Handle click on edit admin button
            $(document).on('click', '.edit-admin', function() {
                isEdit = true;
                $(".btn-save").text("Update Admin");
                $("#modal-title").text("Update Admin");
                const admin = $(this).attr("admin");
                const {
                    admin_id,
                    username
                } = JSON.parse(admin);

                // Populate form fields
                $("#username").val(username);
                $("#password").val(''); // Optionally clear password field

                selected_admin_id = admin_id;

                $("#add-new-admin-modal").modal("show");
            });

            // Handle form submission for adding/editing admin
            $("#add-form").submit(function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                formData.append('type', isEdit ? 'edit' : 'add');
                formData.append('admin_id', selected_admin_id);

                $.ajax({
                    type: 'POST',
                    url: '/php/addOrEditAdmin.php',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response === 'success') {
                            location.reload();
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                    }
                });
            });
        });
    </script>

</body>
</html>