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
    <title>admin settings</title>
    <link rel="stylesheet" href="style.css?v=<?php echo rand(); ?>">
    <style>

    </style>
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
            <h1>Settings</h1>
            <div class="content">
                <!-- add product btn -->
                <!-- <button class="btn"><a href="add_product.php">Add a product</a> </button> -->
                <div class="content">
                    <?php
                    include '../dbh.php';
                    $username = $_SESSION['username'];
                    $sql = "SELECT * FROM user WHERE username = '$username'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $email = $row['email'];
                    $phone = $row['phone'];
                    $image = $row['image'];
                    if ($image == "") {
                        $image = "default_profile.jpg";
                    }
                    ?>
                    <!-- admin profile settings -->
                    <div class="admin-profile">
                        <h3>Update your Profile</h3>
                        <div class="admin-profile-content">
                            <!-- form to update profile -->
                            <form action="../reg_exe.php" method="post" enctype="multipart/form-data">
                                <?php
                                if (isset($_SESSION['msg'])) {
                                    echo $_SESSION['msg'];
                                    // unset($_SESSION['msg']);
                                }
                                ?>
                                <!-- username -->
                                <div class="form-control">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" value="<?php echo $username; ?>">
                                </div>
                                <!-- email -->
                                <div class="form-control">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" value="<?php echo $email; ?>">
                                </div>
                                <!-- phone -->
                                <div class="form-control">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>">
                                </div>
                                <!-- password -->
                                <div class="form-control">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" disabled>
                                </div>
                                <!-- confirm password -->
                                <div class="form-control">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" name="confirm_password" id="confirm_password" disabled>
                                </div>
                                <!-- image preview -->
                                <div class="form-control preview">
                                    <label for="image">Profile Image</label>
                                    <img src="../assets/images/profiles/<?php echo $image; ?>" id="profile_pic_preview" alt="<?php echo $username; ?> image" width="100px">
                                </div>
                                <!-- <div class="">
                                    <img id="profile_pic_preview" src="../Resources/images/profile/<?php echo $image; ?>">
                                </div> -->
                                <!-- image -->
                                <div class="form-control">
                                    <label for="image">Profile Image</label>
                                    <input type="file" name="image" id="image" onchange="showPreview(event);">
                                </div>
                                <!-- submit -->
                                <div class="form-control">
                                    <input type="submit" name="update_profile">
                                </div>

                            </form>

                            <!-- <div class="admin-profile-img">
                                <img src="../assets/images/profiles/<?php echo $image; ?>" alt="<?php echo $username; ?> image">
                            </div>
                            <div class="admin-profile-info">
                                <p>Username: <span><?php echo $username; ?></span></p>
                                <p>Email: <span><?php echo $email; ?></span></p>
                                <p>Admin Phone: <span><?php echo $image; ?></span></p>
                                <p>Password: <span>Colombo</span></p>
                                <button class="btn"><a href="edit_admin_profile.php">Update Profile</a></button>
                            </div> -->
                        </div>
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
            // edit_profile_pic preview
            function showPreview(event) {
                if (event.target.files.length > 0) {
                    var src = URL.createObjectURL(event.target.files[0]);
                    var preview = document.getElementById("profile_pic_preview");
                    preview.src = src;
                    preview.style.display = "block";
                }
            }
            // load available profile pic to profile_pic_preview
            $(function() {
                var src = $('#profile_pic_preview').attr('src');
                if (src == '') {
                    $('#profile_pic_preview').attr('src', '../images/profile_pics/default.png');
                }
            });
        </script>
</body>

</html>