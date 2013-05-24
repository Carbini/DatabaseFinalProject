<?php
echo '<form action="UserProfile.php" method="link">
		<input type="submit" value="Back">
		</form>';

echo '<b>Edit Member Status</b>
			<form action="StatusChanged.php" method="post">
			<select name="dropdown">
			<option value="Admin">Admin</option>
			<option value="User">User</option>
			<option value="Banned">Banned</option>
			<option value="Removed">Removed</option>
			<input type="submit" value="Submit" />
			</form>';
?>