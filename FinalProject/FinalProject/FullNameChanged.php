<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputProfileUsername = $_SESSION['ProfileUsername'];
$inputFullName = $_POST['inputFullName'];

$query = "UPDATE USER
			SET FullName = '$inputFullName'
			WHERE Username = '$inputProfileUsername';";	

mysql_query($query, $link);

mysql_close($link);

header("Location: UserProfile.php");
?>