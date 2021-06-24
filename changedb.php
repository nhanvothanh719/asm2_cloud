<?php

	session_start();
	include("connection.php");
	include("function.php");
	$user_data = check_login($con);
	$work_unit = $user_data['work_unit'];
	# Try to display SQL table
	try 
	{
	if($_SERVER['REQUEST_METHOD'] == "POST")	
	{
		//Something was posted
		$product_name = $_POST['product_name'];
		$intake_num = $_POST['intake_num'];
		$sell_num = $_POST['sell_num'];
		if(!empty($product_name))
		{
			if(empty($intake_num) && empty($sell_num))
			{
				echo "Error: No input for the number of intake or sell products!";
			}
			else
			{
				$result = pg_query($con, "select amount from product where shop_name = '$work_unit' and product_name = '$product_name';");
				if(pg_num_rows($result) > 0) 
				{
					while($row = pg_fetch_assoc($result)) 
					{
						$current_num = $row["amount"];
					}
					$update_number = $current_num + $intake_num - $sell_num;
					if($update_number < 0)
					{
						echo "Error: The amount of '$product_name's is not enough!";
					}
					else
					{
						pg_query($con, "update product set amount = $update_number where shop_name = '$work_unit' and product_name = '$product_name';");
						echo "Update database successfully! ";
						echo '<a href="main_page.php" title="Update database">Click here to see changes</a>';
						die;
					}

				}
				else
				{
					echo "Error: There is no product in the database! ";
				}
			}
		}
		else
		{
			echo "Error: There is no product with the '$product_name' name!";
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
			<div style = "font-size: 30px; margin: 10px;">UPDATE DATABASE</div><br>
			<label>Product name.........................: </label><input type = "text" name = "product_name"><br><br>
			<label>Number of intake product(s).: </label><input type = "text" name = "intake_num"><br><br>
			<label>Number of sell product(s)......: </label><input type = "text" name = "sell_num"><br><br>
			<input type = "submit" value = "Update"><br><br>
	</form>
	</center>
	</div></div></div></div>
<body>
</body>
</html>
