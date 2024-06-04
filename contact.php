<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Us</title>
    <?php include('assets.php'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Additional CSS for alignment */
        .contact-form {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .contact-form button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <?php
    $active = 'contact';
    include('header.php');
    ?>
    <div class="contact" style="height: calc(100vh - 450px);">
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3870.5288782765883!2d121.26511577491307!3d14.045917586377369!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd43795dee5535%3A0x2b86bc6e65e1db21!2sSan%20Roque%20Chapel!5e0!3m2!1sen!2sph!4v1713786777337!5m2!1sen!2sph"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="400" height="300" style="border: 0;"
                allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="contact-form">
            <h2>Contact Us</h2>
            <form id="contactForm" action="contact.php" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php include('footer.php'); ?>
    <script>
        // JavaScript function to show alert when form is submitted
        document.getElementById("contactForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent form submission
            alert("Thank you! We have received your message.");
            // You can add additional code here, like submitting the form via AJAX
        });
    </script>
</body>

</html>