<?php
	session_start();
	include("connection.php");
	include("function.php");
	$user_data = check_login($con);
	$work_unit = $user_data['work_unit'];
	#Get data for each shop
	$result = pg_query($con,"select * from product where shop_name = '$work_unit';");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to ATN's website</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>'

<body>
	<div class="maindiv">
	<div class="divA">
	<a href = "logout.php">Logout</a>
	<div class="divB">
	<br>
	<center>
	<div class="title">
	<div style = "font-size: 20px; margin: 10px;">THIS IS PAGE FOR <?php echo strtoupper($user_data['username']); ?></div><br><br>
	</div>
	<?php display_table($result);?>
	<a href="changedb.php" title="Database change"><br> Click here to update data</a>
	<a href="add_db.php" title="Database change"><br><br> Click here to add product</a>
	<a href="delete_db.php" title="Database change"><br><br> Click here to remove product</a>
	</center>
<body>
</body>
</html>

