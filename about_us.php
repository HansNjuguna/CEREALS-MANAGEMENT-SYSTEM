<!DOCTYPE html>
<html lang="en">

<head>
    <!-- icon -->
    <link rel="icon" href="./assets/images/ceals_icon_2.jpg" type="image/png" sizes="16x16">
    <!-- meta -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cereals Order Sytem</title>
    <!-- link rel="stylesheet" href="style.css">     -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="script.js"></script>
    <!-- font awesome -->
    <link rel="stylesheet" href="resources/burt/fontawesome-free-5.15.4-web/css/all.min.css">

    <script src="script.js"></script>
    <header>
        <!-- logo -->
        <div class="logo">
            <img src="./assets/images/ceals_icon_2.jpg" alt="logo" width="90px " height="90px">
            <!-- h1 -->
            <h1>Cereals Order System</h1>

        </div>
        <form action="search-results.php" method="GET" class="serch_button" style="float: right;">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit">search</button>
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

        <!-- fixed image -->

        <div class="fixed">
            <h2> OUR SATISFIED CUSTOMERS</h2>

    </section>

    <section>

        <div class="upperfooter">
            <div class="main">
                <ul>
                    <li><a href="about_us.php"><i class="fas fa-info"></i> About US</a></li>
                    <!-- <li><a href="FAQS.php"><i class="fas fa-question"></i> FAQS</a></li> -->
                    <li><a href="pivacy_policy.php"><i class="fas fa-user-shield"></i> Privacy policy</a></li>
                    <li><a href="terms_of-use.php"><i class="fas fa-handshake"></i> Terms of use</a></li>
                    <li><a href="admin_login.php"><i class="fas fa-sign-in-alt"></i> Admin Sign in</a></li>
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
        </div>
    </section>

    <section>
        <div class="footer">
            <p>Copyright@2023 - online cereals system. All rights reserved <span class="burt">by Openisoft, Axzyte g</span></p>
            <br>
            <button id="scrollTopBtn">Scroll to Top</button>

        </div>
    </section>
</body>

</html>