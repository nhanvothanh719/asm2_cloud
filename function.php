<?php

# Fuction: Checking login 
function check_login($con)
{
	if(isset($_SESSION['user_id']))
	{
		$id = $_SESSION['user_id'];
		$query = "select * from accounts where user_id = '$id' limit 1";
		$result = pg_query($con,$query);
		if($result && pg_num_rows($result) > 0)
		{
			$user_data = pg_fetch_assoc($result);
			return $user_data;
		}
	}
	//Redirect to login
	header("Location: login.php");
	die;
}

# Function: Table displaying # Argument: query result
function display_table($query_obj)
{
	$num_rows = pg_num_rows($query_obj);
	$num_fields = pg_num_fields($query_obj);
	# Init a table
	echo ' <table border = "1"><tr>';
	$field_list = array();
	# Display header
	for($i = 0; $i < $num_fields; $i++)
	{
		
		$field_name = pg_field_name($query_obj,$i);
		$field_list[$i] = $field_name;
		echo "<th> $field_name </th>";
	}
	echo '</tr>';
	
# Function: Row displaying
function display_row($_row, $_field_list)
{
	echo "<tr>\n";
	foreach($_field_list as $_field_name)
	{
		// td: table data
		echo "<td>", $_row[$_field_name], "</td>";
	}
	echo "</tr>";
}
	# Display rows
	for($row_index = 0; $row_index < $num_rows; $row_index++)
	{
		$row = pg_fetch_array($query_obj, $row_index);
		# Display one row
		display_row($row,$field_list);
	}
	echo "</table>";
}
