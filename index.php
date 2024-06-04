<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPayEasy</title>
    <?php include ('assets.php'); ?>
    <link rel="stylesheet" href="css/style.css">
</head>

<body style="background-image: url('../images/bgimage.png'); background-repeat: no-repeat;
  background-size: cover;
  background-position: none;
  width: 100%;
  height: 50vh;
  display: fixed; ">
    <?php
    $active = 'home';
    include ('header.php');
    ?>
    <br>
    <br>
    
    <div style="height: calc(100vh - 390px);">
        <section id="hero">
            <div class="text">
                <h4>Trade-in-Offer</h4>
                <h2>Super value deals </h2>
                <h1>On all products</h1>
                <p>Your premier destination for a hassle-free</p>
                <p>Cellphone purchases and installment plans.</p>
                <a href="shop.php"><button><span class="marquee">Shop Now<span></button></a>
            </div>
        </section>

        <section class="right-section">
            <main>
                <img src="images/ftr5.jpg" alt="Image2" class="slide-xyz">
                <img src="images/ftr6.jpg" alt="Image3" class="slide-xyz">
                <img src="images/ftr4.jpg" alt="Image1" class="slide-xyz">
                <img src="images/ftr1.jpg" alt="Image2" class="slide-xyz">
                <img src="images/ftr2.jpg" alt="Image3" class="slide-xyz">
                <img src="images/ftr10.jpg" alt="Image1" class="slide-xyz">
            </main>

            <div class="navb">
                <button onclick="goPrev()" class="prev">&#10094</button>
                <button onclick="goNext()" class="next">&#10095</button>
            </div>

            <div class="texts">
                <h3>Go get your <span style="color: darkgoldenrod;">DREAM GADGETS NOW!</span> and <br>
                    <center>Save up More</center>
                </h3>
            </div>
        </section>

        <section id="feature" class="section-p1">
            <div class="fe-box">
                <img src="images/shippings.png" id="features">
                <h6>Shipping Options</h6>
            </div>

            <div class="fe-box">
                <img src="images/save.png" style="margin-top: 10px;">
                <h6>Save Money</h6>
            </div>

            <div class="fe-box">
                <img src="images/promotions.png">
                <h6>Sales Promotions</h6>
            </div>

            <div class="fe-box">
                <img src="images/happysellings.png">
                <h6>Happy Selling</h6>
            </div>
        </section>
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
    <!--                  FOOTER                    -->
    <?php include 'footer.php'; ?>


    <!-- SCRIPTING LANGUAGE -->
    <script>
        const slides = document.querySelectorAll(".slide-xyz")
        var counter = 0;

        slides.forEach(
            (slide, index) => {
                slide.style.left = `${index * 100}%`
            }
        )

        const goPrev = () => {
            counter--
            slideImage()
        }

        const goNext = () => {
            counter++
            slideImage()
        }

        const slideImage = () => {
            slides.forEach(
                (slide) => {
                    slide.style.transform = `translateX(-${counter * 100}%)`
                }
            )
        }
    </script>
</body>

</html>