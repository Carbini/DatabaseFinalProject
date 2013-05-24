<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputUsername = $_SESSION['username'];
$inputGroupName = $_SESSION['groupName'];
$inputThreadName = $_SESSION['threadName'];
$inputPostNo = $_SESSION['postCount'] + 1;
$inputText = $_POST['inputText'];

//Create Post
$query = "INSERT INTO POST
	VALUES ('$inputGroupName', '$inputThreadName', '$inputPostNo', '$inputText', NOW(), '$inputUsername');";	
	
mysql_query($query, $link);

mysql_close($link);

header("Location: ThreadPage.php");

?>