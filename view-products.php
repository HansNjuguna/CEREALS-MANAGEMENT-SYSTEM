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
    <!-- jquery -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="css/jquery.modal.min.css" />
    <script src="js/sweetalert.min.js"></script>

    <script src="script.js"></script>
    <header>
        <!-- logo -->
        <div class="logo">
            <img src="./assets/images/ceals_icon_2.jpg" alt="logo" width="90px " height="90px">
            <!-- h1 -->
            <h1>Cereals Order system</h1>
        </div>
        <form action="search-results.php" method="GET" class="serch_button" style="float: right;">
            <input type="text" name="search" placeholder="Search...">
            <button type="submit">search</button>
        </form>
    </header>
    <style>
        .content {
            width: 75%;
            margin: auto;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            flex-direction: row;
        }

        .img {
            width: 45%;
            /* float: left; */
        }

        .par {
            width: 45%;
            /* float: right; */
        }

        .par-view-product {
            padding: 10px;
            margin: 10px auto;
            border: 1px solid white;
            border-radius: 5px;
            background: #fff;
            transition: all 0.3s ease;
        }

        .par-view-product .name {
            font-size: 24px;
            font-weight: bold;
            color: #4CAF50;
        }

        .par-view-product .decription {
            font-size: 15px;
            font-weight: bold;
        }

        .par-view-product .quantity,
        .par-view-product .price {
            font-size: 15px;
            font-weight: bold;
            /* color: #4CAF50; */
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
                <!-- <li><a href="login.php">Login/Register</a></li> -->
                <li><a href="admin_login.php">Admin</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="services.php">Services</a></li>
                <?php
                if (isset($_SESSION['username'])) { ?>
                    <li><a href="logout.php"> Logout</a></li>
                <?php } else { ?>
                    <li><a href="login.php"> Login</a></li>
                <?php }
                ?>
                <!-- cart -->
                <li><a href="cart.php" id="cart"><i class="fas fa-shopping-cart"></i> Cart</a></li>

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
                        $name = $row['p_name'];
                        $description = $row['p_description'];
                        $amount = $row['P_amount'];
                        $quantity = $row['price'];
                        $image = $row['image'];
                        $id = $row['p_id'];
                        $price = $row['price'];
                        echo '
                            <div class="content">
                            <div class="img">
                                <img src="assets/images/products/' . $row['image'] . '" alt="' . $row['p_name'] . '">
                            </div>
                            <div class="par par-view-product">
                                <p class="name">' . $row['p_name'] . '</p>
                                <p class="decription">' . $row['p_description'] . '</p>
                                <p class="quantity">available quantity: ' . $row['P_amount'] . ' kg</p>
                                <p class="price">Price/kg: ' . $row['price'] . 'Ksh</p>
                                <button class="add-cart">Add to cart</button>
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
            </section>

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
        </section>
    </section>

    <script>
        $(document).ready(function() {


            // cart local storage init
            let cartAll = localStorage.getItem('cart');
            if (cartAll == null) {
                localStorage.setItem('cart', JSON.stringify([]));
            }

            // add-cart button
            const addCart = document.querySelector('.add-cart');
            addCart.addEventListener('click', () => {
                alert('Product added to cart');
                // add to cart function
                addToCart();
            });



            function addToCart() {
                let cart = JSON.parse(localStorage.getItem('cart'));
                let id = <?php echo $id; ?>;
                let name = '<?php echo $name; ?>';
                let price = <?php echo $price; ?>;
                let amount = <?php echo $amount; ?>;
                let image = '<?php echo $image; ?>';
                let quantity = 1;
                let total = price * quantity;
                let item = {
                    id: id,
                    name: name,
                    price: price,
                    amount: amount,
                    image: image,
                    quantity: quantity,
                    total: total
                };
                // if item already exists in cart then increase quantity
                let itemExists = cart.find(item => item.id == id);
                if (itemExists) {
                    itemExists.quantity += 1;
                    itemExists.total = itemExists.price * itemExists.quantity;
                } else {
                    cart.push(item);
                }
                // if quantity is more than available quantity then alert
                /* if (itemExists.quantity > amount) {
                    alert('Quantity is more than available quantity');
                    itemExists.quantity -= 1;
                    itemExists.total = itemExists.price * itemExists.quantity;
                } */
                // cart.push(item);
                localStorage.setItem('cart', JSON.stringify(cart));
                cartItems();
                // console log cart
                console.log(cart);
            }
            // function to display cart items number
            function cartItems() {
                let cart = JSON.parse(localStorage.getItem('cart'));
                let cartItems = cart.length;
                if (cartItems > 0) {
                    $('#cart').html(`<i class="fas fa-shopping-cart"></i> Cart (${cartItems})`);
                }
            }
        });
    </script>
</body>

</html>