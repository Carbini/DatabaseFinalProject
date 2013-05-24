<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputGroupName = $_SESSION['groupName'];
$inputUsername = $_SESSION['username'];

//Search for Members
$query = "SELECT * FROM MemberOf 
			WHERE GName = '$inputGroupName'
			ORDER BY Username;";	

$result = mysql_query($query, $link);

$count = mysql_numrows($result);

echo '<form action="GroupPage.php" method="link">
		<input type="submit" value="Back to Group">
		</form>';

echo $inputGroupName;
echo " Members";


//Check if group owner
$query3 = "SELECT * FROM FORUM_GROUP
	WHERE GName = '$inputGroupName'
	AND OwnerOf = '$inputUsername';";		

$result3 = mysql_query($query3, $link);

$count3 = mysql_numrows($result3);

//If owner
if($count3 == 1)
{
	echo   "<table border = '1'>
						<tr>
						<td><b>Username</b></td>
						<td><b>Avatar</b></td>
						<td><b>Status</b></td>
						<td><b>Profile</b></td>
						<td><b>Remove</b></td>
						</tr>";

	for($i=0; $i<$count; $i++)
	{
		$match = mysql_result($result,$i,"Username");
			
		$query2 = "SELECT * FROM USER 
				WHERE Username = '$match';";

		$temp = mysql_query($query2, $link);

		$inputTempUsername = mysql_result($temp,0,"Username");

		echo    "<tr><td>";
		echo $inputTempUsername;
		echo    "</td><td>";
		?><img src = "PhotoSource.php?username=<? echo $inputTempUsername;?>" /><?
		echo    "</td><td>";
		echo mysql_result($temp,0,"Status");
		echo    "</td><td>";
		echo "<form action='UserProfile.php?Username=$inputTempUsername' method='post'>
			<input type='submit' value='View'>
			</form>";
		echo    "</td><td>";
		echo "<form action='RemoveMember.php?Username=$inputTempUsername' method='post'>
			<input type='submit' value='Remove'>
			</form>";
		echo	"</td></tr>";
	}
		echo	"</table><br>";
}
//Normal member or admin
else
{
	echo   "<table border = '1'>
						<tr>
						<td><b>Username</b></td>
						<td><b>Avatar</b></td>
						<td><b>Status</b></td>
						<td><b>Profile</b></td>
						</tr>";

	for($i=0; $i<$count; $i++)
	{
		$match = mysql_result($result,$i,"Username");
			
		$query2 = "SELECT * FROM USER 
				WHERE Username = '$match';";

		$temp = mysql_query($query2, $link);

		$inputTempUsername = mysql_result($temp,0,"Username");

		echo    "<tr><td>";
		echo $inputTempUsername;
		echo    "</td><td>";
		?><img src = "PhotoSource.php?username=<? echo $inputTempUsername;?>" /><?
		echo    "</td><td>";
		echo mysql_result($temp,0,"Status");
		echo    "</td><td>";
		echo "<form action='UserProfile.php?Username=$inputTempUsername' method='post'>
			<input type='submit' value='View'>
			</form>";
		echo	"</td></tr>";
	}
		echo	"</table><br>";
}

mysql_close($link);
?>