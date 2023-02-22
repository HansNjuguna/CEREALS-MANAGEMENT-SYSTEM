<?php
if (!isset($_SESSION)) {
    session_start();
}
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
    <title>Cereals Order system</title>
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="img">
                <img src="./assets/images/ceals_icon_2.jpg" alt="logo" width="90px " height="90px">
            </div>
            <div class="par">
                <p>Product name: </p>
                <p>Product price: </p>
                <p>Product description: </p>
                <p>Product quantity: </p>
                <p>Product total price: </p>
                <button type="submit">Purchase</button>
            </div>
        </div>
    </div>
</body>

</html>