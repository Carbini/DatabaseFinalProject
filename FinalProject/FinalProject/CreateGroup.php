<?php
echo '<form action="UserHome.php" method="link">
		<input type="submit" value="Back">
		</form>';

echo '<b>Create Group</b>
			<form action="CreateGroup2.php" method="post">
			Group Name:	<input type="text" name="inputGroupName" />
			Description: <input type="text" name="inputDescription" />
			<input type="submit" value="Create" />
			</form>';
?>