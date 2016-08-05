<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "DiaryDB";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if($conn->connect_error){
		die("Connection failed: " . $conn->connect_error);
	}

	$sql = "CREATE TABLE WebDiary (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			Username VARCHAR(15),
			Location TEXT,
			Event TEXT,
			Emotion TEXT,
			AutomaticThoughts TEXT,
			RationalResponse TEXT
			)";

	if($conn->query($sql) === TRUE){
		echo "WebDiary table created successfully.";
	}else{
		echo "Error creating WebDiary table: " . $conn->error;
	}

	$conn->close();
?>