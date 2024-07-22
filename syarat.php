<?php
$active = "Terms and Conditions";
include("functions.php");
include("header.php");
?>

<!-- Terms and Conditions Section Begin -->
<section class="terms-conditions-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Terms and Conditions</h2>
                <p>Welcome to our Terms and Conditions page. These terms and conditions outline the rules and regulations for the use of our website and the services we offer.</p>
                
                <h3>Introduction</h3>
                <p>By accessing this website, we assume you accept these terms and conditions. Do not continue to use our website if you do not agree to all of the terms and conditions stated on this page.</p>
                
                <h3>General Conditions</h3>
                <p>We reserve the right to refuse service to anyone for any reason at any time. You understand that your content (not including credit card information), may be transferred unencrypted and involve (a) transmissions over various networks; and (b) changes to conform and adapt to technical requirements of connecting networks or devices. Credit card information is always encrypted during transfer over networks.</p>

                <h3>Products and Services</h3>
                <p>Certain products or services may be available exclusively online through the website. These products or services may have limited quantities and are subject to return or exchange only according to our Return Policy.</p>

                <h3>Accuracy of Information</h3>
                <p>We are not responsible if information made available on this site is not accurate, complete, or current. The material on this site is provided for general information only and should not be relied upon or used as the sole basis for making decisions without consulting primary, more accurate, more complete, or more timely sources of information.</p>

                <h3>Modifications to the Service and Prices</h3>
                <p>Prices for our products are subject to change without notice. We reserve the right at any time to modify or discontinue the Service (or any part or content thereof) without notice at any time.</p>

                <h3>Governing Law</h3>
                <p>These terms and conditions are governed by and construed in accordance with the laws of [Your Country] and you irrevocably submit to the exclusive jurisdiction of the courts in that State or location.</p>

                <h3>Changes to Terms and Conditions</h3>
                <p>You can review the most current version of the Terms and Conditions at any time on this page. We reserve the right, at our sole discretion, to update, change, or replace any part of these Terms and Conditions by posting updates and changes to our website. It is your responsibility to check our website periodically for changes.</p>
            </div>
        </div>
    </div>
</section>
<!-- Terms and Conditions Section End -->

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
