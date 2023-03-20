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
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="./assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="script.js"></script>
    <!-- font awesome -->
    <link rel="stylesheet" href="resources/burt/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

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

    <section class="privacy_policy">

        <p>1. Acceptance of Terms: Use of the online store constitutes acceptance of the Terms of Use.<br>
            2. Age Restrictions: Use of the store is only for those over the age of 18.<br>
            3. Product Information: The store attempts to be as accurate as possible, but does not guarantee accuracy.<br>
            4. Payment: Payments must be made through the accepted methods listed on the store.<br>
            5. Shipping and Delivery: Store is not responsible for any shipping or delivery delays.<br>
            6. Return and Refund Policy: Returns and refunds will be handled in accordance with the store's policy.<br>
            7. Intellectual Property: All content on the store, such as text, graphics, logos, is protected by copyright laws.<br>
            8. User Conduct: The user agrees not to use the store for any illegal or unauthorized purpose.<br>
            9. Modifications to Terms: The store reserves the right to change the Terms of Use at any time.<br>
            10. Governing Law: The Terms of Use and use of the store will be governed by and construed in accordance with the laws of the jurisdiction in which the store is located<br>

        </p>
    </section>
    <section>

        <div class="upperfooter">
            <div class="main">
                <ul>
                    <li><a href="about_us.php"><i class="fas fa-info"></i> About US</a></li>
                    <li><a href="FAQS.php"><i class="fas fa-question"></i> FAQS</a></li>
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