<?php
	session_start();
	include("connection.php");
	include("function.php");
	#Get data for boss
	$result = pg_query($con,"select * from product;"); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to ATN's website</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="maindiv">
	<div class="divA">
	<a href = "logout.php">Logout</a>
	<div class="divB">
	<br>
	<center>
	<div class="title">
	<div style = "font-size: 20px; margin: 10px;">THIS IS PAGE FOR BOSS</div><br><br></div>
	<?php
		$url1=$_SERVER['REQUEST_URI'];
		header("Refresh: 10; URL=$url1");
		display_table($result);
		echo '<br><br>';
		pg_close();
	?>	
	</center>
<body>
</body>
</html>

