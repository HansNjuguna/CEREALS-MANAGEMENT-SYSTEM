<?php
// start sission if not started
if (!isset($_SESSION)) {
    session_start();
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['username']) && !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
} else {
    header("Location: messages.php");
}
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
    <title>Cereals Order System</title>
    <!-- link rel="stylesheet" href="style.css">     -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    <script src="script.js"></script>
    <header>
        <!-- logo -->
        <div class="logo">
            <img src="./assets/images/ceals_icon_2.jpg" alt="logo" width="90px " height="90px">
          <!--h1-->
            <h1>Cereals Order System</h1>
         <div>
            
                <form class="serch_button" style="float: right;">
                    <input type="text" placeholder="Search...">
                    <button type="submit">Go</button>

                </form>
</div>
            

    </header>
    <style>
        /* Add some basic styling */
        /* body {
          font-family: Arial, sans-serif;
          margin: 0;
          padding: 0;
          background-image: url(./assets/images/maddi-bazzocco-UhrHTmVBzzE-unsplash.jpg);
        }
        .container_b {
          max-width: 800px;
          margin: 0 auto;
          padding: 20px;
        }
        .container_b h1 {
          text-align: center;
        }
        .container_b form {
          margin: 20px 0;
        }
        .container_b input[type="text"],
        textarea {
          display: block;
          width: 100%;
          padding: 10px;
          margin-bottom: 20px;
          box-sizing: border-box;
          border: 1px solid #ccc;
          border-radius: 5px;
          font-size: 16px;
        }
        .container_b input[type="submit"] {
          background-color: #4CAF50;
          color: white;
          padding: 10px 20px;
          border: none;
          border-radius: 5px;
          cursor: pointer;
        }
        .container_b input[type="submit"]:hover {
          background-color: #3e8e41;
        } */
        .container_b {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        form {
            margin: 20px 0;
        }

        .form-control {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        input {
            padding: 10px;
            /* margin-bottom: 20px; */
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-control label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input:focus {
            outline: none;
            border-color: #4CAF50;
        }

        textarea:focus {
            outline: none;
            border-color: #4CAF50;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #3e8e41;
        }

        .danger {
            color: red;
        }

        .success {
            color: green;
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
                
                

        </nav>

    </section>

    <section>
        <div class="container_b">
            <h1>Contact Us</h1>
            <form action="reg_exe.php" method="post">
                <?php
                if (isset($_GET['errors'])) {
                    $errors = json_decode($_GET['errors'], true);
                    foreach ($errors as $key => $value) {
                        echo "<div class='danger'>$value</div>";
                    }

                    $b_data = json_decode($_GET['b_data'], true);
                }
                if (isset($_SESSION['message'])) {
                    $msg = $_SESSION['message'];
                    echo "<div class='success'>$msg</div>";
                    unset($_SESSION['message']);
                }
                ?>
                <div class="form-control">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter your name" value="<?php
                                                                                                    if (isset($b_data['name'])) {
                                                                                                        echo $b_data['name'];
                                                                                                    }
                                                                                                    ?>">
                </div>
                <!-- email -->
                <div class="form-control">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" value="
                    <?php
                    if (isset($b_data['email'])) {
                        echo $b_data['email'];
                    }
                    ?>">
                </div>
                <!-- usertype -->
                <div class="form-control">
                    <label for="usertype">User Type</label>
                    <select name="user_type" id="usertype">
                        <option value="customer">Customer</option>
                        <option value="supplier">Supplier</option>
                    </select>
                </div>
                <!-- subject -->
                <div class="form-control">
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" id="subject" placeholder="Enter your subject" value="<?php
                                                                                                            if (isset($b_data['subject'])) {
                                                                                                                echo $b_data['subject'];
                                                                                                            }
                                                                                                            ?>">
                </div>
                <!-- message -->
                <div class="form-control">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Enter your message"></textarea>
                </div>
                <button type="submit" name="contact">Send message</button>
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