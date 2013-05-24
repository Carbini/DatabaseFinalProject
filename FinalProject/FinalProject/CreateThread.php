<?php
echo '<form action="GroupPage.php" method="link">
		<input type="submit" value="Back">
		</form>';

echo '<b>New Thread</b>
			<form action="CreateThread2.php" method="post">
			Title:	<input type="text" name="inputTitle" />
			<br>Body: <br><textarea name="inputText" cols = "25" rows = "5"/></textarea>
			<input type="submit" value="Create" />
			</form>';

?>