<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputGroupName = $_SESSION['groupName'];
$inputDescription = $_POST['inputDescription'];

$query = "UPDATE FORUM_GROUP
			SET Description = '$inputDescription'
			WHERE GName = '$inputGroupName';";	

mysql_query($query, $link);

mysql_close($link);

header("Location: GroupProfile.php");
?>