<?php
include 'db_login.php';

// Getting data from HTML Form
$CART_ID = $_GET['CART_ID'];
// Create connection
$connection = mysqli_connect($db_host, $db_username, $db_password,
$db_database);
// Check connection
if (mysqli_connect_errno($connection))
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$del_query = "DELETE  from cart where CART_ID= '$CART_ID' ";
$del = mysqli_query($connection, $del_query);


mysqli_close($connection);
?>