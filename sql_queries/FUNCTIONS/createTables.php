<?php
require_once 'CreateDb.php';

// create instance of Createdb class
// $database = new CreateDb("Productdb", "Producttb");

/* $sql = "DROP TABLE IF EXISTS student;
"; */
$statements = [];
// create user table
$sql = "CREATE TABLE IF NOT EXISTS user (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone VARCHAR(25) NOT NULL,
    password VARCHAR(255) NOT NULL,
    isadmin TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
// create product table
$sql1 = "CREATE TABLE IF NOT EXISTS product (
    p_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    p_name VARCHAR(50) NOT NULL,
    p_description VARCHAR(255) NOT NULL,
    P_amount INT(11) NOT NULL,
    price FLOAT NOT NULL,
    image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
/* $sql1 = "CREATE TABLE IF NOT EXISTS student1 (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(25) NOT NULL
)";
$sql2 = "CREATE TABLE IF NOT EXISTS student22 (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(25) NOT NULL
)";
$sql3 = "CREATE TABLE IF NOT EXISTS student3 (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(25) NOT NULL
)";
$sql4 = "CREATE TABLE IF NOT EXISTS student45 (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(25) NOT NULL
)";

$statements[] = $sql1;
$statements[] =  $sql2;
$statements[] =  $sql3;
$statements[] =  $sql4; */
// print_r($statements);
$statements[] = $sql;
$statements[] = $sql1;
foreach ($statements as $s) {
    // echo $s;
    $sql = $s;
    $database = new CreateDb("cereals_management_system", "test", $sql);
}
// success message if the table is created
// echo "Table is created or already exists.";

// $database = new CreateDb("Productdb", "student", $sql);