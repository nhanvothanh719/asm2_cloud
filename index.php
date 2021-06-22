<?php
session_start();
include("connection.php");
include("function.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	//Something was posted
	$username = $_POST['username'];
	$password = $_POST['password'];
	if(!empty($username) && !empty($password))
	{
		//Read from database
		$query = "select * from accounts where username = '$username' limit 1";
		$result = pg_query($con, $query);
		if($result)
		{
			if($result && pg_num_rows($result) > 0)
			{
				$user_data = pg_fetch_assoc($result);
				if($user_data['password'] === $password)
				{
					$work_unit = $user_data['work_unit'];
					switch ($work_unit)
					{
						case 'Director_Board':
							$_SESSION['user_id'] = '3';
							header("Location: pg_for_boss.php");
							die;
							break;
						default:
							$_SESSION['user_id'] = $user_data['user_id'];
							header("Location: main_page.php");
							die;
							break;
					}
				}
			}
			echo "Error: The account does not exist!";
		}
	}
	else
	{
		echo "Error: Invalid information entered!";
	}
	pg_close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<style type = "text/css">
	</style>
	<div id = "box">
		<center>
		<form method = "post">
			<div class="maindiv">
			<div class="divA">
			<div class="divB">
			<div style = "font-size: 30px; margin: 10px;">ATN LOGIN FORM</div><br>
			<label>Username: </label><input type = "text" name = "username"><br><br>
			<label>Password: </label><input type = "password" name = "password"><br><br>
			<input type = "submit" value = "Login"><br><br>
			<a href = "signup.php">Click here to sign up</a><br><br>
		</form>
		</center>
	</div>
</body>
</html>