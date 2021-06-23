<?php
	session_start();
	include("connection.php");
	include("function.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to ATN's website</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	
	<script type = "text/JavaScript">
		function AutoRefresh( t ) {
		   setTimeout("location.reload(true);", t);
		}
	</script>
	<center>
	<div class="divA">
	<div class="divB">
    <form action="" method="post">
         <select name = "time_selection">
            <option value = 5 >5 second</option>
            <option value = 10>10 second</option>
            <option value = 30 selected>30 second</option>
         </select>
		<input type="submit" name="timerButton" value="Set time"/>
    </form> 
	<?php
		$sec = 5;
		if(isset($_POST['timerButton'])) 
			{ 
				//get input text
				$sec = $_POST['time_selection'];	
			}
		echo "<<< This page will reload itself in $sec second! >>>";
	?>
	</center>
	</div>
	</div>
</head>
<body onload = "JavaScript:AutoRefresh(<?php echo $sec*1000; ?>);">
	<center>
	<div class="maindiv">
	<div class="divA">
	<a href = "logout.php">Logout</a>
	<div class="divB">
	<br>
	<div class="title">
	<div style = "font-size: 20px; margin: 10px;">THIS IS PAGE FOR BOSS</div></div>
	<form 
	<form action="" method="post">
         <select name = "db_selection">
            <option value = "Shop_A" >Shop A</option>
            <option value = "Shop_B">Shop B</option>
            <option value = "ALL" selected>All shops</option>
         </select>
		<input type="submit" name="submitButton" value="Submit"/>
    </form>  
	<?php
		$input = "ALL ATN's SHOPS";
		//check if form was submitted
		if(isset($_POST['submitButton'])) 
		{ 
			//get input text
			$input = $_POST['db_selection'];
		}
		# Try to display SQL table
			echo "<p> DATABASE FROM ".strtoupper($input)."</p>"; 											
			if ($input == "ALL ATN's SHOPS")
			{
				# Get data by query
				$result = pg_query($con,"select * from product;"); 
			}
			else 
			{
				$result = pg_query($con,"select * from product where shop_name = '$input';"); 
			}
			display_table($result);
			pg_close();
		echo '<br><br>';
	?>	
	</center>
<body>
</body>
</html>


