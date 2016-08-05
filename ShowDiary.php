<!DOCTYPE html>
<html>
<head>

	<title>Diary</title>
	<link rel="stylesheet" type="text/css" href="diaryStyles.css">

</head>
<body>

	<div id="header">
		Web Diary
	</div>

	<br><br>

	<div id="main">

		<form id="aForm" method="GET">
			<input type="submit" name="SignOut" value="Sign Out" formaction="WelcomePage.php" class="b">
			<input type="submit" name="Entry" value="New Entry" formaction="DiaryEntry.php" class="b">
		</form>

		<br><br>
		
		<?php

			if(!isset($_COOKIE["name"])){

				echo '<script language="javascript">
						alert("Session has timed out");
						</script>';

				echo '<script language="javascript">
						window.location.href="SignIn.php";
						</script>';

			}else{
				//Create connection to the MySQL server
				$servername = "localhost";
				$username = "pawn";
				$password = "pawnpass";
				$dbname = "DiaryDB";

				$conn = new mysqli($servername, $username, $password, $dbname);

				if($conn->connect_error){
					die("Connection failed: ".$conn->connect_error);
				}

				//Create and execute query
				$sql = "SELECT * FROM WebDiary
						WHERE Username = '" . $_COOKIE["name"] . "'";

				$result = $conn->query($sql);

				//Create and print table of selected data
				if($result !== false){
					$html_table = '<table align="center" border="1" cellspacing="0" cellpadding="2" style="maxwidth:50px"><tr><th><span>When/Where</span></th><th><span>Event</span></th><th><span>Emotion</span></th><th><span>AutomaticThoughts</span></th><th><span>RationalResponse</span></th></tr>';

					foreach($result as $row){
						$one = formatText($row['Location']);
						$two = formatText($row['Event']);
						$three = formatText($row['Emotion']);
						$four = formatText($row['AutomaticThoughts']);
						$five = formatText($row['RationalResponse']);

						$html_table .= '<tr><td>' .$one. '</td><td>' .$two. '</td><td>' .$three. '</td><td>' .$four. '</td><td>' .$five. '</td></tr>';
					}

					$html_table .= '</table>';

					echo $html_table;
				}else{
					echo "Error displaying table: " . $conn->error;
				}

				//Close connection
				$conn->close();

			}

			//Function adds new line break after every 35 characters
			function formatText($data){
				$count = 0;
				$output = "";

				for($x = 0; $x < strlen($data); $x++){
					$char = $data[$x];
					if($count == 35){
						$output .= "<br>".$char;
						$count = 0;
					}else{
						$output .= $char;
						$count++;
					}
				}

				return $output;
			}

		?>

	</div>

</body>
</html>