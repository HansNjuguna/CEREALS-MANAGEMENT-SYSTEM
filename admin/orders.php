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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="style.css">
    <script src="../assets/js/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="left">
            <?php
            // include sidebar
            include 'sidebar.php';
            ?>
        </div>
        <div class="right">
            <h1>Orders</h1>
            <div class="content">
                <!-- add product btn -->
                <!-- <button class="btn"><a href="add_product.php">Add a product</a> </button> -->
                <button><a href="download_orders.php" target="_blank" class="btn btn-primary">Download Orders</a></button>

                <div class="content">
                    <h2>Placed orders</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Order Date</th>
                                <th>Delivery Date</th>
                                <th>Delivery Status</th>
                                <th>Payment Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // include database connection
                            include '../dbh.php';
                            // select all orders
                            $query = "SELECT * FROM orders";
                            $result = mysqli_query($conn, $query);
                            $num = mysqli_num_rows($result);
                            // if there are orders
                            if ($num > 0) {
                                // fetch orders
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    // get user id
                                    $user_id = $row['user_id'];
                                    // select user
                                    $query = "SELECT * FROM user WHERE id = ?";
                                    $stmt = mysqli_prepare($conn, $query);
                                    mysqli_stmt_bind_param($stmt, "i", $user_id);
                                    mysqli_stmt_execute($stmt);
                                    $user = mysqli_stmt_get_result($stmt);
                                    $user = mysqli_fetch_assoc($user);
                                    // get user name
                                    $customer = $user['username'];
                                    // get product id
                                    $product_id = $row['product_id'];
                                    // select product
                                    $query = "SELECT * FROM product WHERE p_id = ?";
                                    $stmt = mysqli_prepare($conn, $query);
                                    mysqli_stmt_bind_param($stmt, "i", $product_id);
                                    mysqli_stmt_execute($stmt);
                                    $product = mysqli_stmt_get_result($stmt);
                                    $product = mysqli_fetch_assoc($product);
                                    // get product name and price
                                    $product_name = $product['p_name'];
                                    $price = $product['price'];
                                    // get order details
                                    $quantity = $row['quantity'];
                                    $order_date = $row['created_at'];
                                    $delivery_date = $row['deliverly_date'];
                                    $delivery_status = $row['delivery_status'];
                                    $payment_status = $row['payment_status'];
                                    // display orders
                                    echo "<tr>";
                                    echo "<td>{$id}</td>";
                                    echo "<td>{$customer}</td>";
                                    echo "<td>{$product_name}</td>";
                                    echo "<td>{$quantity}</td>";
                                    echo "<td>{$price}</td>";
                                    echo "<td>{$order_date}</td>";
                                    echo "<td>{$delivery_date}</td>";
                                    echo "<td>{$delivery_status}</td>";
                                    echo "<td>{$payment_status}</td>";
                                    echo "<td>";
                                    echo "<a href='edit_order.php?id={$id}' class='btn'>Edit</a>";
                                    echo "<a href='delete_order.php?id={$id}' class='btn'>Delete</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }

                            // if there are no orders
                            else {
                                echo "<tr>";
                                echo "<td colspan='10'>No orders found.</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
</body>

</html>