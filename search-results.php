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
            <img src="assets/images/ceals_icon_2.jpg" alt="logo" width="90px " height="90px">
            <!-- h1 -->
            <h1>Cereals Order system</h1>
            <form action="search-results.php" method="GET" class="serch_button" style="float: right;">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit">search</button>
            </form>
        </div>
    </header>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: auto;
        }

        .container form {
            background-color: #E4C988;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px #333;
            width: 500px;
        }

        .container h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .container label,
        input[type="text"],
        input[type="password"] {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .container button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .danger {
            color: red;
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
                <li><a href="login.php">Login</a></li>
                <li><a href="sign_up.php">Register</a></li>
                <li><a href="admin_login.php">Admin</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="services.php">Services</a></li>

            </ul>
        </nav>

    </section class="body_image">
    <!-- login page -->
    <section>
        <div class="container">
            <!-- search-results.php -->
            <?php
            include 'dbh.php';
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                $search = preg_replace("#[^0-9a-z]#i", "", $search);
                $query = mysqli_query($conn, "SELECT * FROM product WHERE p_name LIKE '%$search%' OR p_description LIKE '%$search%'");
                $count = mysqli_num_rows($query);
                if ($count == 0) {
                    echo '<div class="search-header">
                            <h1>Search Results for "' . $search . '"</h1>
                        </div>
                        <div class="imagelisting">
                            <p>No results found</p>
                        </div>';
                } else {
                    echo '<div class="search-header">
                            <h1>Search Results for "' . $search . '"</h1>
                        </div>
                        <div class="imagelisting">
                    ';
                    while ($row = mysqli_fetch_assoc($query)) {
                        echo "<div class='image'>
                        <img src='assets/images/products/" . $row['image'] . "' alt='" . $row['p_name'] . "'>
                        <p>" . $row['p_name'] . "</p>
                        <a href='view-products.php?id=" . $row['p_id'] . "'>View product</a>
                        </div>
                    ";
                    }
                    echo '</div>';
                }
            }
            ?>
            <!-- <div class="search-header">
                <h1>Search Results for products</h1>
            </div>
            <div class="imagelisting">
                <div class="image"> <img src="./assets/images/grain_0.jpg" alt="Image 2">
                    <p>grapheme_extract</p>
                    <a href="#">View product</a>
                </div>
            </div> -->
    </section>
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