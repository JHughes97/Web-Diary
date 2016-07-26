<?php
	$insert = false;

	//Set variables from posted values
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$inputOne = $_POST["one"];
		$inputTwo = $_POST["two"];
		$inputThree = $_POST["three"];
		$inputFour = $_POST["four"];
		$inputFive = $_POST["five"];
		$insert = true;
	}

	if($insert){
		//Create connection to MySQL server
		$servername = "localhost";
		$username = "pawn";
		$password = "pawnpass";
		$dbname = "mydb";

		$conn = new mysqli($servername, $username, $password, $dbname);

		//Escape special characters for use in SQL statement
		$one = mysqli_real_escape_string($conn, $inputOne);
		$two = mysqli_real_escape_string($conn, $inputTwo);
		$three = mysqli_real_escape_string($conn, $inputThree);
		$four = mysqli_real_escape_string($conn, $inputFour);
		$five = mysqli_real_escape_string($conn, $inputFive);

		if($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}

		//Create and execute query
		$sql = "INSERT INTO WebDiary(Location,Event,Emotion,AutomaticThoughts,RationalResponse) VALUES ('$one','$two','$three','$four','$five')";

		if($conn->query($sql) === FALSE){
			echo "Error: ".$sql."<br>".$conn->query($sql);
		}

		//Close connection
		$conn->close();

		//Return to new entry page
		header("Location: DiaryEntry.php");
	}

?>