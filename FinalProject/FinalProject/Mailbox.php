<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputUsername = $_SESSION['username'];


echo '<form action="UserHome.php" method="link">
		<input type="submit" value="Back">
		</form>';

//Display inbox table
$query = "SELECT * FROM MAILBOX
				WHERE Receiver = '$inputUsername'
				AND Status != 'Deleted';";		

$result = mysql_query($query, $link);

$count = mysql_numrows($result);

echo "<b>Inbox</b>";
echo   "<table border = '1'>
        	        <tr>
            	   	<td><b>Subject</b></td>
                	<td><b>Date & Time</b></td>
					<td><b>Sender</b></td>
					<td><b>Status</b></td>
             	  	</tr>";

for($i=0; $i<$count; $i++)
{
	$MessageNo = mysql_result($result,$i,"MessageNo");

	echo    "<tr><td>";
	echo "<a href='ViewMessage.php?MessageNo=$MessageNo'>";
	echo mysql_result($result,$i,"Subject");
	echo    "</a></td><td>";
	echo mysql_result($result,$i,"DateTime");
	echo    "</td><td>";
	echo mysql_result($result,$i,"Sender");
	echo    "</td><td>";
	echo mysql_result($result,$i,"Status");
	echo	"</td></tr>";
}
	echo	"</table><br>";
	

//Display sent table
$query = "SELECT * FROM MAILBOX
				WHERE Sender = '$inputUsername';";		

$result = mysql_query($query, $link);

$count = mysql_numrows($result);	
	
echo "<b>Sent</b>";
echo   "<table border = '1'>
        	        <tr>
            	   	<td><b>Subject</b></td>
                	<td><b>Date & Time</b></td>
					<td><b>Receiver</b></td>
             	  	</tr>";

for($i=0; $i<$count; $i++)
{
	echo    "<tr><td>";
	echo mysql_result($result,$i,"Subject");
	echo    "</td><td>";
	echo mysql_result($result,$i,"DateTime");
	echo    "</td><td>";
	echo mysql_result($result,$i,"Receiver");
	echo	"</td></tr>";
}
	echo	"</table>";	

//Send a message
echo '<br><b>Send Message</b>';
echo '<form action="SendMessage.php" method="link">
		<input type="submit" value="New Message">			
		</form>';
	
mysql_close($link);

?>