<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputUsername = $_SESSION['username'];
$inputGName = $_GET['GName'];

$query = "SELECT * FROM FORUM_GROUP
			WHERE GName = '$inputGName';";	

$result = mysql_query($query, $link);

$owner = mysql_result($result, 0, "OwnerOf");

//Send Deny Message
$query = "INSERT INTO MAILBOX
			VALUES ('0', '$inputGName', NOW(),
			'$inputUsername', '$owner', 'Unread', 'Your group has been denied.');";	

mysql_query($query, $link);

//Delete MemberOf
$query = "DELETE FROM MemberOf
			WHERE  GName = '$inputGName';";	
	
mysql_query($query, $link);

//Deny Group
$query = "DELETE FROM FORUM_GROUP
			WHERE  GName = '$inputGName';";	
	
mysql_query($query, $link);

mysql_close($link);

header("Location: UserHome.php");

?>