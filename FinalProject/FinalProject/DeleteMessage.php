<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputMessageID = $_SESSION['messageID'];

$query = "UPDATE MAILBOX
			SET Status = 'Deleted'
			WHERE MessageNo = '$inputMessageID';";	

mysql_query($query, $link);

mysql_close($link);

header("Location: Mailbox.php");
?>