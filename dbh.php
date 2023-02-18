<?php
$server = "localhost";
$db = "cereals_management_system";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($server, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
