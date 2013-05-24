<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputThreadName = $_SESSION['threadName'];
$inputGroupName = $_SESSION['groupName'];

//Delete from THREAD
$query = "DELETE FROM THREAD
			WHERE Title = '$inputThreadName'
			AND GName = '$inputGroupName';";	

mysql_query($query, $link);

//Delete all posts from POST
$query = "DELETE FROM POST
			WHERE Thread = '$inputThreadName'
			AND GName = '$inputGroupName';";	

mysql_query($query, $link);

mysql_close($link);

header("Location: GroupPage.php");
?>