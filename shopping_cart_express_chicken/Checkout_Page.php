<!DOCTYPE html>
<link rel="stylesheet" href="Index_Style.css" type="text/css" media="screen, projection" />
<html>
	<head>
		<title> Chicken Express! </title>
		<link rel="shortcut icon" href="Images/logo.jpg">  
	</head>
	<body>
	<div id ="background2">
		<div id="Container">
			<div id="Center">
				<div id="Top_Bar">
					<a  href="index.php">
						<img class="TopLogo_Img" src="Images/logo.jpg" alt="logo">
					</a>
				</div>
				<div id="Menu_Board" >
					<div id="Checkout">
						<br>
						<h3> Checkout </h3>
						<h4>Delivery Information </h4>
						<div id="delivery">
								<?php 
									$user = 'Abdul';
									
									if($user == null) {
										$First_name='';
										$Surname='';
										$st_Address = '';
										$nd_Address = '';
										$city = '';
										$Postcode = '';
										$tele='';
									}
									else {
									$First_name = 'N/A';
									$Surname = 'N/A';
									$st_Address = 'N/A';
									$nd_Address = 'N/A';
									$city = 'N/A';
									$Postcode = 'N/A';
									$tele= 'N/A';
									
									}
								?>
							<form action="db_form_checkout.php" method="post">
								<p>First name: <input type="text" name="First_Name" value="<?php echo"$First_name"?>" Placeholder="Please enter information"></p>
								<p>Surname: <input type="text" name="Last_Name" value="<?php echo"$Surname "?>"></p>
								<p>1st line of Address: <input type="text" name="1st_line_of_Address" value="<?php echo"$st_Address "?>"></p>
								<p>2nd line of Address: <input type="text" name="2nd_line_of_Address" value="<?php echo"$nd_Address "?>"></p>
								<p>City: <input type="text" name="City" value="<?php echo"$city "?>"></p>
								<p>Postcode: <input type="text" name="Post_Code" value="<?php echo"$Postcode "?>"></p>
								<p>Telephone: <input type="text" name="Telephone" value="<?php echo"$tele "?>"></p>
								<input type="submit" value="Submit Form">
							</form>
						</div>
						<br>
						<h4>Collection </h4>
						<div id="collection">
							<form id='Collection' action='Checkout_Page.php'  method='post'>
								<input type='submit' name='Request' value='Request Code'>
							</form>
							<?php 
								//include login information
								include('db_login.php');
								
								// connect to database
								$connection = mysqli_connect($db_host, $db_username,
								$db_password, $db_database);
								// Check connection
								if (mysqli_connect_errno($connection))
								{
								echo "Failed to connect to MySQL: " . mysqli_connect_error();
								}
								if(isset($_POST['Request'])) {
								//$input = $_POST['Request']; //get input text
								//echo "Success! You entered: ".$input;
								   $insert_query = "INSERT INTO checkout (First_Name, Last_Name, 1st_line_of_Address, 2nd_line_of_Address, City, Post_Code, Telephone)
									values ('Collect', 'Collect', 'Collect','Collect','Collect','Collect','123')";
									$result = mysqli_query($connection,$insert_query);
									$querry = 'SELECT CHECKOUT_ID FROM checkout Where First_Name = "Collect" ORDER BY CHECKOUT_ID DESC LIMIT 1';
									$result = mysqli_query($connection, $querry);
									
									$row = mysqli_fetch_array($result);
									$Cus=$row['CHECKOUT_ID'];
									echo"<p> Collection Code:".$Cus."</p>";
									}
									else   {
									echo"<p> Collection Code:</p>";
									}
									
							?>
							
						<!--	<script>
								$(function() {
									$('#Collection').on('submit', function(e) {
										var data = $("#Collection :input").serialize();
										$.ajax({
											type: "POST",
											url: "script.php",
											data: data,
										});
										e.preventDefault();
									});
								});
							</script> -->
						</div> 
					</div>
				</div>
			</div>
			<div id="Right_Bar">
				<div id="Login_Bar">
					<?php 
						
						if ($user == 'Abdul' )
						{
							echo '
								<h6> Welcome ', $user ,'! </h6>
								<a href=\'http://sots.brookes.ac.uk/~11038530/Directory/userlogin.php\'> <h6> not (',$user,')? </h6></a> ';
						}
						else {
							echo '
								<a href=\'http://sots.brookes.ac.uk/~11038530/Directory/userlogin.php\'> <h6> Login </h6></a>
								<a href=\'http://sots.brookes.ac.uk/~11038530/Directory/userlogin.php\'> <h6> Register </h6></a>';
						}
					?>
					<hr width="75%">
					<br>
					<a href> Account Information</a>
				</div>
				<div id="Cart_Bar" >
					<img src="Images/cart.PNG" alt="cart" width="42" height="42">
					<div id="Cart_Table">
						<table border="1">
							<tbody>
								<tr >
									<th>QTY</th>
									<th>Item</th> 
									<th>Price </th>
								</tr>
								<tr>
									<?php

									$query = 'SELECT ITEM_ID,QTY, ITEM, PRICE, QTY*PRICE as PRICE FROM cart';
									$query2 = 'SELECT QTY, PRICE, SUM(QTY*PRICE) as TOTALS FROM cart';

									$query3 = "SELECT SUM(QTY) as TOTALS FROM cart WHERE ITEM =' Chicken Fillet Burger '";
									$query4 = "SELECT SUM(QTY) as TOTALS FROM cart WHERE ITEM ='Chips'";
									
									$query5 = "SELECT SUM(QTY) as TOTALS FROM cart WHERE ITEM =' Chicken Fillet Wrap '";
									$query6 = "SELECT SUM(QTY) as TOTALS FROM cart WHERE ITEM =' Coke 330mL' ";
									// execute the query										
									$result = mysqli_query($connection, $query);
									$result2 = mysqli_query($connection, $query2);
									$result3 = mysqli_query($connection, $query3);
									$result4 = mysqli_query($connection, $query4);
									$result5 = mysqli_query($connection, $query5);
									$result6 = mysqli_query($connection, $query6);
									
									$row2 = mysqli_fetch_array($result2);
									$row3 = mysqli_fetch_array($result3);
									$row4 = mysqli_fetch_array($result4);
									$row5 = mysqli_fetch_array($result5);
									$row6 = mysqli_fetch_array($result6);
									
									if ($row3['TOTALS'] < $row4['TOTALS'])
										{
										$Discount1 = $row3['TOTALS'];
										}
										else{
										$Discount1 = $row4['TOTALS'];
										}
										
									if ($row5['TOTALS'] < $row6['TOTALS'])
										{
											$Discount2 = $row5['TOTALS'];
										}
										else{
											$Discount2 = $row6['TOTALS'];
										}
									$Discount1 = $Discount1 *0.99;
									$Discount2 = $Discount2 *0.99;
									$Discount = $Discount2 + $Discount1;
									while($row = mysqli_fetch_array($result))
									{
									echo"
									<td> ".$row['QTY']."</td>
									<td> ".$row['ITEM']."</td>
									<td>£". $row['PRICE']."</td>	
									<td><form action='db_form_delete.php' method='get'>
										<input type='hidden'  value=' ".$row['ITEM_ID']." ' name='ITEM_ID' />";
										//	<a href=\'db_form_delete.php\' value=\' ',$row['ITEM_ID'],' \' ><img src=\'Images/bin.PNG\' value=\' ',$row['ITEM_ID'],' \'  alt=\'bin\' width=\'20\' height=\'20\' text-align:centers=\' /></a>	 
										echo"<input type='submit'  value='Delete' name='submit' /> 
									</form></td>	
									</tr>";
									}
									echo 
									'<tr> 
										<th colspan=\'2\'>Discounts</th>
										<th> £'  .$Discount. '</th>
									</tr>';
									$total = $row2['TOTALS'] - $Discount;
									echo 
									'<tr> 
										<th colspan=\'2\'>Totals</th>
										<th> £' .$total. '</th>
									</tr>'; 
								
								?>
								</tr>
							</tbody>
						</table>
					</div>
					<br>
					<a id="Button_Design2" href="Checkout_Page.php"> Checkout	</a>
					<br>
					<br>
					<a href> Order history</a>
					<br>
					<br>
				</div>
				<br>
			</div> 
		</div>
	</body>
	<footer>
		<br>
		<ul id="Bot_menu">
			<li><a href="http://sots.brookes.ac.uk/~10034849/CWReport/report.php"> Admin</a></li>
			<li><a href>Contact us</a></li>
			<li><a href>About us</a></li>
		</ul>
		<br>
		<hr  width="80%">
		<p><I> This business is fictitious and part of a Oxford Brookes University course </I></p>
	</footer>
	</div>
</html>