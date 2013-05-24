<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputUsername = $_SESSION['username'];
$_SESSION['memberPictures'] = array();

$query = "SELECT * FROM MAILBOX
				WHERE Receiver = '$inputUsername'
				AND Status = 'Unread';";	

$result = mysql_query($query, $link);

$count = mysql_numrows($result);

echo "Logged in as ", $inputUsername, ".";
echo '<form action="FinalProject.php" method="link">
		<input type="submit" value="Logout">
		</form>';

//Check if Banned
$query2 = "SELECT * FROM USER
				WHERE Username = '$inputUsername'
				AND Status = 'Banned';";	

$result2 = mysql_query($query2, $link);

$count2 = mysql_numrows($result2);

if($count2 == 0)		
{		
	//View/Edit Profile
	echo 'View/Edit Profile';	
	echo "<form action='UserProfile.php?Username=$inputUsername' method='post'>
			<input type='submit' value='View/Edit'>
			</form>";
			
	echo "You have ";
	echo $count;
	echo " new messages. ";

	//Link mailbox
	echo '<a href="Mailbox.php#">Your Mailbox.</a><br><br>';

	//Check if admin
	$query = "SELECT * FROM USER
					WHERE Username = '$inputUsername'
					AND Status = 'Admin';";	

	$result = mysql_query($query, $link);

	$count = mysql_numrows($result);

	if($count == 1)
	{
		//Pending Groups
		//Display inbox table
		$query = "SELECT * FROM FORUM_GROUP
						WHERE Status = 'Pending'
						ORDER BY GName;";		

		$result = mysql_query($query, $link);

		$count = mysql_numrows($result);

		echo "<b>Pending Groups</b>";
		echo   "<table border = '1'>
							<tr>
							<td><b>Group Name</b></td>
							<td><b>Description</b></td>
							<td><b>Owner</b></td>
							<td><b>Status</b></td>
							<td><b>Approve</b></td>
							<td><b>Deny</b></td>
							</tr>";

		for($i=0; $i<$count; $i++)
		{
			echo    "<tr><td>";
			echo mysql_result($result,$i,"GName");
			echo    "</td><td>";
			echo mysql_result($result,$i,"Description");
			echo    "</td><td>";
			echo mysql_result($result,$i,"OwnerOf");
			echo    "</td><td>";
			echo mysql_result($result,$i,"Status");
			echo	"</td><td>";
			
			$GName = mysql_result($result,$i,"GName");
			echo	"<form action='ApproveGroup.php?GName=$GName' method='post'>
						<input type='submit' value='Approve'>
						</form>";
			echo	"</td><td>";
			echo	"<form action='DenyGroup.php?GName=$GName' method='post'>
						<input type='submit' value='Deny'>
						</form>";
			echo	"</td></tr>";
		}
			echo	"</table><br>";

		//SHOW ALL GROUPS
		$query = "SELECT * FROM FORUM_GROUP
					ORDER BY GName;";	

		$result = mysql_query($query, $link);

		$count = mysql_numrows($result);

		echo "<b>All Groups</b>";
		echo   "<table border = '1'>
							<tr>
							<td><b>Avatar</b></td>
							<td><b>Group Name</b></td>
							<td><b>Description</b></td>
							<td><b>Owner</b></td>
							</tr>";

		for($i=0; $i<$count; $i++)
		{
			$match = mysql_result($result,$i,"GName");
			
			$query = "SELECT * FROM FORUM_GROUP 
					WHERE GName = '$match';";

			$temp = mysql_query($query, $link);
			
			$groupName = mysql_result($temp,0,"GName");
			
			echo    "<tr><td>";
			$inputGroupName = mysql_result($result,$i,"GName");
			?><img src = "PhotoSourceGroup.php?groupName=<? echo $inputGroupName;?>" /><?
			echo    "</td><td>";
			echo "<a href='GroupPage.php?groupName=$groupName'>";
			echo	$groupName;
			echo "</a>";
			echo    "</td><td>";
			echo mysql_result($temp,0,"Description");
			echo    "</td><td>";
			echo mysql_result($temp,0,"OwnerOf");
			echo	"</td></tr>";
		}
			echo	"</table><br>";
	}
	else
	{
		//Your Groups
		$query = "SELECT * FROM MemberOf 
					WHERE Username = '$inputUsername'
					ORDER BY GName;";	

		$result = mysql_query($query, $link);

		$count = mysql_numrows($result);

		echo "<b>Your Groups</b>";
		echo   "<table border = '1'>
							<tr>
							<td><b>Avatar</b></td>
							<td><b>Group Name</b></td>
							<td><b>Description</b></td>
							<td><b>Owner</b></td>
							</tr>";

		for($i=0; $i<$count; $i++)
		{
			$match = mysql_result($result,$i,"GName");
			
			$query = "SELECT * FROM FORUM_GROUP 
					WHERE GName = '$match';";

			$temp = mysql_query($query, $link);
			
			$groupName = mysql_result($temp,0,"GName");
			
			echo    "<tr><td>";
			$inputGroupName = mysql_result($result,$i,"GName");
			?><img src = "PhotoSourceGroup.php?groupName=<? echo $inputGroupName;?>" /><?
			echo    "</td><td>";
			echo "<a href='GroupPage.php?groupName=$groupName'>";
			echo	$groupName;
			echo "</a>";
			echo    "</td><td>";
			echo mysql_result($temp,0,"Description");
			echo    "</td><td>";
			echo mysql_result($temp,0,"OwnerOf");
			echo	"</td></tr>";
		}
			echo	"</table><br>";
	}//END ELSE

	//Create a group
	echo '<a href="CreateGroup.php#">Create Group</a><br>';

	//Search for more groups
	echo '<br><b>Search for a group</b><br>';
	echo '<form action="GroupResults.php" method="post">
			Group Name: <input type="text" name="inputGroupName" />
			<input type="submit" value="Search">			
			</form>';
			
	//Search for Members
	echo '<b>Search for a member</b><br>';
	echo '<form action="MemberResults.php" method="post">
			Member Username: <input type="text" name="inputUsername" />
			<input type="submit" value="Search">			
			</form>';
}//END IF BANNED
else
{
	echo 'You have been banned!';
}
mysql_close($link);	

?>