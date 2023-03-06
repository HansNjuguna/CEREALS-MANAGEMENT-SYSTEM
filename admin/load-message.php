<?php
// include database connection
include_once '../dbh.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM contact WHERE id = '$id'";
}
