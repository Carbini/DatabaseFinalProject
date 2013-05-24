<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

$inputUsername = $_POST['inputUsername'];
$inputPassword = $_POST['inputPassword'];

session_start();
$_SESSION['username']=$inputUsername;

$query = "SELECT * FROM USER
				WHERE Username = '$inputUsername'
				AND Password = '$inputPassword';";		

$result = mysql_query($query, $link);

//Check if such Username and Password combo exists
if(mysql_numrows($result) == 0)
{
	mysql_close($link);
	
	echo "No such Username and Password combination exists.<br><br>";
	echo '<b>Register</b>
			<form action="Register.php" method="post">
			Username:	<input type="text" name="inputUsername" />
			<input type="submit" value="Register" />
			</form>';
}
else
{
	//Check if Removed
	$query2 = "SELECT * FROM USER
					WHERE Username = '$inputUsername'
					AND Status = 'Removed';";	

	$result2 = mysql_query($query2, $link);

	$count2 = mysql_numrows($result2);

	if($count2 == 1)
	{
		echo '<form action="FinalProject.php" method="link">
		<input type="submit" value="Back">
		</form>';
		echo "This account has been permanently removed.";
		
		mysql_close($link);
	}
	else
	{
		mysql_close($link);
		header("Location: UserHome.php");
	}
}

?>