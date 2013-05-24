<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputUsername = $_SESSION['username'];
$inputReceiver = $_POST['inputReceiver'];
$inputSubject = $_POST['inputSubject'];
$inputMessage = $_POST['inputMessage'];

$query = "INSERT INTO MAILBOX
			VALUES ('0', '$inputSubject', NOW(),
			'$inputUsername', '$inputReceiver', 'Unread', '$inputMessage');";	

mysql_query($query, $link);

mysql_close($link);

header("Location: Mailbox.php");
?>