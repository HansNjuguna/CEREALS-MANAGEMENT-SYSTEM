<?php
// start sission if not started
if (!isset($_SESSION)) {
    session_start();
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['username']) && !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
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
    <title>Cereals Order System </title>
    <!-- link rel="stylesheet" href="style.css">     -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./assets/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="script.js"></script>
    <header>
        <!-- logo -->
        <div class="logo">
            <img src="assets/images/ceals_icon_2.jpg" alt="logo" width="90px " height="90px">
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

        <form action="search-results.php" method="GET" class="serch_button" style="float: right;">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit">search</button>
        </form>

        <div>
            <button class="toggle-button"></button>
            <span>
                <?php
                echo "Hello " . $_SESSION['username'];
                ?>
            </span>
            <div class="toggle-content">
                <a href="logout.php" id="logout">Logout</a>
                <a href="profile.php" id="profile">Profile</a>
            </div>
        </div>

    </header>
    <script src="/assets/jquery-3.6.3.min.js"></script>
    <style>
        .messages {
            width: 70%;
            height: 100%;
            overflow-y: scroll;
            margin: auto;
            min-height: 100vh;
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .messages-container {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .message {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .other,
        .self {
            width: 70%;
            padding: 10px;
            margin: 10px 0;
        }

        .other {
            background-color: #f1f0f0;
            border-radius: 10px 10px 0 10px;
            align-self: flex-start;
        }

        .self {
            background-color: #e2f3f5;
            border-radius: 10px 10px 10px 0;
            align-self: flex-end;
        }

        .messages-container form {
            width: 100%;
            /* height: 100px; */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            /* position: absolute;
            bottom: 0;*/
        }

        .messages-container form textarea {
            width: 90%;
            padding: 10px;
        }

        .messages-container form button {
            padding: 10px;
            background-color: #e2f3f5;
            margin: 10px 0;
        }

        .messages-container form button:hover {
            background-color: #f1f0f0;
        }

        .attach {
            width: 100%;
            height: 40px;
            margin: 10px 0;
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
                <!-- <li><a href="login.php">Login/Register</a></li> -->
                <li><a href="admin_login.php">Admin</a></li>
                <li><a href="products.php">Products</a></li>
                
                <?php
                if (isset($_SESSION['username'])) { ?>
                    <li><a href="logout.php"> Logout</a></li>
                    <li><a href="messages.php"> Messages</a></li>
                <?php } else { ?>
                    <li><a href="login.php"> Login</a></li>
                <?php }
                ?>

            </ul>
            </div>
        </nav>
    </section>

    <div class="messages">
        <h1>Messages</h1>
        <div class="messages-container">
            <div class="message">
                <?php
                include 'dbh.php';
                $uid = $_SESSION['user_id'];
                $sql = "SELECT * FROM messages WHERE uid = $uid";
                $result = mysqli_query($conn, $sql);
                $tot = mysqli_num_rows($result);
                if ($tot > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $attachement = $row['attachments'];
                        $message = $row['message'];
                        $to_id = $row['to_id'];
                        if ($to_id == $uid) {
                            echo '<div class="self">
                            <p>' . $message . '</p>
                            ';
                            if ($attachement != '') {
                                echo '<a href="' . $attachement . '" target="_blank">' . $attachement . '</a>';
                            }
                            echo '</div>';
                        } elseif ($to_id == 101) {
                            echo '<div class="other">
                            <p>' . $message .
                                '</p>
                            ';
                            if ($attachement != '') {
                                echo '<a href="' . $attachement . '" target="_blank">' . $attachement . '</a>';
                            }
                            echo '</div>';
                        }
                    }
                } else {
                    echo '<div class="other">
                    <p>There are no messages</p>
                </div>';
                }
                ?>
                <!-- <div class="other">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit autem debitis commodi, error amet deserunt hic obcaecati optio necessitatibus, corporis distinctio vero repellat dolores nesciunt consequatur officiis. At, tempore illo?</p>
                    <a href="#">attached files</a>
                </div>
                <div class="self">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit autem debitis commodi, error amet deserunt hic obcaecati optio necessitatibus, corporis distinctio vero repellat dolores nesciunt consequatur officiis. At, tempore illo?</p>
                    <a href="#">attached files</a>
                </div> -->
            </div>
            <!-- form message -->
            <?php
            if (isset($_SESSION['errors'])) {
                // $errors = json_decode($_GET['errors'], true);
                $errors = $_SESSION['errors'];
                foreach ($errors as $key => $value) {
                    echo "<div class='danger'>$value</div>";
                }
                unset($_SESSION['errors']);

                // $b_data = json_decode($_GET['b_data'], true);
            }
            if (isset($_SESSION['message'])) {
                $msg = $_SESSION['message'];
                echo "<div class='success'>$msg</div>";
                unset($_SESSION['message']);
            }
            ?>
            <form action="reg_exe.php" method="post" enctype="multipart/form-data">
                <textarea name="message" id="message" cols="30" rows="4" placeholder="Type amessage"></textarea>
                <!-- attach files -->
                <div class="attach">
                    <input type="file" name="file" id="file">
                    <label for="file">Attach file</label>
                </div>
                <button type="submit" name="msg-submit">Send</button>
            </form>
        </div>
    </div>

    <section>

        <div class="upperfooter">
            <div class="main">
                <ul>
                    <li><a href="about_us.php"> ABOUT US</a></li>
                    <li><a href="FAQS.php"> FAQS</a></li>
                    <li><a href="pivacy_policy.php"> Privacy policy</a></li>
                    <li><a href="terms_of-use.php"> Terms of use</a></li>
                    <li><a href="admin_login.php"> Admin Login</a></li>
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
            <br>
            <button id="scrollTopBtn">Scroll to Top</button>

        </div>
    </section>

</body>

</html>