<?php
include 'db_login.php';

// Getting data from HTML Form
$FIRST_NAME = $_POST['First_Name'];
$LAST_NAME = $_POST['Last_Name'];
$ST_ADDRESS = $_POST['1st_line_of_Address'];
$ND_ADDRESS = $_POST['2nd_line_of_Address'];
$CITY = $_POST['City'];
$POSTCODE = $_POST['Post_Code'];
$TELEPHONE = $_POST['Telephone'];



// Create connection
$connection = mysqli_connect($db_host, $db_username, $db_password,
$db_database);
// Check connection
if (mysqli_connect_errno($connection))
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$insert_query = "INSERT INTO checkout (First_Name, Last_Name, 1st_line_of_Address, 2nd_line_of_Address, City, Post_Code, Telephone)
values ('$FIRST_NAME', '$LAST_NAME', '$ST_ADDRESS','$ND_ADDRESS','$CITY','$POSTCODE','$TELEPHONE')";
$result = mysqli_query($connection,$insert_query);
echo "First Name: ", $FIRST_NAME;
echo "<br>";
echo "Last Name: ", $LAST_NAME;
echo "<br>";
echo "1st address: ", $ST_ADDRESS;
echo "<br>";
echo "2nd Address: ", $ND_ADDRESS;
echo "<br>";
echo "City: ", $CITY;
echo "<br>";
echo "Post code: ", $POSTCODE;
echo "<br>";
echo "Telephone: ", $TELEPHONE;


//getting content from cart into Orders table#



$Select_query = 'SELECT ITEM_ID, QTY FROM cart';

$result2 = mysqli_query($connection, $Select_query);

while($row = mysqli_fetch_array($result2))
{
$ITEM_ID = $row['ITEM_ID'];
$QTY = $row['QTY'];
$CUSTOMER_ID = '2';
$Insert_order = "insert INTO orders (ITEM_ID, CUSTOMER_ID, QTY) values ('$ITEM_ID','$CUSTOMER_ID', '$QTY')";
$result3 = mysqli_query($connection, $Insert_order);
$del_order =  "DELETE  from cart where ITEM_ID= '$ITEM_ID' ";
$del = mysqli_query($connection, $del_order);
}

mysqli_close($connection);
?>