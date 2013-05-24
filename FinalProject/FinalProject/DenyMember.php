<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputOwner = $_SESSION['username'];
$inputGroupName = $_SESSION['groupName'];
$inputUsername = $_GET['Username'];	

//Deny pending member
$query = " DELETE FROM MemberOf
	WHERE GName = '$inputGroupName'
	AND Username = '$inputUsername';";		

mysql_query($query, $link);
	
//Send Deny Message
$query = "INSERT INTO MAILBOX
			VALUES ('0', '$inputGroupName', NOW(),
			'$inputOwner', '$inputUsername', 'Unread', 'Your membership has been denied.');";	

mysql_query($query, $link);

mysql_close($link);

header("Location: GroupPage.php");

?>