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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    <script src="script.js"></script>
    <header>
        <!-- logo -->
        <div class="logo">
            <img src="./assets/images/ceals_icon_2.jpg" alt="logo" width="90px " height="90px">
            <!-- h1 -->
            <h1>Cereals Delmivery system</h1>

            <div class="serch_button">
                <form>
                    <input type="text" placeholder="Search...">
                    <button type="submit">Go</button>

                </form>
            </div>
        </div>
    </header>
    <style>
        .content {
            width: 75%;
            margin: 0 auto;
            font-family: Arial, Helvetica, sans-serif;
        }

        .img {
            width: 50%;
            float: left;
        }

        .par {
            width: 50%;
            float: right;
        }

        .content img {
            width: 350px;
            height: 350px;
        }

        p {
            font-size: 18px;
            padding: 10px;
        }

        button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>

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
                <li><a href="products.php">Products</a></li>
                <li><a href="services.php">Services</a></li>

            </ul>
        </nav>

    </section>

    <br>

    <section>
        <div class="imagelisting">
            <?php
            include 'dbh.php';
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM product WHERE p_id = $id";
                $result = mysqli_query($conn, $sql);
                $queryResults = mysqli_num_rows($result);
                if ($queryResults > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                            <div class="content">
                            <div class="img">
                                <img src="assets/images/products/' . $row['image'] . '" alt="' . $row['p_name'] . '">
                            </div>
                            <div class="par">
                                <p>' . $row['p_name'] . '</p>
                                <p>' . $row['p_description'] . '</p>
                                <p>amount: ' . $row['P_amount'] . ' Ksh</p>
                                <p>available quantity: ' . $row['price'] . 'kg</p>
                                <button>Purchase product</button>
                            </div>
                        </div>
                        ';
                    }
                }
            }
            ?>

            <!-- <div class="content">
                <div class="img">
                    <img src="./assets/images/grain_0.jpg" alt="ret">
                </div>
                <div class="par">
                    <p>Maize</p>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eveniet modi suscipit atque tenetur quidem error praesentium voluptas ipsum ut at, nemo amet repudiandae ratione iste quo nihil a laborum necessitatibus!</p>
                    <p>amount: 63 Ksh</p>
                    <p>available quantity: 33kg</p>
                    <button>Purchase product</button>
                </div>
            </div> -->
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