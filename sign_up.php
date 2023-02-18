<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 16px;
            background: rgb(186, 185, 185);
            background: linear-gradient(90deg, rgba(186, 185, 185, 1) 0%, rgba(98, 98, 210, 1) 99%);
        }

        h1 {
            text-align: center;
            color: #fff;
            padding: 20px;
            background: #4CAF50;
            border-radius: 10px 10px 0px 0px;
            width: 50%;
            margin: 0 auto;
        }

        form {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background: #f4f4f4;
            border-radius: 0px 0px 10px 10px;
        }

        .form-control {
            margin-bottom: 10px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        input {
            width: 80%;
            padding: 10px;
            float: left;
        }

        label {
            padding: 10px;
            float: left;
        }

        input:focus {
            outline: 1px solid blue !important;
            transition: .35s ease-in-out;
        }

        button {
            width: 80%;
            padding: 10px;
            float: left;
            background: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #45a049;
        }

        .danger {
            color: red;
        }
    </style>
</head>

<body>
    <h1><b>CMS</b> Sign Up</h1>
    <form action="reg_exe.php" method="POST">
        <?php
        if (isset($_GET['errors'])) {
            $errors = json_decode($_GET['errors'], true);
            foreach ($errors as $key => $value) {
                echo "<div class='danger'>$value</div>";
            }

            $b_data = json_decode($_GET['b_data'], true);
        }
        ?>
        <!-- username -->
        <div class="form-control">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php
                                                                    if (isset($b_data['username'])) {
                                                                        echo $b_data['username'];
                                                                    }
                                                                    ?>">
        </div>
        <div class="form-control">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="
            <?php
            if (isset($b_data['email'])) {
                echo $b_data['email'];
            } ?>
            ">
        </div>
        <!-- phone no -->
        <div class="form-control">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php
                                                                if (isset($b_data['phone'])) {
                                                                    echo $b_data['phone'];
                                                                } ?>">
        </div>
        <div class="form-control">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
        </div>
        <div class="form-control">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password">
        </div>
        <div class="form-control">
            <button class="btn" type="submit" name="sign_up">Sign up</button>
        </div>
        <!-- already registered? -->
        <div class="form-control">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>

    </form>
</body>

</html>