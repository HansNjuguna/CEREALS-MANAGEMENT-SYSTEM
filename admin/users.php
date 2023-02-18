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
                            <th>User ID</th>
                            <th>Username</th>
                            <th>User email</th>
                            <th>User phone</th>
                            <th>is admin</th>
                            <th>Product Action</th>
                        </tr>
                        <?php
                        // include database connection
                        include '../dbh.php';
                        // select all users
                        $query = "SELECT * FROM user order by isadmin desc";
                        $result = mysqli_query($conn, $query);
                        // if there are users
                        $tot = mysqli_num_rows($result);
                        if ($tot > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $isadmin = $row['isadmin'];
                                if ($isadmin == 0) {
                                    $isadmin = "No";
                                } else {
                                    $isadmin = "Yes";
                                }
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['phone'] . "</td>";
                                echo "<td>" . $isadmin . "</td>";
                                echo "<td>";
                                //delete buttons
                                echo "<a delete-id='{$row['id']}' class='btn btn-danger delete-object'>";
                                echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                                echo "</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>No users found.</div>";
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
            console.log(id);

            if (confirm('Are you sure to delete this user account?')) {

                $.post('delete-user.php', {
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