<?php
//$records = mysqli_query($conn, "SELECT * FROM users");
	header('Access-Control-Allow-Origin: *');
	$mysql_host = "127.0.0.1";
	$mysql_database = "appointments";
	$mysql_user = "root";
	$mysql_password = "root";
// Create connection
	$conn = new mysqli($mysql_host, $mysql_user, $mysql_password,$mysql_database);
// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}