<?php
// start sission if not started
if (!isset($_SESSION)) {
    session_start();
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
// select logged-in users details
$username = $_SESSION['username'];
$userid = $_SESSION['user_id'];
/* echo $username;
echo $userid; */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- icon -->
    <link rel="icon" href="./assets/images/ceals_icon_2.jpg" type="image/png" sizes="16x16">
    <!-- meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online cereals strtolower</title>
    <!-- link rel="stylesheet" href="style.css">     -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./assets/font-awesome-4.7.0/css/font-awesome.min.css" />
    <script src="script.js"></script>
    <header>
        <!-- logo -->
        <div class="logo">
            <img src="./assets/images/ceals_icon_2.jpg" alt="logo" width="90px " height="90px">
        </div>
        <!-- h1 -->
        <h1>Cereals Order system</h1>
        <form class="serch_button" style="float: right;">


            <input type="text" placeholder="Search...">
            <button type="submit">Go</button>


        </form>


    </header>

</head>

<body>
    <!-- navigation bar -->
    <section class="navigation_bar">
        <nav>
            <ul class="nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php">Login/Register</a></li>
                <li><a href="admin_login.php">Admin</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="services.php">Services</a></li>


            </ul>
        </nav>


    </section>
    <section>
        <!-- banner_section -->
        <div class="banner_section">
            <h1>Make a purchase, and we will deliver it to your home.</h1>
            <p>Online Cereals store is a website that allows you to buy cereals online and have them delivered to your
                home.</p>

        </div>
    </section>
    <br>
    <section class="more_about">
        <h1>Dear valued customers</h1>
        <p>
            We appreciate your continued support and are committed to providing you with the best shopping experience on our e-commerce site. Our team is constantly working to improve the site and add new features to make your shopping experience even better. If you have any questions or feedback, please do not hesitate to reach out to us. Thank you for choosing our site and we look forward to serving you in the future."
        </p>

    </section>

    <br>
    <section>
        <div class="imagelisting">
            <div class="image"> <img src="./assets/images/grain_0.jpg" alt="Image 2">
                <p>grapheme_extract</p>
            </div>
            <div class="image"> <img src="./assets/images/grain_1.jpg" alt="Image 3">
                <p>grapheme_extract</p>
            </div>
            <div class="image"> <img src="./assets/images/grain_3.jpg" alt="Image 4">
                <p>grapheme_extract</p>
            </div>
            <div class="image"> <img src="./assets/images/grain_4.jpg" alt="Image 5">
                <p>grapheme_extract</p>
            </div>
            <div class="image"> <img src="./assets/images/grain_5.jpg" alt="Image 6">
                <p>grapheme_extract</p>
            </div>
            <div class="image"> <img src="./assets/images/grain_7.jpg" alt="Image 7">
                <p>grapheme_extract</p>
            </div>


        </div>
        <br>
        <section>


            <div class="upperfooter">
                <div class="main">
                    <ul>
                        <li><a href="about_us.php">> ABOUT US</a></li>
                        <li><a href="FAQS.php">> FAQS</a></li>
                        <li><a href="pivacy_policy.php">> Privacy policy</a></li>
                        <li><a href="terms_of-use.php">> Terms of use</a></li>
                        <li><a href="admin_login.php">> Admin Login</a></li>
                    </ul>
                </div>
                <div class="sidebar">
                    <form>
                        <label for="email">SUBSCRIBE NEWSLETTER</label>
                        <input type="email" id="email" name="email" placeholder="example@email.com">
                        <br>
                        <button type="submit">Subscribe</button>
                        <p>
                            if you dont have an account
                            <br><a href="user_sign _up.php">Sign up!</a>
                            here now
                        </p>
                    </form>


                </div>
        </SEction>

        <section>
            <div class="footer">
                <p>Copyright@2023 - online cereals system. All rights reserved</p>
                <a href="pivacy_policy.html">privacy policy</a>
                <a href="terms_of-use.html">Terms of use</a>
                <i class="fabv fa-twitter"></i>
                <i class="fabv fa-whatsapp"></i>
                <i class="fabv fa-facebook"></i>
                <i class="fab fa-instagram"></i>
            </div>
        </section>
</body>

</html>