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
include '../dbh.php';
// check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // get the object id from the request
    $id = $_POST['object_id'];

    // delete the object from the database
    $query = "DELETE FROM product WHERE p_id = $id";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        $_SESSION['message'] = 'Error executing query: ' . mysqli_error($conn);
        // handle the error (e.g. log it, display an error message)
        echo "Error executing query: " . mysqli_error($conn);
        exit();
    } else {
        $_SESSION['message'] = 'Products deleted successfully.';
        // redirect to the read page
        header('Location: products.php');
    }

    /*  // send a response to the client
    echo 'Object deleted successfully.'; */
}
