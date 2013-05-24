<?php
echo '<form action="GroupProfile.php" method="link">
		<input type="submit" value="Back">
		</form>';


echo '<b>Edit Group Description</b>
			<form action="GroupDescriptionChanged.php" method="post">
			Description:  <br><textarea name="inputDescription" cols = "25" rows = "5"/></textarea>
			<input type="submit" value="Submit" />
			</form>';
?>