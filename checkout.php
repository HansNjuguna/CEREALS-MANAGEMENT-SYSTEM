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

/* 
http://localhost/work/CEREALS%20MANAGEMENT%20SYSTEM/checkout.php?cart=%5B%7B%22id%22%3A4%2C%22name%22%3A%22Wheat-+Mwamba+%22%2C%22price%22%3A52%2C%22amount%22%3A10%2C%22image%22%3A%22wheat+mwamba.jpg%22%2C%22quantity%22%3A2%2C%22total%22%3A104%7D%5D

http://localhost/work/CEREALS%20MANAGEMENT%20SYSTEM/checkout.php?cart=%5B%7B%22id%22%3A4%2C%22name%22%3A%22Wheat-+Mwamba+%22%2C%22price%22%3A52%2C%22amount%22%3A10%2C%22image%22%3A%22wheat+mwamba.jpg%22%2C%22quantity%22%3A2%2C%22total%22%3A104%7D%2C%7B%22id%22%3A5%2C%22name%22%3A%22Wheat-+Farasi%22%2C%22price%22%3A50%2C%22image%22%3A%22wheat+farasi.jpg%22%2C%22quantity%22%3A1%2C%22total%22%3A50%7D%5D

*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Checkout</h1>
            </div>
            <!-- item card -->
            <div class="col-md-4">
                <?php
                if (isset($_GET['cart'])) {
                    $cart = $_GET['cart'];
                    echo "cart: $cart";
                    $cartPass = [$cart];
                    // encode $cartPass to json
                    $cartPass = json_encode($cartPass);
                    echo "cartPass: $cartPass";
                    // loop through cart items
                    $cart = json_decode($cart);
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

                                    ?>
                                    <h5>Checkout</h5>
                                    <p>Subtotal: 104</p>
                                    <p>Shipping: 0</p>
                                    <p>Total: <?php echo $total; ?></p>
                                    <input type="hidden" name="total" value="<?php echo $total; ?>">
                                    <input type="hidden" name="cart" value="<?php echo $cartPass; ?>">
                                    <button type="submit" name="checkout">Checkout</button>
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
</body>

</html>