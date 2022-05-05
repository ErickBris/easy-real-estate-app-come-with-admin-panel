<?php

class Database {

	// Function to the database and tables and fill them with the default data
	function create_database($data)
	{
		// Connect to the database
		try {
			$mysqli = new mysqli($data['host_name'],$data['db_username'],$data['db_pwd'],'');
		} catch (Exception $e) {
			echo "notfound";
		}
		

		// Check for errors
		if(mysqli_connect_errno())
			return false;

		// Create the prepared statement
		$mysqli->query("CREATE DATABASE IF NOT EXISTS ".$data['db_name']);
		do {
			if($result = mysqli_store_result($mysqli)){
				mysqli_free_result($result);
			}
		} while(mysqli_next_result($mysqli));

		if(mysqli_error($mysqli)) {
			die(mysqli_error($db_link));
			return false;
		}
		// Close the connection
		$mysqli->close();

		return true;
	}

	// Function to create the tables and fill them with the default data
	function create_tables($data)
	{
		// Connect to the database
		$mysqli = new mysqli($data['host_name'],$data['db_username'],$data['db_pwd'],$data['db_name']);

		// Check for errors
		if(mysqli_connect_errno())
			return false;

		ini_set('max_execution_time', 300);
		// Open the default SQL file
		$query = file_get_contents('assets/install.sql');

		// Execute a multi query
		$mysqli->multi_query($query);

		do {
			if($result = mysqli_store_result($mysqli)){
				mysqli_free_result($result);
			}
		} while(mysqli_next_result($mysqli));

		if(mysqli_error($mysqli)) {
			die(mysqli_error($db_link));
			return false;
		}

		// Close the connection
		$mysqli->close();

		return true;
	}

	function create_admin_account($data){
		$mysqli = new mysqli($data['host_name'],$data['db_username'],$data['db_pwd'],$data['db_name']);

		// Check for errors
		if(mysqli_connect_errno())
			return false;

		$query='INSERT INTO users(`user_name`,`pwd`,`email`,`perm`)
		VALUES ("'.$data['user_name']
			.'","'.md5(md5(md5($data['pwd'])))
			.'","'.$data['email'].'",0)';
		// Execute a multi query
if(!$mysqli->query($query)){
	echo 'insert failed'.$mysqli->error;
};

do {
	if($result = mysqli_store_result($mysqli)){
		mysqli_free_result($result);
	}
} while(mysqli_next_result($mysqli));

if(mysqli_error($mysqli)) {
	die(mysqli_error($db_link));
	return false;
}
		// Close the connection
$mysqli->close();
return true;
}
}