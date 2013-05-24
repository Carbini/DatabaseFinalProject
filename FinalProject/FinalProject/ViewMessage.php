<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputUsername = $_SESSION['username'];
$inputMessageID = $_GET['MessageNo'];
$_SESSION['messageID']=$inputMessageID;

//Option to go back to inbox
echo '<form action="Mailbox.php" method="link">
	<input type="submit" value="Back">
	</form>';

$query = "SELECT * FROM MAILBOX
				WHERE MessageNo = '$inputMessageID'
				AND Receiver = '$inputUsername'
				AND Status != 'Deleted';";	

$result = mysql_query($query, $link);

$count = mysql_numrows($result);

if($count > 0)
{
	//Display message
	echo   "<table border = '1'>
				<tr>
				<td><b>MessageNo</b></td>
				<td><b>Subject</b></td>
				<td><b>Date & Time</b></td>
				<td><b>Sender</b></td>
				<td><b>Status</b></td>
				</tr>";
	echo    "<tr><td>";
	echo mysql_result($result,0,"MessageNo");
	echo    "</td><td>";
	echo mysql_result($result,0,"Subject");
	echo    "</td><td>";
	echo mysql_result($result,0,"DateTime");
	echo    "</td><td>";
	echo mysql_result($result,0,"Sender");
	echo    "</td><td>";
	echo mysql_result($result,0,"Status");
	echo	"</td></tr>";
	echo	"</table><br>";
	
	echo	"<table border = '1'>
			<tr>
			<td><b>Message</b></td>
			</tr>";
	echo	"<tr><td>";
	echo mysql_result($result,0,"Text");
	echo	"</td></tr>";
	echo	"</table><br>";
	
	//Change message to read
	$query = " UPDATE MAILBOX
				SET Status = 'Read'
				WHERE MessageNo = '$inputMessageID';";

	mysql_query($query, $link);
	
	mysql_close($link);
	
	//Option to delete message
	echo '<b>Delete Message</b>';
	echo '<form action="DeleteMessage.php" method="link">
		<input type="submit" value="Delete">
		</form>';
}
?>