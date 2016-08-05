<!DOCTYPE html>
<html>
<head>

	<title>Sign In</title>
	<link rel="stylesheet" type="text/css" href="diaryStyles.css">
	<script type="text/javascript" src="diary.js"></script>

</head>
<body>

	<?php

		$passwordError = "";

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$name = $_POST["username"];
			$userpassword = $_POST["password"];

			$servername = "localhost";
			$username = "pawn";
			$password = "pawnpass";
			$dbname = "DiaryDB";

			$conn = new mysqli($servername, $username, $password, $dbname);

			if($conn->connect_error){
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT Hash FROM Users
				WHERE Username = '" . $name . "'";

			$result = $conn->query($sql);

			if($result === false){

				echo "Error retrieving data from database";

			}else{

				$row = $result->fetch_assoc();

				$hash = $row["Hash"];

				//Validate password
				if(hash_equals($hash, crypt($userpassword, $hash))){

					$conn->close();

					//User session lasts 1 hour
					//After hour user must sign in again
					setcookie("name",$name,time()+3600);

					header("Location: DiaryEntry.php");

				}else{
					$conn->close();

					$passwordError = "*Incorrect username and/or password";
				}

			}

		}

	?>

	<div id="header">
		Web Diary
	</div>

	<div class="centered">

		<form name="signInForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return signUpValidate('signUpForm');">
			<br><br>
			<input type="text" name="username" placeholder="enter username">
			<br><br>
			<input type="password" name="password" placeholder="enter password"><br>
			<span class="error"><?php echo $passwordError; ?><br><br>
			<input type="submit" class="b" name="return" value="Return" formaction="WelcomePage.php">
			<input type="submit" class="b" name="submit" value="Sign In">
		</form>

	</div>

</body>
</html>