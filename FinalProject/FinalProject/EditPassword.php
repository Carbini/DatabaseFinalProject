<?php
echo '<form action="UserProfile.php" method="link">
		<input type="submit" value="Back">
		</form>';

echo '<b>Edit Password</b>
			<form action="PasswordChanged.php" method="post">
			Old Password:	<input type="text" name="inputOld" />
			New Password:	<input type="text" name="inputNew" />
			<input type="submit" value="Submit" />
			</form>';
?>