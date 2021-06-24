<?php
	session_start();
	include("connection.php");
	include("function.php");
	$user_data = check_login($con);
	$work_unit = $user_data['work_unit'];
	try 
	{
	if($_SERVER['REQUEST_METHOD'] == "POST")	
	{
		//Something was posted
		$product_name = $_POST['product_name'];
		$price = $_POST['price'];
		$amount = $_POST['amount'];
		$comment = $_POST['comment'];
		if(!empty($product_name) && !empty($price) && !empty($amount))
		{
			$result_check = pg_query($con, "select product_name from product where shop_name = '$work_unit' and product_name = '$product_name';");
			if (pg_num_rows($result_check) > 0) 
			{
				echo "Error: The product has already existed!";
			}
			else
			{
				pg_query($con,"insert into product(shop_name, product_name, price, amount, comment) values ('$work_unit','$product_name','$price', '$amount', '$comment');");
				echo "Update database successfully! ";
				echo '<a href="main_page.php" title="Update database">Click here to see changes</a>';
				die;
			}
		}
		else
		{
			echo "Error: The information provided is not enough!";
		}
	}
	pg_close();
	}
	catch (Exception $e) 
	{
		echo "Error: <br/>", $e->getMessage(), "\n";
	}
?>	

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to ATN's website</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="maindiv">
	<a href = "logout.php">Logout</a>
	<a href = "main_page.php">Return</a>
	<br>
	<center>
	<div class="divA">
	<div class="divB">
	<div style = "font-size: 20px; margin: 10px;">THIS IS PAGE FOR <?php echo strtoupper($user_data['username']); ?></div><br>
	<form method = "post">
			<div style = "font-size: 30px; margin: 10px;">ADD PRODUCT</div><br>
			<label>Product name......................: </label><input type = "text" name = "product_name"><br><br>
			<label>Price.....................................: </label><input type = "text" name = "price"><br><br>
			<label>Amount...............................: </label><input type = "text" name = "amount"><br><br>
			<label>Comment.............................: </label><input type = "text" name = "comment"><br><br>
			<input type = "submit" value = "Update"><br><br>
	</form>
	</center>
	</div></div></div></div>
<body>
</body>
</html>
