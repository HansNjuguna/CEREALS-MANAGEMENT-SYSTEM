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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        table#t01 tr:nth-child(even) {
            background-color: #eee;
        }

        table#t01 tr:nth-child(odd) {
            background-color: #fff;
        }

        table#t01 th {
            background-color: black;
            color: white;
        }

        table img {
            width: 100px;
            height: 100px;
        }

        #checkout {
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
                <li><a href="login.php">Login/Register</a></li>
                <li><a href="admin_login.php">Admin</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="services.php">Services</a></li>
                <!-- cart -->
                <li><a href="cart.php" id="cart"><i class="fas fa-shopping-cart"></i> Cart</a></li>

            </ul>
        </nav>

    </section>

    <br>

    <section>
        <div class="imagelisting">
            <!-- list items in cart -->
            <div id="cart-view">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <!-- total -->
                    <tfoot>
                        <tr>

                            <td colspan="3" align="right">Total</td>
                            <td align="right"><span id="total">0</span></td>
                            <td></td>
                        </tr>
                        <!-- total_quantity -->
                        <tr>
                            <td colspan="3" align="right">Total Quantity</td>
                            <td align="right"><span id="total_quantity">0</span></td>
                            <td></td>
                    </tfoot>
                </table>
                <br>
                <div class="checkout">
                    <button type="button" id="checkout">Checkout</button>
                </div>
            </div>
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
            // get cart items from local storage
            var cart = JSON.parse(localStorage.getItem("cart"));
            var output = "";
            var total = 0;
            var total_quantity = 0;
            // loop through cart items
            for (var i in cart) {
                output += "<tr><td>" + cart[i].name + "</td><td>" + cart[i].price + "</td><td>" + cart[i].quantity + "</td><td>" + cart[i].price * cart[i].quantity + "</td><td><button class='remove' data-name='" + cart[i].name + "'>X</button></td></tr>";
                total += cart[i].price * cart[i].quantity;
                total_quantity += cart[i].quantity;
            }
            // display cart items
            $("#cart tbody").html(output);
            $("#total").html(total);
            $("#total_quantity").html(total_quantity);

            // display cart items
            /* function showCart() {
                var cart = JSON.parse(localStorage.getItem("cart"));
                var output = "";
                var total = 0;
                var total_quantity = 0;
                for (var i in cart) {
                    output += "<tr><td><img src='assets/images/products/" + cart[i].image + " ' alt='img'</td>" + "<td>" + cart[i].name + "</td><td>" + cart[i].price + "</td><td>" + cart[i].quantity + "</td><td>" + cart[i].price * cart[i].quantity + "</td><td><button class='remove' data-name='" + cart[i].name + "'>X</button></td></tr>";
                    total += cart[i].price * cart[i].quantity;
                    total_quantity += cart[i].quantity;
                }
                $("#cart-view tbody").html(output);
                $("#total").html(total);
                $("#total_quantity").html(total_quantity);
            } */
            function showCart() {
                var output = "";
                var total = 0;
                var total_quantity = 0;
                var cart = JSON.parse(localStorage.getItem("cart") || "[]");

                for (var i in cart) {
                    output += "<tr><td><img src='assets/images/products/" + cart[i].image + " ' alt='img'</td>" + "<td>" + cart[i].name + "</td><td>" + cart[i].price + "</td><td>" + cart[i].quantity + "</td><td>" + cart[i].price * cart[i].quantity + "</td><td><button class='remove' data-name='" + cart[i].name + "'>X</button></td></tr>";
                    total += cart[i].price * cart[i].quantity;
                    total_quantity += cart[i].quantity;
                }

                $("#cart-view tbody").html(output);
                $("#total").html(total);
                $("#total_quantity").html(total_quantity);

                // Attach event listener using event delegation
                $("#cart-view").on("click", ".remove", function() {
                    console.log("remove");
                    var name = $(this).attr("data-name");
                    var cart = JSON.parse(localStorage.getItem("cart") || "[]");
                    for (var i in cart) {
                        if (cart[i].name == name) {
                            cart.splice(i, 1);
                            break;
                        }
                    }
                    localStorage.setItem("cart", JSON.stringify(cart));
                    showCart();
                    check_btn();
                });
            }
            showCart();
            check_btn();

            function check_btn() {
                if (!localStorage.getItem("cart") || JSON.parse(localStorage.getItem("cart")).length === 0) {
                    $("#checkout").css("display", "none");
                    // console.log("null");
                    // console log cart items
                    console.log(JSON.parse(localStorage.getItem("cart")));
                } else {
                    $("#checkout").css("display", "block");
                    // console.log("not null");
                }
            }
            // onclick of checkout button redirect to checkout page and pass cart items to checkout page
            $("#checkout").click(function() {
                var cart = JSON.parse(localStorage.getItem("cart"));
                var cart_items = JSON.stringify(cart);
                // store cart in a cookie
                document.cookie = "cart_items=" + cart_items;

                // console.log(cart_items);
                window.location.href = "checkout.php?cart_items=" + cart_items;
            });

            // remove item from cart
            $(".removegh").click(function() {
                console.log("remove");
                var name = $(this).attr("data-name");
                var cart = JSON.parse(localStorage.getItem("cart"));
                for (var i in cart) {
                    if (cart[i].name == name) {
                        cart.splice(i, 1);
                        break;
                    }
                }
                localStorage.setItem("cart", JSON.stringify(cart));
                showCart();
                check_btn();
            });
        });
    </script>
</body>

</html>