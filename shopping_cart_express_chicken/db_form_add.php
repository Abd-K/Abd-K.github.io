<?php
include 'db_login.php';
// if (isset($_POST["submit"])) {
// Getting data from HTML Form
$QTY = $_POST['QTY'];
$ITEM = $_POST['ITEM'];
$PRICE = $_POST['PRICE'];

// Create connection
$connection = mysqli_connect($db_host, $db_username, $db_password,
$db_database);
// Check connection
if (mysqli_connect_errno($connection))
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

 $insert_query = "INSERT INTO cart (QTY,ITEM,PRICE)
values ('$QTY','$ITEM', '$PRICE')"; 
$result = mysqli_query($connection,$insert_query);
mysqli_close($connection);
//}
?>
