<?php
echo '<form action="UserProfile.php" method="link">
		<input type="submit" value="Back">
		</form>';


echo '<b>Edit Description</b>
			<form action="DescriptionChanged.php" method="post">
			Description:  <br><textarea name="inputDescription" cols = "25" rows = "5"/></textarea>
			<input type="submit" value="Submit" />
			</form>';
?>