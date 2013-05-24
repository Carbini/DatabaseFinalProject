<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputThreadName = $_SESSION['threadName'];
$inputGroupName = $_SESSION['groupName'];
$inputPostNo = $_GET['postNo'];

$query = "UPDATE POST
			SET Text = '~Post has been deleted~'
			WHERE PostNo = '$inputPostNo'
			AND Thread = '$inputThreadName'
			AND GName = '$inputGroupName';";	

mysql_query($query, $link);

mysql_close($link);

header("Location: ThreadPage.php");
?>