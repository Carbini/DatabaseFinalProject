<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputUsername = $_SESSION['username'];
$inputGroupName = $_SESSION['groupName'];

//Add to pending members
$query = "INSERT INTO MemberOf
	VALUES ('$inputGroupName', '$inputUsername', 'Pending');";		
	
mysql_query($query, $link);

mysql_close($link);

header("Location: GroupPage.php");

?>