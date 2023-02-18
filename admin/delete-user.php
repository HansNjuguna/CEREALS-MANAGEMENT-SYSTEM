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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['object_id'];

    // delete user
    $sql = "DELETE FROM user WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        // handle the error (e.g. log it, display an error message)
        echo "Error executing query: " . mysqli_error($conn);
        $_SESSION['message'] = "User was not deleted.";
        exit();
    } else {
        $_SESSION['message'] = "User was deleted.";
        header("Location: users.php");
        exit();
    }
}
