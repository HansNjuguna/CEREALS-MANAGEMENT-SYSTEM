<?php
// start sission if not started
if (!isset($_SESSION)) {
    session_start();
}
// if session is not set this will redirect to login page
/* if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}
 */
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
    <title>Cereals Order system</title>
    <!-- link rel="stylesheet" href="style.css">     -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    <script src="script.js"></script>
    <header>
        <!-- logo -->
        <div class="logo">
            <img src="./assets/images/ceals_icon_2.jpg" alt="logo" width="90px " height="90px">
        </div>
        <!-- h1 -->
        <h1>Cereals Order system</h1>
        <br>
        <!-- social media -->
        <div class="social_media"><a href=""><i class="fa fa-twitter"></i></a>
            <a href=""><i class="fa fa-instagram"></i></a>
            <a href=""><i class="fa fa-facebook-official"></i></a>
            <a href=""><i class="fa fa-youtube-play"></i></a>
            <a href=""><i class="fab fa-whatsapp"></i></a>
            <a href=""><i class="fa fa-envelope"></i></a>
            <a href=""><i class="fa fa-phone"></i></a>
            <br>
        </div>

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
                <!-- <li><a href="login.php">Login/Register</a></li> -->
                <li><a href="admin_login.php">Admin</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="services.php">Services</a></li>
                <?php
                if (isset($_SESSION['username'])) { ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                <?php }
                ?>

            </ul>
        </nav>

    </section>

    <br>

    <section>
        <div class="imagelisting">
            <?php
            include 'dbh.php';
            $sql = "SELECT * FROM product";
            $result = mysqli_query($conn, $sql);
            $queryResults = mysqli_num_rows($result);
            if ($queryResults > 0) {
                while ($row =  mysqli_fetch_assoc($result)) {
                    echo "<div class='image'>
                        <img src='assets/images/products/" . $row['image'] . "' alt='" . $row['p_name'] . "'>
                        <p>" . $row['p_name'] . "</p>
                        <a href='view-products.php?id=" . $row['p_id'] . "'>View product</a>
                    </div>
                    ";
                }
            }
            ?>
            <!-- <div class="image"> <img src="./assets/images/grain_0.jpg" alt="Image 2">
                <p>grapheme_extract</p>
                <a href="#">View product</a>
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
                <p>grapheme_extract</p> -->
        </div>

        </div>
        <br>
        <section>
            <section>

                <div class="upperfooter">
                    <div class="main">
                        <ul>
                            <li><a href="about_us.php">> ABOUT US</a></li>
                            <li><a href="FAQS.php">> FAQS</a></li>
                            <li><a href="pivacy_policy.php">> Privacy policy</a></li>
                            <li><a href="terms_of-use.php">> Terms of use</a></li>
                            <li><a href="admin_login.php">> Admin Login</a></li>
                            <?php
                            if (isset($_SESSION['username'])) { ?>
                                <li><a href="logout.php">> Logout</a></li>
                            <?php } else { ?>
                                <li><a href="login.php">> Login</a></li>
                            <?php }
                            ?>
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