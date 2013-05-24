<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputUsername = $_SESSION['username'];
$inputOld = $_POST['inputOld'];
$inputNew = $_POST['inputNew'];

$query = "SELECT * FROM USER
				WHERE Username = '$inputUsername'
				AND Password = '$inputOld';";	

$result = mysql_query($query, $link);

$count = mysql_numrows($result);

if($count == 1)
{
	$query = "UPDATE USER
				SET Password = '$inputNew'
				WHERE Username = '$inputUsername';";	

	mysql_query($query, $link);
	
	mysql_close($link);

	header("Location: UserProfile.php");
}
else
{
	echo '<form action="EditPassword.php" method="link">
		<input type="submit" value="Back">
		</form>';
	echo 'Incorrect Old Password.';
}

mysql_close($link);
?>