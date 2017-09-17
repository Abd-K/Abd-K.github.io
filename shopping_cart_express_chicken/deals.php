<!DOCTYPE html>
<link rel="stylesheet" href="Index_Style.css" type="text/css" media="screen, projection" />
<html>
	<head>
		<title> Chicken Express! </title>
		<link rel="shortcut icon" href="Images/logo.jpg">  
	</head>
	<body>
		<div id="Container">
			<div id="Center">
				<div id="Top_Bar">
					<a  href="index.php">
						<img class="TopLogo_Img" src="Images/logo.jpg" alt="logo">
					</a>
				</div>
				<div id="Menu_Board" >
					<ul id="Menu_Bar">
						<li><a href="index.php">Home</a></li>
						 <li class="current"><a href="deals.php">Deals</a></li>
						 <li><a href="mains.php">Mains</a></li>
						 <li><a href="sides.php">Sides</a></li>
						 <li><a href="drinks.php">Drinks</a></li>
					</ul>
					<table class="Menu_Tables">
						<tr>
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
							$query = 'SELECT * FROM  deals';
							
							// execute the query										
							$result = mysqli_query($connection, $query);

							// fetch and display the results						
							$i=0;
							while($row = mysqli_fetch_array($result))
								{
									$i++;
									echo "<td>";
										echo "<a href><img class=\"images\" src='" .$row['IMAGE']."' ></a>";
												echo "<H3>", $row['ITEM'], "<H3>";
												echo "<h4>£", $row['Price'], "</h4>";

											echo "<form  id=\"Add\" action=\"db_form_add.php\" method=\"post\"> 
											<select id='Selected' name='QTY' >
												<option value='1' selected=1 >1</option>
												<option value='2' >2</option>
												<option value='3' >3</option>
												<option value='4' >4</option>
												<option value='5' >5</option>
												<option value='6' >6</option>
												<option value='7' >7</option>
												<option value='8' >8</option>
												<option value='9' >9</option>
												<option value='10' >10</option>
												</select>";
												echo "<input type='hidden'  value=' ".$row['ITEM']." ' name='ITEM'/>";
												echo "<input type='hidden'  value=' ".$row['Price']." ' name='PRICE'/>";
												echo "<input type='submit'  value='Add to Cart' name='submit'/>";
											echo "	</form>
											<br>";
											echo "<a id=\"Button_Design\" href=\"http://sots.brookes.ac.uk/~11027616/customisation.php\" >Customise</a>";	
									echo "</td>";
									if($i==2)
									{
										echo "</tr >";
									} 
								}
							mysqli_close($connection);
						?>
					</table>
				</div>
			</div>
			<div id="Right_Bar">
				<div id="Login_Bar">
					<?php 
						$user = 'Abdul';
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
									$query = 'SELECT CART_ID,QTY, ITEM, PRICE, QTY*PRICE as PRICE FROM cart';
									$query2 = 'SELECT QTY, PRICE, SUM(QTY*PRICE) as TOTALS FROM cart';

									$query3 = "SELECT SUM(QTY) as TOTALS FROM cart WHERE ITEM =' Chicken Fillet Burger '";
									$query4 = "SELECT SUM(QTY) as TOTALS FROM cart WHERE ITEM =' Chips '";
									
									$query5 = "SELECT SUM(QTY) as TOTALS FROM cart WHERE ITEM =' Chicken Fillet Wrap '";
									$query6 = "SELECT SUM(QTY) as TOTALS FROM cart WHERE ITEM =' Coke 330mL ' ";
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
										<input type='hidden'  value=' ".$row['CART_ID']." ' name='CART_ID' />";
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
				<div id="Banner_Bar">
					<h3> Great Meals on the Menu today! </h3>
					<a href><img class="Banner_Img" src="menu/Chicken_Fillet_Burger_and_Chips.jpg" alt="burger & fries.jpg"></a>
					<br>
					<nav>
					  <a href="/html/">Next</a> 
					  <a href="/css/">Previous</a> 
					  <br>
					</nav>
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
</html>