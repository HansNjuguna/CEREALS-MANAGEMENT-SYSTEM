<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(./assets/images/kristaps-ungurs-SI7BhmpahNM-unsplash.jpg);
        }

        .Administrator {
            width: 400px;
            margin: 0 auto;
            text-align: center;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
        }

        h1 {
            margin-top: 0;
            font-size: 36px;
            color: #333;
        }

        form {
            margin-top: 50px;
        }

        .form-input {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            border: none;
            border-bottom: 2px solid #333;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        .danger {
            color: red;
        }
    </style>
</head>

<body>
    <div class="Administrator">
        <h1>Admin Login</h1>
        <form action="reg_exe.php" method="POST">
            <?php
            if (isset($_GET['errors'])) {
                $errors = json_decode($_GET['errors'], true);
                foreach ($errors as $key => $value) {
                    echo "<div class='danger'>$value</div>";
                }
            }
            ?>
            <div class="form-input">
                <input type="text" name="username" placeholder="Enter your username">
            </div>
            <div class="form-input">
                <input type="password" name="password" placeholder="Enter your password">
            </div>
            <input type="submit" name="admin-login" value="Submit">
        </form>
    </div>
    <script>

    </script>
</body>

</html>