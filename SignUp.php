<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="diaryStyles.css">
	<script type="text/javascript" src="diary.js"></script>
</head>
<body>

	<?php

		if($_SERVER["REQUEST_METHOD"] == "POST"){

			$name = $_POST["username"];
			$userpassword = $_POST["password"];

			//Higher cost is more secure but requires more processing power
			$cost = 10;

			//Create a random salt
			$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

			//Prefix informatio about the hash so PHP knows how to verify it later.
			//"$2a$" indicates Blowfish algorithm
			$salt = sprintf("$2a$%02d$", $cost) . $salt;

			//Hash the password with the salt
			$hash = crypt($userpassword, $salt);


			//Create connection to the MySQL server
			$servername = "localhost";
			$username = "pawn";
			$password = "pawnpass";
			$dbname = "DiaryDB";

			$conn = new mysqli($servername, $username, $password, $dbname);

			if($conn->connect_error){
				die("Connection failed: " . $conn->connect_error);
			}

			//Create and execute query
			$sql = "INSERT INTO Users
					(Username,Salt,Hash)
					VALUES
					('$name','$salt','$hash')";

			if($conn->query($sql) === FALSE){
				$conn->close();

				//Alert user of error
				echo '<script language="javascript">';
				echo 'alert("Error creating account")';
				echo '</script>';
			}else{
				$conn->close();

				//User session lasts 1 hour
				//After hour user must sign in again
				setcookie("name",$name,time()+3600);

				//Go to new diary entry page
				header("Location: DiaryEntry.php");
			}

		}

	?>

	<div id="header">
		Web Diary
	</div>

	<div class="centered">

		<form name="signUpForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return signUpValidate('signUpForm');">
			<br>
			<input type="text" name="username" placeholder="enter username">
			<br><br><br>
			<input type="password" name="password" placeholder="enter password">
			<br><br>
			<input type="password" name="password2" placeholder="re-enter password">
			<br><br>
			<input type="submit" class="b" name="return" value="Return" formaction="WelcomePage.php">
			<input type="submit" class="b" name="submit" value="Sign Up">
		</form>

	</div>

</body>
</html>