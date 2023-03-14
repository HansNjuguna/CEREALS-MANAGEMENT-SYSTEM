<?php
// include database connection
include '../dbh.php';

// retrieve orders data
$query = "SELECT * FROM orders";
$result = mysqli_query($conn, $query);

// create a file pointer connected to the output stream
$fp = fopen('php://output', 'w');

// write the headers row to the CSV file
$headers = array('Order ID', 'Customer', 'Product', 'Quantity', 'Price', 'Order Date', 'Delivery Date', 'Delivery Status', 'Payment Status');
fputcsv($fp, $headers);

// loop through the orders data and write each row to the CSV file
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $user_id = $row['user_id'];
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
    $order_date = $row['created_at'];
    $delivery_date = $row['deliverly_date'];
    $delivery_status = $row['delivery_status'];
    $payment_status = $row['payment_status'];

    // retrieve user and product data
    $query = "SELECT username FROM user WHERE id = $user_id";
    $user_result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($user_result);
    $customer = $user['username'];
    $query = "SELECT p_name, price FROM product WHERE p_id = $product_id";
    $product_result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($product_result);
    $product_name = $product['p_name'];
    $price = $product['price'];

    // write the row to the CSV file
    $row_data = array($id, $customer, $product_name, $quantity, $price, $order_date, $delivery_date, $delivery_status, $payment_status);
    fputcsv($fp, $row_data);
}

// close the file pointer
fclose($fp);

// send the CSV file to the browser for download
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="orders.csv"');
exit;
