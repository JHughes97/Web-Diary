<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "DiaryDB";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "CREATE TABLE Users (
			Username VARCHAR(15) PRIMARY KEY,
			Salt TEXT,
			Hash TEXT
			)";

	if($conn->query($sql) === TRUE){
		echo "User table created successfully.";
	}else{
		echo "Error creating user table: " . $conn->error;
	}

	$conn->close();

?>