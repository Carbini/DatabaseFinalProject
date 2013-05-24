<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputUsername = $_SESSION['username'];
$inputGName = $_GET['GName'];

//Approve Group
$query = "UPDATE FORUM_GROUP
			SET Status = 'Approved'
			WHERE  GName = '$inputGName';";	
	
mysql_query($query, $link);

mysql_close($link);

header("Location: UserHome.php");

?>