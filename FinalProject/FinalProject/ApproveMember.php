<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputGroupName = $_SESSION['groupName'];
$inputUsername = $_GET['Username'];	

//Approve pending member
$query = "UPDATE MemberOf
	SET Status = 'Approved'
	WHERE GName = '$inputGroupName'
	AND Username = '$inputUsername';";		
	
mysql_query($query, $link);

mysql_close($link);

header("Location: GroupPage.php");

?>