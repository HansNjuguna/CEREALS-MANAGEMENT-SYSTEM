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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS - profile</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: #34495e;
            box-sizing: border-box;
            font-size: 16px;
        }

        .container {
            display: flex;
            flex-direction: row;
        }

        .profile {
            width: 75%;
            margin: auto;
            height: 100vh;
            background: #ecf0f1;
        }

        form {
            width: 50%;
            margin: auto;
        }

        .form-control {
            display: flex;
            flex-direction: column;
            margin: 10px 0;
        }

        .form-control label {
            margin-bottom: 5px;
        }

        .form-control input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-control input:focus {
            outline: none;
            border: 1px solid #3498db;
        }

        h3 {
            text-align: center;
        }

        .error {
            align-items: center;
            color: red;
            font-size: 1.2rem;
        }

        .success {
            text-align: center;
            color: green;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <?php
    include 'dbh.php';

    if (isset($_POST['update-details'])) {
        $username = $_SESSION['username'];
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
        $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        $sql1 = "SELECT * FROM user WHERE username = '$username'";
        $result1 = mysqli_query($conn, $sql1);
        $tot1 = mysqli_num_rows($result1);
        if ($tot1 == 1) {
            $row1 = mysqli_fetch_assoc($result1);
            $db_password = $row1['password'];
            $id = $row1['id'];
        }

        // check if old password is correct using verify function
        $check = password_verify($old_password, $db_password);
        if ($check == false) {
            echo "<span class='error'>Old password is incorrect</span>";
        } else if ($check == true) {
            if ($new_password != $confirm_password) {
                echo "<span class='error'>New password and confirm password do not match</span>";
            } else {
                // hash the password
                $hash = password_hash($new_password, PASSWORD_DEFAULT);
                $sql2 = "UPDATE user SET email = '$email', password = '$hash' WHERE id = '$id'";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2) {
                    echo "<span class='success'>Profile updated</span>";
                } else {
                    echo "<span class='error'>Profile not updated</span>";
                }
            }
        }
    }
    ?>
    <div class="container">
        <div class="profile">
            <h3>Edit your profile</h3>
            <form action="" method="POST">
                <?php
                include 'dbh.php';

                $username = $_SESSION['username'];
                // echo $username;
                // unset($_SESSION['username']);
                $sql = "SELECT * FROM user WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                $tot = mysqli_num_rows($result);
                // print_r($result);
                if ($tot == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $email = $row['email'];
                }
                ?>
                <!-- email -->
                <div class="form-control">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo $email; ?>" placeholder="Enter your email">
                </div>
                <!-- old password -->
                <div class="form-control">
                    <label for="old_password">Old Password</label>
                    <input type="password" name="old_password" id="old_password" placeholder="Enter your old password">
                </div>
                <!-- new password -->
                <div class="form-control">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" placeholder="Enter your new password">
                </div>
                <!-- confirm password -->
                <div class="form-control">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your new password">
                </div>
                <!-- submit -->
                <div class="form-control">
                    <input type="submit" name="update-details" value="Update">
                </div>
            </form>
        </div>
    </div>
</body>

</html>