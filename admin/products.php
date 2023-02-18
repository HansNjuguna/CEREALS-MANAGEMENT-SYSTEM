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
            width: 25vw;
            height: 100vh;
            background: #2c3e50;
            color: #fff;
        }

        .right {
            width: 75vw;
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
            display: flex;
            flex-wrap: wrap;
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background: #f4f4f4;
            border-radius: 0px 0px 10px 10px;
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

        table {
            width: 70vw;
            border-collapse: collapse;
            overflow-x: hidden;
        }

        tr,
        td,
        th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #3498db;
            color: white;
            max-width: 25%;
        }

        td a {
            color: #2c3e50;
            display: flex;
            flex-direction: column;
        }
    </style> -->
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
            <h1>Products</h1>
            <div class="content">
                <!-- add product btn -->
                <button class="btn"><a href="add_product.php">Add a product</a> </button>
                <div class="content">
                    <h2>Products listing</h2>
                    <!-- list products in table format -->
                    <?php
                    // if $_SESSION['success'] is set
                    if (isset($_SESSION['message'])) {
                        echo "<div class='success'>" . $_SESSION['message'] . "</div>";
                        unset($_SESSION['message']);
                    }
                    ?>
                    <table>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Product Image</th>
                            <!-- <th>Product Description</th> -->
                            <th>Product Date</th>
                            <th>Product Action</th>
                        </tr>
                        <?php
                        // include database connection
                        include '../dbh.php';
                        // select all data
                        $query = "SELECT p_id, p_name, p_description, p_amount, price, image, created_at FROM product ORDER BY p_id DESC";
                        $result = mysqli_query($conn, $query);
                        if (!$result) {
                            // handle the error (e.g. log it, display an error message)
                            echo "Error executing query: " . mysqli_error($conn);
                            exit();
                        }
                        // if records found
                        $num_rows = mysqli_num_rows($result);
                        if ($num_rows > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['p_id'] . "</td>";
                                echo "<td>" . $row['p_name'] . "</td>";
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td>" . $row['image'] . "</td>";
                                // echo "<td>" . $row['p_description'] . "</td>";
                                echo "<td>" . $row['created_at'] . "</td>";
                                echo "<td>";
                                echo "<a href='product-edit.php?id={$row['p_id']}' class='btn btn-primary left-margin'>Edit</a>";
                                echo "<a delete-id='{$row['p_id']}' class='btn btn-danger delete-object' >Delete</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                        // if no records found
                        else {
                            echo "<div class='alert alert-danger'>No records found.</div>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '.delete-object', function() {
            console.log("clicked");

            var id = $(this).attr('delete-id');

            if (confirm('Are you sure to delete this product?')) {

                $.post('delete.php', {
                    object_id: id
                }, function(data) {
                    location.reload();
                }).fail(function() {
                    alert("error");
                });
            }
            return false;
        });
    </script>
</body>

</html>