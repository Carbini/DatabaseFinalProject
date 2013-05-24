<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputUsername = $_SESSION['username'];
$inputGroupName = $_SESSION['groupName'];

$inputTitle = $_POST['inputTitle'];
$inputText = $_POST['inputText'];

//Create Thread
$query = "INSERT INTO THREAD
	VALUES ('$inputTitle', '$inputGroupName', NOW(), '$inputUsername');";		
	
mysql_query($query, $link);

//Create Post
$query = "INSERT INTO POST
	VALUES ('$inputGroupName', '$inputTitle', '1', '$inputText', NOW(), '$inputUsername');";	
	
mysql_query($query, $link);

mysql_close($link);

header("Location: GroupPage.php");

?>