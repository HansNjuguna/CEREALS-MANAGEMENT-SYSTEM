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
// select logged-in users details
$username = $_SESSION['username'];
// $userid = $_SESSION['user_id'];
/* echo $username;
echo $userid; */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin dashboard</title>
    <link rel="stylesheet" href="style.css">
    <!-- <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: #34495e;
            box-sizing: border-box;
        }

        .container {
            display: flex;
            flex-direction: row;
        }

        .left {
            width: 25%;
            height: 100vh;
            background: #2c3e50;
            color: #fff;
        }

        .right {
            width: 75%;
            height: 100vh;
            background: #ecf0f1;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            padding: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
        }

        a {
            text-decoration: none;
            color: #fff;
        }

        a:hover {
            color: #3498db;
        }

        h1 {
            text-align: center;
            color: #fff;
            padding: 20px;

        }

        .content {
            width: 90%;
            margin: 0 auto;
        }

        .right h1 {
            color: #000 !important;
        }

        .card {
            width: 200px;
            height: 150px;
            background: #fff;
            margin: 10px;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .card h2 {
            margin: 0;
            padding: 0;
            font-size: 20px;
        }

        .card p {
            margin: 0;
            padding: 20px 0px;
            font-size: 20px;
        }

        button {
            background: #3498db;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        button a:hover {
            color: #fff;
        }

        form {
            width: 75%;
            margin: 0 auto;
        }

        .form-group {
            margin: 10px 0px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input:focus {
            outline: #3498db;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .danger {
            color: red;
        }

        .success {
            color: green;
        }
    </style> -->
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
            <h1>Edit Product</h1>
            <div class="content">
                <!-- add product btn -->
                <!-- <button class="btn"><a href="add_product.php">Add a product</a> </button> -->
                <div class="product">
                    <!-- add product form -->
                    <form action="../reg_exe.php" method="POST" enctype="multipart/form-data">
                        <?php
                        include "../dbh.php";
                        if (isset($_GET['errors'])) {
                            $errors = json_decode($_GET['errors'], true);
                            foreach ($errors as $key => $value) {
                                echo "<div class='danger'>$value</div>";
                            }

                            $b_data = json_decode($_GET['b_data'], true);
                        }
                        // if $_SESSION['success'] is set
                        if (isset($_SESSION['message'])) {
                            echo "<div class='success'>" . $_SESSION['message'] . "</div>";
                            unset($_SESSION['message']);
                        }

                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $sql = "SELECT * FROM product WHERE p_id = $id";
                            $result = mysqli_query($conn, $sql);
                            $tot = mysqli_num_rows($result);
                            if ($tot > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $p_name = $row['p_name'];
                                $p_description = $row['p_description'];
                                $p_price = $row['price'];
                                $p_amount = $row['P_amount'];
                                $image = $row['image'];
                                $id = $row['p_id'];

                        ?>
                                <!-- product name -->
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" name="product_name" id="product_name" placeholder="Enter product name" value="<?php echo $p_name; ?>">
                                </div>
                                <!-- product description -->
                                <div class="form-group">
                                    <label for="product_description">Product Description</label>
                                    <input type="text" name="product_description" id="product_description" placeholder="Enter product description" value="<?php echo $p_name; ?>">
                                    <!-- <textarea name="product_description" id="product_description" cols="30" rows="10" placeholder="Enter product description" value="<?php echo $p_name; ?>"></textarea>
                                </div> -->
                                    <!-- product price -->
                                    <div class="form-group">
                                        <label for="product_price">Product Price</label>
                                        <input type="number" name="product_price" id="product_price" placeholder="Enter product price" value="<?php echo $p_price; ?>">
                                    </div>
                                    <!-- product amount -->
                                    <div class="form-group">
                                        <label for="product_amount">Product Amount</label>
                                        <input type="number" name="product_amount" id="product_amount" placeholder="Enter product amount" value="<?php echo $p_amount; ?>">
                                    </div>
                                    <!-- product image -->
                                    <div class="form-group">
                                        <label for="product_image">Product Image</label>
                                        <input type="file" name="product_image" id="product_image" placeholder="Enter product image" value="assets/images/products/<?php echo $image; ?>">
                                    </div>
                                    <!-- submit btn -->
                                    <button type="submit" name="edit-product">Save product</button>
                    </form>
            <?php
                            }
                        } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>