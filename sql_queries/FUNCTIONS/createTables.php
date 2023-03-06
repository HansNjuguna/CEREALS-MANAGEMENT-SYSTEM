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
// create contact table
$sql2 = "CREATE TABLE IF NOT EXISTS contact (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    user_type VARCHAR(50) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message VARCHAR(255) NOT NULL,
    status TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
// replies table
$sql3 = "CREATE TABLE IF NOT EXISTS replies (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    message_id INT(11) NOT NULL,
    reply VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
// orders table
$sql4 = "CREATE TABLE IF NOT EXISTS orders (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    product_id INT(11) NOT NULL,
    quantity INT(11) NOT NULL,
    total FLOAT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
// create cart table
$sql5 = "CREATE TABLE IF NOT EXISTS cart (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone VARCHAR(25) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(50) NOT NULL,
    state VARCHAR(50) NOT NULL,
    zip VARCHAR(50) NOT NULL,
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
// $statements[] = $sql;
// $statements[] = $sql1;
// $statements[] = $sql2;
// $statements[] = $sql3;
$statements[] = $sql4;
$statements[] = $sql5;
foreach ($statements as $s) {
    // echo $s;
    $sql = $s;
    $database = new CreateDb("cereals_management_system", "test", $sql);
}
// success message if the table is created
// echo "Table is created or already exists.";

// $database = new CreateDb("Productdb", "student", $sql);