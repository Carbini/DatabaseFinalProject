<?php
echo '<form action="ThreadPage.php" method="link">
		<input type="submit" value="Back">
		</form>';

echo '<b>New Post</b>
			<form action="CreatePost2.php" method="post">
			<br>Body: <br><textarea name="inputText" cols = "25" rows = "5"/></textarea>
			<input type="submit" value="Create" />
			</form>';
?>