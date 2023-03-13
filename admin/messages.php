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
            overflow-y: scroll;
            background: #fff;
            padding: 20px 10px;
            overflow-x: hidden;
        }

        .mheader ul li a {
            color: #000;
        }

        .mheader ul li a:hover {
            color: #3498db;
        }

        .mbody h3 {
            color: #000;
        }

        .mbody p {
            color: #000;
        }

        .mbody form {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .mbody input[type="text"] {
            width: 90%;
            height: 40px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            position: absolute;
            bottom: 45px;

        }

        .mbody input[type="submit"] {
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
                            $sql = "SELECT * FROM messages";
                            $result = mysqli_query($conn, $sql);
                            $tot = mysqli_num_rows($result);
                            if ($tot > 0) {
                                // check if a message has replies or not
                                while ($tot > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $id = $row['id'];
                                    $sql1 = "SELECT * FROM replies WHERE message_id = '$id'";
                                    $result2 = mysqli_query($conn, $sql1);
                                    $tot2 = mysqli_num_rows($result2);
                                    if ($tot2 > 0) {
                                        echo '<li><a href="#" class="pmessage" id="' . $row['id'] . '">' . $row['name'] . '(' . $row['user_type'] . ')</a></li>';
                                    } else {
                                        echo '<li><a href="#" class="active pmessage" id="' . $row['id'] . '">' . $row['name'] . '(' . $row['user_type'] . ')</a></li>';
                                    }
                                    $tot--;
                                }
                            }
                            ?>
                            <!-- <li><a href="#">Message1</a></li>
                            <li><a href="#">Message2</a></li>
                            <li><a href="#">Message3</a></li> -->
                        </ul>
                    </div>
                    <div class="mbody">
                        <h3>Message Subject</h3>
                        <h4>Message sender email</h4>
                        <div class="message" id="message">
                            <p class="init">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni dolorem consectetur iure commodi beatae tempora quae atque! Magnam aut quam laborum suscipit illum nemo neque, dolore autem, repudiandae omnis corrupti?
                            </p>
                            <p class="nxt">
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni dolorem consectetur iure commodi beatae tempora quae atque! Magnam aut quam laborum suscipit illum nemo neque, dolore autem, repudiandae omnis corrupti?
                            </p>
                        </div>

                        <!-- send message input -->
                        <form action="" method="post">
                            <input type="text" name="message" id="message" placeholder="send message">
                            <input type="submit" name="send" value="send">
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

            // pmessage on click load message
            $('.pmessage').click(function() {
                // get id of message
                var id = $(this).attr('id');
                console.log(id);
                // pass id to ajax request
                $.ajax({
                    url: "load-message.php",
                    method: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        // load message in message div
                        $('#message').html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>