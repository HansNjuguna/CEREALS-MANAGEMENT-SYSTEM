<?php
// start sission if not started
if (!isset($_SESSION)) {
    session_start();
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['username']) && !isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
// var_dump($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin dashboard</title>
    <link rel="stylesheet" href="style.css">

    <style>
        .content {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background: #f4f4f4;
            border-radius: 0px 0px 10px 10px;
        }

        .mheader {
            width: 25%;
            min-height: 80vh;
            height: 100%;
            background: #fff;
            border-right: 1px solid #ddd;
        }

        .mbody {
            width: 70%;
            height: 100%;
            min-height: 80vh;
            max-height: 80vh;

            background: #fff;
            padding: 20px 10px;
            overflow-x: hidden;
        }

        .mheader ul li a {
            display: flex;
            align-items: center;
            font-size: 18px;
            color: #000;
            cursor: pointer;
        }

        .mheader ul li a:hover {
            color: #3498db;
        }

        .mheader img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            border-radius: 50%;
        }

        .mbody h3 {
            color: #000;
        }

        .mbody p {
            color: #000;
        }

        .mbody form {
            width: 80%;
            height: 35%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .mbody-x textarea,
        .mbody-x .attach {
            width: 90%;
            height: 40px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            position: absolute;
            bottom: 45px;

        }

        .mbody-x input[type="submit"] {
            width: 100%;
            height: 40px;
            border: none;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            background: #3498db;
            color: #fff;
            cursor: pointer;
            position: absolute;
            bottom: 0;
        }

        .mbody .message {
            height: 65%;
            overflow-y: scroll;
        }

        .active {
            font-weight: bolder;
        }

        .init {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            height: 100%;
            width: 75%;
            background: #fff;
        }

        .nxt {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: flex-end;
            /* text-align: end; */
            height: 100%;
            width: 75%;
            margin-left: 25%;
            /* background: #dbdbdb; */
        }

        .messages {
            width: 70%;
            height: 100%;
            overflow-y: scroll;
            margin: auto;
            min-height: 100vh;
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .messages-container {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .message {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .other,
        .self {
            width: 70%;
            padding: 10px;
            margin: 10px 0;
        }

        .other a,
        .self a {
            color: #3498db;
        }

        .other {
            background-color: #f1f0f0;
            border-radius: 10px 10px 0 10px;
            align-self: flex-start;
        }

        .self {
            background-color: #e2f3f5;
            border-radius: 10px 10px 10px 0;
            align-self: flex-end;
        }

        .messages-container form {
            width: 100%;
            /* height: 100px; */
            display: flex;
            flex-direction: column;
            /* justify-content: space-between; */
            /* position: absolute;
            bottom: 0;*/
        }

        .messages-container form textarea {
            width: 90%;
            padding: 10px;
        }

        .messages-container form button {
            padding: 10px;
            background-color: #e2f3f5;
            margin: 10px 0;
        }

        .messages-container form button:hover {
            background-color: #f1f0f0;
        }

        .attach {
            width: 100%;
            height: 40px;
            margin: 10px 0;
        }
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
            <h1>Messages</h1>
            <div class="content">
                <div class="content">
                    <div class="mheader">
                        <h3>Messages preview</h3>
                        <ul>
                            <?php
                            include '../dbh.php';
                            $sql = "SELECT DISTINCT uid FROM messages";
                            $result = mysqli_query($conn, $sql);
                            $tot = mysqli_num_rows($result);
                            if ($tot > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // get user id
                                    $id = $row['uid'];
                                    // echo $id;
                                    // get user name from user table
                                    $sql2 = "SELECT * FROM user WHERE id = '$id'";
                                    $result2 = mysqli_query($conn, $sql2);
                                    $row2 = mysqli_fetch_assoc($result2);
                                    $name = $row2['username'];
                                    $image = $row2['image'];
                                    if ($image == "") {
                                        $image = "default_profile.jpg";
                                    }
                                    echo "<li><a  class='msg-fetch' id='" . $row['uid'] . "'><img src='../assets/images/profiles/" . $image . "' alt='" . $name . "'> " . $name . "</a></li>";
                                }
                            }
                            ?>
                            <!-- <li><a href="#">Message1</a></li>
                            <li><a href="#">Message2</a></li>
                            <li><a href="#">Message3</a></li> -->
                        </ul>
                    </div>
                    <div class="mbody">
                        <!-- <?php echo $_SESSION['user_id']; ?> -->
                        <h3>Choose a conversation to view</h3>
                        <!-- <h3>Message Subject</h3>
                        <h4>Message sender email</h4> -->
                        <div class="message" id="message-data">
                            <!--<p class="init">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni dolorem consectetur iure commodi beatae tempora quae atque! Magnam aut quam laborum suscipit illum nemo neque, dolore autem, repudiandae omnis corrupti?
                            </p>
                            <p class="nxt">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni dolorem consectetur iure commodi beatae tempora quae atque! Magnam aut quam laborum suscipit illum nemo neque, dolore autem, repudiandae omnis corrupti?
                            </p>-->
                        </div>

                        <!-- send message input -->
                        <!-- <form action="../reg_exe.php" method="post">
                            <input type="text" name="message" id="message" placeholder="send message">
                            <input type="submit" name="msg-submit" class="admin-send" value="send">
                        </form> -->
                        <form action="../reg_exe.php" method="post" enctype="multipart/form-data">
                            <textarea name="message" id="message" cols="30" rows="4" placeholder="Type amessage"></textarea>
                            <input type="hidden" name="id" id="sender-id" value="">
                            <!-- attach files -->
                            <div class="attach">
                                <input type="file" name="file" id="file">
                                <label for="file">Attach file</label>
                            </div>
                            <button type="submit" name="msg-submit">Send</button>
                        </form>
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
        // pmessage on click load message
        $('.msg-fetch').click(function() {
            // get id of message
            var id = $(this).attr('id');
            // console.log(id);
            // set id in hidden input
            $('#sender-id').val(id);
            // pass id to ajax request
            $.ajax({
                url: "load-message.php",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    // load message in message div
                    $('#message-data').html(data);
                }
            });
        });
    </script>
</body>

</html>