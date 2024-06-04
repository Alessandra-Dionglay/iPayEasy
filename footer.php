<?php

if ($current_url !== '/admin') {
    ?>
<div style="background: white;">
    <div class="container">
        <footer class="section-p1 footer-links">
            <div class="col contact-info">
                <h4>Contact</h4>
                <p><strong>Address: </strong> Purok 3, Alaminos, Laguna</p>
                <p><strong>Phone: </strong> 0905-502-0817 </p>
                <p><strong>Hours: </strong> 24/7 Mon - Sat</p>
                <div class="follow">
                    <h4>Follow us on <i class="fab fa-facebook"></i></h4>
                    <div class="icon">

                        <!-- <i class="fab fa-instagram"></i> -->
                    </div>
                </div>
            </div>

            <div class="col">
                <h4>About</h4>
                <a href="about.php">About Us</a>
                <a href="about.php">Privacy Policy</a>
                <a href="about.php">Terms and Conditions</a>
                <a href="contact.php">Contact Us</a>
            </div>

            <div class="col">
                <h4>My Account</h4>
                <?php

                    if (!isset($_SESSION['customer_login'])) {
                        ?>
                <a href="/account/login.php">Sign In</a>
                <?php
                    }

                    ?>
                <a href="/cart.php">View Cart</a>
            </div>

            <img src="/images/logo.png" alt="pics" style="width: 230px; height: 110px;">
            <div class="copyright">
                <p>@2024, B.D.G. - iPayEasy</p>
            </div>
        </footer>
    </div>
</div>

<script>
$(document).ready(function() {
    $(".checkout-button").click(function() {
        $("#cart-modal-list").modal('hide');
    })

})
</script>

<?php

}

?>
<?php include ('scripts.php') ?>
<script>
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
$(document).ready(function() {

    $("#logout-btn").click(function() {

        $.ajax({
            type: 'POST',
            url: '/php/adminLogout.php',
            success: function(response) {
                if (response === "success") {
                    window.location.href = "/admin/login.php";
                    l
                }
            }
        });
    })

})
</script>