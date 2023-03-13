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
                header("Location: index.php");
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
        // exit();
    } else {
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            // handle the error (e.g. log it, display an error message)
            echo "Error executing query: " . mysqli_error($conn);
            // exit();
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
                header("Location: index.php");
                // exit();
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

if (isset($_POST['admin-logins'])) {
    echo "admin login";
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
        $errors['password'] = "admin Password is required";
    }

    // if there are errors redirect to login page
    if (count($errors) > 0) {
        // redirect to login page with errors and submitted data
        $errors = json_encode($errors);
        header("Location: admin_login.php?errors=$errors");
        // exit();
    } else {
        $sql = "SELECT * FROM user WHERE username = '$username' AND isadmin = '1'";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            // handle the error (e.g. log it, display an error message)
            echo "Error executing query: " . mysqli_error($conn);
            // exit();
        }
        $num_rows = mysqli_num_rows($result);
        if ($num_rows == 1) {
            // get user id and username from database and store in session
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];
            if (password_verify($password, $hashed_password)) {
                echo "hello world";
                session_start();
                $_SESSION['admin_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                // redirect to home page
                header("Location: admin/dashboard.php");
                // exit();
            }
        } else {
            echo "hello world";
            $errors['username'] = "Username or password is incorrect";
            $errors = json_encode($errors);
            header("Location: admin_login.php?errors=$errors");
            // exit();
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
// update_profile
if (isset($_POST['update_profiles'])) {
    echo 'retrrererere';
}
if (isset($_POST['update_profile'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    // $password1 = mysqli_real_escape_string($conn, $_POST['password']);
    // $password2 = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $password1 = "none";
    $password2 = "none";

    $image = $_FILES['image']['name'];
    if (empty($password1) || empty($password2)) {
        $errors['password'] = "Password is required";
    } else {
        // if image is not empty upload image
        if (!empty($image)) {
            // save image  to images folder
            $filename = $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
            $folder = "assets/images/profiles/" . $filename;
            if (move_uploaded_file($tempname, $folder)) {
                // update user in the database
                $sql = "UPDATE user SET username = '$username', email = '$email', phone = '$phone', image = '$image' WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $_SESSION['msg_queue_exists'] = "User created successfully";
                    // redirect to home page
                    header("Location: admin/settings.php");
                    // exit();
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {

                echo "<h3>  Failed to upload image!</h3>";
            }
        } else {
            // update user in the database
            $sql1 = "UPDATE user SET username = '$username', email = '$email', phone = '$phone' WHERE username = '$username'";
            $result1 = mysqli_query($conn, $sql1);
            if ($result1) {
                $_SESSION['msg'] = "User details updated successfully";
                // redirect to home page
                header("Location: admin/settings.php");
                // exit();
            } else {
                echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
            }
        }
    }
}

// contact
if (isset($_POST['contact'])) {
    // get post form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    // verify input
    $errors = [];
    // store submitted data in $b_data array
    $b_data = [
        'name' => $name,
        'email' => $email,
        'user_type' => $user_type,
        'subject' => $subject,
        'message' => $message
    ];
    if (empty($name)) {
        $errors['name'] = "Name is required";
    }
    if (empty($email)) {
        $errors['email'] = "Email is required";
    }
    if (empty($user_type)) {
        $errors['user_type'] = "User type is required";
    }
    if (empty($subject)) {
        $errors['subject'] = "Subject is required";
    }
    if (empty($message)) {
        $errors['message'] = "Message is required";
    }
    // if there are errors redirect to sign up page
    if (count($errors) > 0) {
        // redirect to sign up page with errors and submitted data
        $errors = json_encode($errors);
        $b_data = json_encode($b_data);
        header("Location: contact.php?errors=$errors&b_data=$b_data");
        exit();
    } else {
        // save contact in the database
        $sql = "INSERT INTO contact (name, email, user_type, subject, message) VALUES ('$name', '$email', '$user_type', '$subject', '$message')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['message'] = "Message sent successfully";
            // redirect to home page
            header("Location: contact.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

// checkout
if (isset($_POST['checkout'])) {
    // get post form data
    $uid = $_SESSION['user_id'];
    $cart = mysqli_real_escape_string($conn, $_POST['cart']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $zip = mysqli_real_escape_string($conn, $_POST['zip']);
    // $country = mysqli_real_escape_string($conn, $_POST['country']);
    // $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    // $card_name = mysqli_real_escape_string($conn, $_POST['card_name']);
    // $card_number = mysqli_real_escape_string($conn, $_POST['card_number']);
    // $card_cvv = mysqli_real_escape_string($conn, $_POST['card_cvv']);
    // $card_expiry = mysqli_real_escape_string($conn, $_POST['card_expiry']);
    $total = mysqli_real_escape_string($conn, $_POST['total']);
    // verify input
    $errors = [];
    // store submitted data in $b_data array
    $b_data = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'city' => $city,
        'state' => $state,
        'zip' => $zip,
        'total' => $total
    ];
    if (empty($name)) {
        $errors['name'] = "Name is required";
    }
    if (empty($email)) {
        $errors['email'] = "Email is required";
    }
    if (empty($phone)) {
        $errors['phone'] = "Phone is required";
    }
    if (empty($address)) {
        $errors['address'] = "Address is required";
    }
    if (empty($city)) {
        $errors['city'] = "City is required";
    }
    if (empty($state)) {
        $errors['state'] = "State is required";
    }
    if (empty($zip)) {
        $errors['zip'] = "Zip is required";
    }

    if (empty($total)) {
        $errors['total'] = "Total is required";
    }
    // if there are errors redirect to checkout page
    if (count($errors) > 0) {
        // redirect to checkout page with errors and submitted data
        // $errors = json_encode($errors);
        // $b_data = json_encode($b_data);
        // loop trough errors and display them
        foreach ($errors as $key => $value) {
            echo $value;
        }
        /* header("Location: checkout.php?cart=$cart&errors=$errors&b_data=$b_data");
        exit(); */
    } else {
        // get product ids from cart
        $cart = $_SESSION['cart'];
        /* echo "<pre> ";
        print_r($cart);
        echo "</pre>"; */
        // loop through cart and save order in the database
        foreach ($cart as $key => $value) {
            $pid = $value->id;
            $qty = $value->quantity;
            // save order in the database
            $sql = "INSERT INTO orders (user_id, product_id, quantity, total) VALUES ('$uid', '$pid', '$qty', '$total')";
            $result = mysqli_query($conn, $sql);
            // if result is true save cart in the database
            if ($result) {
                $sql1 = "INSERT INTO cart (user_id, name, email, phone, address, city, state, zip) VALUES ('$uid', '$name', '$email', '$phone', '$address', '$city', '$state', '$zip')";
                $result1 = mysqli_query($conn, $sql1);
                if ($result1) {
                    $_SESSION['message'] = "Order placed successfully";
                    // redirect to home page

                } else {
                    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        echo "success";
    }
}

if (isset($_POST['msg-submit'])) {
    $uid = $_SESSION['user_id'];
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $errors = [];
    if (empty($message)) {
        $errors['message'] = "Message is required";
    }
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header("Location: messages.php");
    } else {
        // check if a file was submitted
        if (isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])) {
            print_r($_FILES['file']['name']);
            // get file details
            $file = $_FILES['file'];
            // file properties
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $file_size = $file['size'];
            $file_error = $file['error'];
            // work out the file extension
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));
            // allowed file extensions
            $allowed = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'];
            // check if file extension is allowed
            if (in_array($file_ext, $allowed)) {
                // check for any errors
                if ($file_error === 0) {
                    // check file size
                    if ($file_size <= 2097152) {
                        // create unique file name
                        $file_name_new = uniqid('', true) . '.' . $file_ext;
                        // file destination
                        $file_destination = 'assets/images/attachments/' . $file_name_new;
                        // upload file
                        if (move_uploaded_file($file_tmp, $file_destination)) {
                            // save message in the database
                            $sql = "INSERT INTO messages (uid, message, attachments) VALUES ('$uid', '$message', '$file_destination')";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                $_SESSION['message'] = "Message sent successfully";
                                // redirect to home page
                                header("Location: messages.php");
                                exit();
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }
                        }
                    } else {
                        echo "File size is too big";
                    }
                } else {
                    echo "There was an error uploading your file";
                }
            } else {
                echo "File type is not allowed";
            }
        } else {
            // save message in the database
            $sql = "INSERT INTO messages (uid, message) VALUES ('$uid', '$message')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $_SESSION['message'] = "Message sent successfully";
                // redirect to home page
                header("Location: messages.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}
