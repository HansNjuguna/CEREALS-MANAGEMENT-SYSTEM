<?php
// start sission if not started
if (!isset($_SESSION)) {
    session_start();
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['cart_items'])) {
    $cart = $_GET['cart_items'];
    $cart = explode(',', $cart);
    $cart = array_filter($cart);
    $cart = array_unique($cart);
    $cart = implode(',', $cart);
    $cart = urlencode($cart);
    header("Location: checkout.php?cart=$cart");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- icon -->
    <link rel="icon" href="./assets/images/ceals_icon_2.jpg" type="image/png" sizes="16x16">
    <!-- jqury modal css -->
    <link rel="stylesheet" href="resources/burt/css/jquery.modal.min.css">
    <!-- burt.css -->
    <!-- <link rel="stylesheet" href="resources/burt/css/burt.css"> -->
    <!-- jquery -->
    <script src="resources/burt/js/jquery.js"></script>
    <!-- jquery modal -->
    <script src="resources/burt/js/jquery.modal.min.js"></script>
    <!-- sweetalert -->
    <script src="resources/burt/js/sweetalert.min.js"></script>
    <!-- font awesome -->
    <link rel="stylesheet" href="resources/burt/fontawesome-free-5.15.4-web/css/all.min.css">
    <!-- waitme loader css -->
    <link rel="stylesheet" href="resources/burt/Animations-waitMe/waitMe.css">
    <!-- waitMe js loader -->
    <script src="resources/burt/Animations-waitMe/waitMe.js"></script>
    <!-- choosen custom select css -->
    <link rel="stylesheet" href="resources/burt/chosen_v1.8.7_2/docsupport/style.css">
    <link rel="stylesheet" href="resources/burt/chosen_v1.8.7_2/chosen.css">
    <!-- choosen custom select js -->
    <script src="resources/burt/chosen_v1.8.7_2/chosen.jquery.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <!-- initalize choosen -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.chosen-select').chosen();
        });
    </script>

    <title>Checkout</title>

    <style>
        * {
            padding: 0;
            margin: 0;
        }

        body {
            background-color: #f1f1f1;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            margin: 0 auto;
            width: 80%;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-md-12 {
            width: 100%;
        }

        .col-md-4 {
            width: 60%;
        }

        .card {
            background-color: #fff;
            margin: 10px;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 10px;
        }

        .img-fluid {
            width: 100%;
        }

        .col-md-8 {
            padding: 10px;
        }

        h5 {
            font-size: 1.2rem;
        }

        p {
            font-size: 1rem;
            padding: 15px 10px;
        }

        button {
            background-color: #f1f1f1;
            border: none;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin: 10px;
        }

        button:hover {
            background-color: green;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        form {
            width: 100%;
            /* display: flex; */
            padding-bottom: 20px;
        }

        .form-group {
            padding: 5px 0;
            display: flex;
            justify-content: space-between;
        }

        input {
            padding: 4px 8px;
        }

        .cardd {
            padding-top: 10px;
        }

        .danger {
            color: red;
        }

        .success {
            color: green;
        }

        .hidden {
            display: none;
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
                <li><a href="admin_login.php">Admin</a></li>
                <li><a href="products.php">Products</a></li>
                
                <!-- cart -->
                <li><a href="cart.php" id="cart"><i class="fas fa-shopping-cart"></i> Cart</a></li>

            </ul>
        </nav>

    </section>

    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Checkout</h1>
            </div>
            <!-- item card -->
            <div class="col-md-4">
                <?php
                if (isset($_GET['cart'])) {
                    // get cart from cart_items cookie
                    if (isset($_COOKIE['cart_items'])) {
                        $cart = $_COOKIE['cart_items'];
                    } else {
                        $cart = $_GET['cart'];
                    }
                    // echo "cart: $cart";
                    echo "<span class='hidden' id='origin-cart'>cart: $cart</span>";
                    $cartPass = [$cart];
                    // encode $cartPass to json
                    $cartPass = json_encode($cartPass);
                    // echo "cartPass: $cartPass";
                    // loop through cart items
                    $cart = json_decode($cart);
                    // prety print cart
                    /* echo "<pre>";
                    print_r($cart);
                    echo "</pre>"; */
                    $_SESSION['cart'] = $cart;
                    foreach ($cart as $item) {
                        // display item in card
                        echo '<div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="assets\images\products\\' . $item->image . '" alt="product" class="img-fluid">
                                        </div>
                                        <div class="col-md-8">
                                            <h5>' . $item->name . '</h5>
                                            <p>Price: ' . $item->price . '</p>
                                            <p>Quantity: ' . $item->quantity . '</p>
                                            <p>Total: ' . $item->total . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }
                ?>
                <!-- <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="assets\images\products\wheat mwamba.jpg" alt="product" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <h5>Wheat- Mwamba</h5>
                                <p>Price: 52</p>
                                <p>Quantity: 2</p>
                                <p>Total: 104</p>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            <!-- nw -->
            <!-- checkout calculator -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5>Shipping Details</h5>
                        <?php
                        if (isset($_GET['errors'])) {
                            $errors = json_decode($_GET['errors'], true);
                            foreach ($errors as $key => $value) {
                                echo "<div class='danger'>$value</div>";
                            }

                            $b_data = json_decode($_GET['b_data'], true);

                            // success message from $_SESSION['message']
                            if (isset($_SESSION['message'])) {
                                echo "<div class='success'>" . $_SESSION['message'] . "</div>";
                                unset($_SESSION['message']);
                            }
                        }
                        ?>
                        <form action="reg_exe.php" method="POST">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="state">State</label>
                                <input type="text" name="state" id="state" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="zip">Zip</label>
                                <input type="text" name="zip" id="zip" class="form-control">
                            </div>
                            <div class="cardd">
                                <div class="card-bodyd">
                                    <?php
                                    // calculate total
                                    $total = 0;
                                    foreach ($cart as $item) {
                                        $total += $item->total;
                                    }
                                    $init_total = $total;
                                    $shipping = 100;
                                    $total += $shipping;
                                    ?>
                                    <h5>Checkout</h5>
                                    <p>Subtotal: <?php echo $init_total; ?> Ksh</p>
                                    <p>Shipping: <?php echo $shipping; ?> Ksh</p>
                                    <p>Total: <?php echo $total; ?> Ksh</p>
                                    <input type="hidden" name="total" value="<?php echo $total; ?>">
                                    <input type="hidden" name="cart" value="<?php print_r($cartPass); ?>">
                                    <input type="hidden" name="checkout">
                                    <button type="submit" name="checkout" class="checkout">Checkout</button>
                                    <div class="waitme"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- nw -->

            </div>
        </div>
        <!-- nw -->
        <div class="row">
            <!-- shipping details -->
            <div class="col-md-6">
                <!-- nxbnx -->
            </div>
        </div>
    </div>

    <!-- <div class="btn btn-primary" id="waitme">Waitme</div> -->
    <script>
        $(".checkout").click(function() {
            event.preventDefault();
            // add width and height
            $('.waitme').css({
                'width': '100px',
                'height': '100px'
            });
            $('.waitme').waitMe({
                effect: 'bounce',
                text: 'Please wait...',
                bg: 'rgba(255,255,255,0.7)',
                color: '#000',
                maxSize: '',
                waitTime: -1,
                textPos: 'vertical',
                fontSize: '',
                source: '',
                onClose: function() {}
            });
            // get form data
            var form = $("form").serialize();
            console.log(form);
            // submit form through ajax
            $.ajax({
                url: "reg_exe.php",
                method: "POST",
                data: form,
                success: function(data) {
                    // console.log(data);
                    // remove waitme
                    $('.waitme').waitMe('hide');
                    // id data is success swal success
                    if (data == "success") {
                        swal({
                            title: "Success",
                            text: "Order placed successfully",
                            icon: "success",
                            button: "Ok",
                        }).then(function() {
                            // redirect to homepage
                            window.location.href = "index.php";
                        });
                    } else {
                        // else swal error and echo data
                        swal({
                            title: "Error",
                            text: data,
                            icon: "error",
                            button: "Ok",
                        })
                    }
                }
            });
        });
    </script>
</body>

</html>