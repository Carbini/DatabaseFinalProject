<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputUsername = $_SESSION['username'];

$inputGroupName = $_POST['inputGroupName'];
$inputDescription = $_POST['inputDescription'];

//Create Group
$query = "INSERT INTO FORUM_GROUP
	VALUES ('$inputGroupName', '$inputDescription', NULL, 'Pending', '$inputUsername');";		
	
mysql_query($query, $link);

//Adds owner to group members
$query = "INSERT INTO MemberOf
	VALUES ('$inputGroupName', '$inputUsername', 'Approved');";	
	
mysql_query($query, $link);

mysql_close($link);

header("Location: UserHome.php");

?>