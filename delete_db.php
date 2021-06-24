<?php

	session_start();
	include("connection.php");
	include("function.php");
	try
	{
	$user_data = check_login($con);
	$work_unit = $user_data['work_unit'];
	if($_SERVER['REQUEST_METHOD'] == "POST")	
	{
		//Something was posted
		$product_name = $_POST['product_name'];
		if(!empty($product_name))
		{
			$result_check = pg_query($con, "select product_name from product where shop_name = '$work_unit' and product_name = '$product_name';");
			if (pg_num_rows($result_check) > 0) 
			{
				pg_query($con, "delete from product where product_name = '$product_name' and shop_name = '$work_unit';");
				echo "Update database successfully! ";
				echo '<a href="main_page.php" title="Update database">Click here to see changes</a>';
				die;
			}
			else
			{
				echo "Error: There is no product with the '$product_name' name!";
			}
		}
		else
		{
			echo "Error: Not providing enough information!";
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
			<div style = "font-size: 30px; margin: 10px;">DELETE PRODUCT</div><br>
			<label>Product name.........................: </label><input type = "text" name = "product_name"><br><br>
			<input type = "submit" value = "Update"><br><br>
	</form>
	</center>
	</div></div></div></div>
<body>
</body>
</html>
