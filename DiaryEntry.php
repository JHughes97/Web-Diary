<!DOCTYPE html>
<html>
<head>

	<title>New Entry</title>
	<link rel="stylesheet" type="text/css" href="diaryStyles.css">
	<script type="text/javascript" src="diary.js"></script>

</head>
<body>

	<div id="header">
		Web Diary
	</div>

	<br><br><br><br>

	<div id="main">

		<form id="myForm" action="SaveEntry.php" method="POST" onsubmit="return validateForm('myForm','info');">
			<div class="block">
				<label for="one"><span class="title">When/Where:</span>
				<textarea type="text" class="txt" name="one" id="one" placeholder="where did the event happen?"></textarea></label>
			</div>
			<div class="block">
				<label for="two"><span class="title">Event:</span>
				<textarea type="text" class="txt" name="two" id="two" placeholder="describe the event"></textarea></label>
			</div>
			<div class="block">
				<label for="three"><span class="title">Emotion:</span>
				<textarea type="text" class="txt" name="three" id="three" placeholder="how did you feel?"></textarea></label>
			</div>
			<div class="block">
				<label for="four"><span class="title">Automatic Thoughts:</span>
				<textarea type="text" class="txt" name="four" id="four" placeholder="what did you think at the time?"></textarea></label>
			</div>
			<div class="block">
				<label for="five"><span class="title">When/Where:</span>
				<textarea type="text" class="txt" name="five" id="five" placeholder="what do you think now?"></textarea></label>
			</div>
			<br>
			<input type="submit" name="Submit" value="Save Entry" class="b">
		</form>
		<br>

		<form id="myForm2" action="ShowDiary.php" method="GET">
			<input type="submit" name="Submit" value="ShowDiary" class="b">	
		</form>

		<div id="info" class="out">
			Click buttons to save entry or view previous entries
		</div>

	</div>

</body>
</html>