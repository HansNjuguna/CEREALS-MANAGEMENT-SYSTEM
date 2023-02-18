<?php
// start sission if not started
if (!isset($_SESSION)) {
    session_start();
}
// include dbh.php file
include 'dbh.php';

// sign_up 
if (isset($_POST['sign_up'])) {
    // get post form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // verify input
    $errors = [];
    // store submitted data in $b_data array
    $b_data = [
        'username' => $username,
        'email' => $email,
        'phone' => $phone,
        'password' => $password,
        'confirm_password' => $confirm_password
    ];
    if (empty($username)) {
        $errors['username'] = "Username is required";
    }
    if (empty($email)) {
        $errors['email'] = "Email is required";
    }
    if (empty($phone)) {
        $errors['phone'] = "Phone is required";
    }
    if (empty($password)) {
        $errors['password'] = "Password is required";
    }
    if (empty($confirm_password)) {
        $errors['confirm_password'] = "Confirm password is required";
    }
    if ($password !== $confirm_password) {
        $errors['confirm-password'] = "The two passwords do not match";
    }

    // if there are errors redirect to sign up page
    if (count($errors) > 0) {
        // redirect to sign up page with errors and submitted data
        $errors = json_encode($errors);
        $b_data = json_encode($b_data);
        header("Location: sign_up.php?errors=$errors&b_data=$b_data");
        exit();
    } else {
        // check if username, or email already exists
        $sql = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            // handle the error (e.g. log it, display an error message)
            echo "Error executing query: " . mysqli_error($conn);
            exit();
        }
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            $errors['username'] = "Username or email already exists";
            $errors = json_encode($errors);
            $b_data = json_encode($b_data);
            header("Location: sign_up.php?errors=$errors&b_data=$b_data");
            exit();
        } else {
            // hash password
            $password = password_hash($password, PASSWORD_DEFAULT);
            // insert data into database
            $sql1 = "INSERT INTO user (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$password')";
            $result = mysqli_query($conn, $sql1);
            if ($result) {
                // get user id and username from database and store in session
                $sql2 = "SELECT * FROM user WHERE username = '$username'";
                $result = mysqli_query($conn, $sql2);
                $row = mysqli_fetch_assoc($result);
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                // redirect to home page
                header("Location: home.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}

// login
if (isset($_POST['login'])) {
    // get post form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // verify input
    $errors = [];
    if (empty($username)) {
        $errors['username'] = "Username is required";
    }
    if (empty($password)) {
        $errors['password'] = "Password is required";
    }

    // if there are errors redirect to login page
    if (count($errors) > 0) {
        // redirect to login page with errors and submitted data
        $errors = json_encode($errors);
        header("Location: login.php?errors=$errors");
        exit();
    } else {
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            // handle the error (e.g. log it, display an error message)
            echo "Error executing query: " . mysqli_error($conn);
            exit();
        }
        $num_rows = mysqli_num_rows($result);
        if ($num_rows == 1) {
            // get user id and username from database and store in session
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];
            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                // redirect to home page
                header("Location: home.php");
                exit();
            }
        } else {
            $errors['username'] = "Username or password is incorrect";
            $errors = json_encode($errors);
            header("Location: login.php?errors=$errors");
            exit();
        }
    }
}
// save-product
if (isset($_POST['save-product'])) {

    // get post form data
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
    // $product_image = mysqli_real_escape_string($conn, $_POST['product_image']);
    $product_amount = mysqli_real_escape_string($conn, $_POST['product_amount']);
    $product_image = $_FILES['product_image']['name'];

    // verify input
    $errors = [];
    // store submitted data in $b_data array
    $b_data = [
        'product_name' => $product_name,
        'product_price' => $product_price,
        'product_description' => $product_description,
        'product_image' => $product_image,
        'product_amount' => $product_amount
    ];
    // echo $product_image;
    if (empty($product_name)) {
        $errors['product_name'] = "Product name is required";
    }
    if (empty($product_price)) {
        $errors['product_price'] = "Product price is required";
    }
    if (empty($product_description)) {
        $errors['product_description'] = "Product description is required";
    }
    if (empty($product_image)) {
        $errors['product_image'] = "Product image is required";
    }
    if (empty($product_amount)) {
        $errors['product_amount'] = "Product amount is required";
    }

    // if there are errors redirect to sign up page
    if (count($errors) > 0) {
        // redirect to sign up page with errors and submitted data
        $errors = json_encode($errors);
        $b_data = json_encode($b_data);
        header("Location: admin/add_product.php?errors=$errors&b_data=$b_data");
        exit();
    } else {
        // save image  to images folder
        $filename = $_FILES["product_image"]["name"];
        $tempname = $_FILES["product_image"]["tmp_name"];
        $folder = "assets/images/products/" . $filename;
        if (move_uploaded_file($tempname, $folder)) {
            echo "<h3>  Image uploaded successfully!</h3>";
        } else {
            echo "<h3>  Failed to upload image!</h3>";
        }

        // insert data into database
        $sql = "INSERT INTO product (p_name, p_description, p_amount, price, image) VALUES ('$product_name','$product_description','$product_amount', '$product_price',  '$product_image')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['message'] = "Product added successfully";
            // redirect to home page
            header("Location: admin/add_product.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

// admin-login
if (isset($_POST['admin-login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // verify input
    $errors = [];
    if (empty($username)) {
        $errors['username'] = "Username is required";
    }
    if (empty($password)) {
        $errors['password'] = "Password is required";
    }

    // if there are errors redirect to login page
    if (count($errors) > 0) {
        // redirect to login page with errors and submitted data
        $errors = json_encode($errors);
        header("Location: admin_login.php?errors=$errors");
        exit();
    } else {
        $sql = "SELECT * FROM user WHERE username = '$username' AND isadmin = 1";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            // handle the error (e.g. log it, display an error message)
            echo "Error executing query: " . mysqli_error($conn);
            exit();
        }
        $num_rows = mysqli_num_rows($result);
        if ($num_rows == 1) {
            // get user id and username from database and store in session
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];
            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                // redirect to home page
                header("Location: admin/dashboard.php");
                exit();
            }
        } else {
            $errors['username'] = "Username or password is incorrect";
            $errors = json_encode($errors);
            header("Location: admin_login.php?errors=$errors");
            exit();
        }
    }
}

// echo "hello world";
// edit-product
if (isset($_POST['edit-product'])) {
    // get post form data
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
    $product_image = $_FILES['product_image']['name'];
    $product_amount = mysqli_real_escape_string($conn, $_POST['product_amount']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    // verify input
    $errors = [];
    // store submitted data in $b_data array
    $b_data = [
        'product_name' => $product_name,
        'product_price' => $product_price,
        'product_description' => $product_description,
        'product_image' => $product_image,
        'product_amount' => $product_amount
    ];
    // echo $product_image;
    if (empty($product_name)) {
        $errors['product_name'] = "Product name is required";
    }
    if (empty($product_price)) {
        $errors['product_price'] = "Product price is required";
    }
    if (empty($product_description)) {
        $errors['product_description'] = "Product description is required";
    }
    if (empty($product_image)) {
        $errors['product_image'] = "Product image is required";
    }
    if (empty($product_amount)) {
        $errors['product_amount'] = "Product amount is required";
    }

    // if there are errors redirect to sign up page
    if (count($errors) > 0) {
        // redirect to sign up page with errors and submitted data
        $errors = json_encode($errors);
        $b_data = json_encode($b_data);
        header("Location: admin/product-edit.php?errors=$errors&b_data=$b_data&id=$id");
        exit();
    } else {
        // save image  to images folder
        $filename = $_FILES["product_image"]["name"];
        $tempname = $_FILES["product_image"]["tmp_name"];
        $folder = "assets/images/products/" . $filename;
        if (move_uploaded_file($tempname, $folder)) {
            echo "<h3>  Image uploaded successfully!</h3>";
        } else {
            echo "<h3>  Failed to upload image!</h3>";
        }

        // update product in the database
        $sql = "UPDATE product SET p_name = '$product_name', p_description = '$product_description', P_amount = '$product_amount', price = '$product_price', image = '$product_image' WHERE p_id = '$id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['message'] = "Product updated successfully";
            // redirect to home page
            header("Location: admin/product-edit.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
