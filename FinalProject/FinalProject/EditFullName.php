<?php
echo '<form action="UserProfile.php" method="link">
		<input type="submit" value="Back">
		</form>';

echo '<b>Edit Full Name</b>
			<form action="FullNameChanged.php" method="post">
			FullName:	<input type="text" name="inputFullName" />
			<input type="submit" value="Submit" />
			</form>';
?>