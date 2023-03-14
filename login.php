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
            <!-- h1 -->
            <h1>Cereals Order system</h1>

            <div class="serch_button">
                <form>
                    <input type="text" placeholder="Search...">
                    <button type="submit">Go</button>

                </form>
            </div>

    </header>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
                
                <li><a href="sign_up.php">Register</a></li>
                <li><a href="admin_login.php">Admin</a></li>
                <li><a href="products.php">Products</a></li>
                

            </ul>
        </nav>

    </section class="body_image">
    <!-- login page -->
    <section>
        <div class="container">
            <form action="reg_exe.php" method="POST">
                <h1>Login</h1>
                <?php
                if (isset($_GET['errors'])) {
                    $errors = json_decode($_GET['errors'], true);
                    foreach ($errors as $key => $value) {
                        echo "<div class='danger'>$value</div>";
                    }
                }
                ?>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" placeholder="username...">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="password...">
                </div>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
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