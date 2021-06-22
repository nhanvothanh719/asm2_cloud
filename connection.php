<?php
	#DATABASE CREDENTIAL
	$db_host = "ec2-54-197-100-79.compute-1.amazonaws.com";
	$db_name = "d1om80ajbvaek4";
	$db_user = "vxoeeolthvyckd";
	$db_password = "f0e1ea719887ccd1b879dc020cee0d76c8de794a579d7aa43e218195ba4c4106";
	$conn_string = "host = $db_host port = 5432 dbname = $db_name user = $db_user password = $db_password";
	$con = pg_connect($conn_string);
	if(!$con)
	{
		die("Failed to connect database");
	}
?>
