<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputUsername = $_SESSION['username'];

$inputFullName = $_POST['inputFullName'];
$inputPassword = $_POST['inputPassword'];

$query = "INSERT INTO USER
	VALUES ('$inputFullName', '$inputUsername', '$inputPassword', 'User', NULL, NULL);";	

mysql_query($query, $link);

mysql_close($link);

header("Location: UserHome.php");

?>