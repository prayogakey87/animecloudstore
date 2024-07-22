<?php
$active = "About Us";
include("functions.php");
include("header.php");
?>

<!-- About Us Section Begin -->
<section class="aboutus-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>About Us</h2>
                <p>Welcome to our store! We are committed to providing you with the best quality products and excellent customer service. Our journey started in 2024, and since then, we have been dedicated to offering a wide range of products to meet the diverse needs of our customers.</p>
                <p>At our store, we believe in the power of community and strive to create a space where our customers feel valued and appreciated. Whether you are looking for the latest trends in fashion or essential everyday items, we have something for everyone.</p>
                <p>Thank you for choosing our store. We look forward to serving you and making your shopping experience enjoyable and memorable.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="aboutus-img">
                    <img src="img/store.jpg" width="75%" border-radius="10px" alt="Our Store">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="aboutus-img">
                    <img src="img/team.jpg" width="70%" border-radius="10px" alt="Our Team">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="aboutus-img">
                    <img src="img/OnePiece24-6-baru-3248239125.webp" width="125%" border-radius="10px" alt="Our Products">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us Section End -->

<!-- Footer -->
<?php
include('footer.php');

if (isset($_GET['stat'])) {
    echo "
        <script>
                bootbox.alert({
                    message: 'Welcome! You are logged in.',
                    backdrop: true
                });
        </script>";
}
?>

</body>
</html>
