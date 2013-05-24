<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputGroupName = $_SESSION['groupName'];

echo $inputGroupName;

//Delete MembersOf Group
$query = "DELETE FROM MemberOf
			WHERE GName = '$inputGroupName';";	

mysql_query($query, $link);

//Delete All Group Posts
$query = "DELETE FROM POSTS
			WHERE GName = '$inputGroupName';";	

mysql_query($query, $link);

//Delete All Group Theards
$query = "DELETE FROM THREAD
			WHERE GName = '$inputGroupName';";	

mysql_query($query, $link);

//Delete Group
$query = "DELETE FROM FORUM_GROUP
			WHERE GName = '$inputGroupName';";	

mysql_query($query, $link);

mysql_close($link);

//header("Location: UserHome.php");
?>