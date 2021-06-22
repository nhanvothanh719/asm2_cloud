<?php
session_start();
include("connection.php");
include("function.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	//Something was posted
	$username = $_POST['username'];
	$password = $_POST['password'];
	$work_unit = $_POST['work_unit'];
	if(!empty($username) && !empty($password) && !empty($work_unit))
	{
		$query = "select * from accounts where username = '$username' limit 1";
		$result = pg_query($con, $query);
		if($result && pg_num_rows($result) > 0)
		{
			echo "Error: The account has already existed!";
		}
		else
		{
			//Save to database
			$query = "insert into accounts (username, password, work_unit) values ('$username','$password','$work_unit')";
			pg_query($con, $query);
			header("Location: login.php");
			die;
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
	<title>SIGN UP</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<style type = "text/css">
	#text{
		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
	}
	#button{
		padding: 10px;
		width: 100px;
		color: white;
		border: none;
	}
	#box{
		background-color: green;
		width: 300px;
		padding: 20px;
	}
	#submit{
		color:#f0f8ff;
		border-radius:3px;
		background:#1F8DD6;
		padding:5px;
		margin-top:40px;
		border:none;
		width:100px;
		height:30px;
		box-shadow:0 0 1px 2px #123456;
		font-size:16px
	</style>
	<div id = "box">
		<div class="maindiv">
		<div class="divA">
		<div class="divB">
		<center>
		<form method = "post">
			<div style = "font-size: 30px; margin: 10px;">ATN SIGN UP FORM</div><br>
			<label>Username: </label><input type = "text" name = "username"><br><br>
			<label>Password: </label><input type = "password" name = "password"><br><br>
			<label>Work unit: </label><input type = "text" name = "work_unit"><br><br>
			<input type = "submit" value = "Sign up"><br><br>
			<a href = "index.php">Click here to login</a><br><br>
		</form>
		</center>
	</div>
</body>
</html>
