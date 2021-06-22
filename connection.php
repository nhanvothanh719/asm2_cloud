<?php
	#DATABASE CREDENTIAL
	$db_host = "localhost";
	$db_name = "postgres";
	$db_user = "postgres";
	$db_password = "1111";
	$conn_string = "host = $db_host port = 5432 dbname = $db_name user = $db_user password = $db_password";
	$con = pg_connect($conn_string);
	if(!$con)
	{
		die("Failed to connect database");
	}
?>