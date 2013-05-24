<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

$inputUsername = $_POST['inputUsername'];

session_start();
$_SESSION['username']=$inputUsername;


$query = "SELECT * FROM USER
				WHERE Username = '$inputUsername';";		

$result = mysql_query($query, $link);

//Check if such Username exists
if(mysql_numrows($result) == 0)
{	
	mysql_close($link);

	echo 'Username ', $inputUsername, ' is available!<br><br>
			<b>Enter Info</b>
			<form action="CreateAccount.php" method="post">
			Full Name:	<input type="text" name="inputFullName" />
			Password:	<input type="password" name="inputPassword" />
			<input type="submit" value="Login" />
			</form>';
}
else
{
	mysql_close($link);

	echo "Username already exists.<br><br>";
	echo '<b>Register</b>
			<form action="Register.php" method="post">
			Username:	<input type="text" name="inputUsername" />
			<input type="submit" value="Register" />
			</form>';
}

?>