<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputGroupName = $_SESSION['groupName'];
$inputUsername = $_GET['Username'];

$query = "DELETE FROM MemberOf
			WHERE Username = '$inputUsername'
			AND GName = '$inputGroupName';";	
			
mysql_query($query, $link);

mysql_close($link);

header("Location: MemberList.php");
?>