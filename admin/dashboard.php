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
            display: flex;
            flex-wrap: wrap;
            width: 90%;
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
            <?php
            include '../dbh.php';
            $sql = "SELECT * FROM product";
            $result = mysqli_query($conn, $sql);
            $products = mysqli_num_rows($result);
            $sql1 = "SELECT * FROM user";
            $result1 = mysqli_query($conn, $sql1);
            $users = mysqli_num_rows($result1);
            // echo $users;
            ?>
            <h1>Dashboard</h1>
            <div class="content">
                <div class="card">
                    <h2>Products</h2>
                    <p><?php echo $products; ?></p>
                </div>
                <!-- bought products -->
                <div class="card">
                    <h2>Bought Products</h2>
                    <p>0</p>
                </div>
                <!-- users -->
                <div class="card">
                    <h2>Users</h2>
                    <p><?php echo $users; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>