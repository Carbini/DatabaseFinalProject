<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputUsername = $_SESSION['username'];

if(isset($_GET['groupName']))
	$_SESSION['groupName'] = $_GET['groupName'];	
$inputGroupName = $_SESSION['groupName'];

echo '<form action="UserHome.php" method="link">
		<input type="submit" value="Homepage">
		</form>';
echo $inputGroupName;
echo '<br><br>';

//Check if group is approved 
$query = "SELECT * FROM FORUM_GROUP
				WHERE GName = '$inputGroupName';";		

$result = mysql_query($query, $link);

if(mysql_result($result,'0',"Status") == 'Approved')
{
	//View/Edit Group Profile
	echo 'View/Edit Group Profile';	
	echo "<form action='GroupProfile.php?GName=$inputGroupName' method='post'>
			<input type='submit' value='View/Edit'>
			</form>";

	//If admin
	$query2 = "SELECT * FROM USER
				WHERE Username = '$inputUsername'
				AND Status = 'Admin';";	

	$result2 = mysql_query($query2, $link);

	$count2 = mysql_numrows($result2);

	//Check for Admin
	if($count2 == 1)
	{
		//List of pending members
		$query = "SELECT * FROM MemberOf
						WHERE GName = '$inputGroupName'
						AND Status = 'Pending';";		

		$result = mysql_query($query, $link);

		$count = mysql_numrows($result);
	
		echo "<b>Pending Members</b>";
		echo   "<table border = '1'>
							<tr>
							<td><b>Username</b></td>
							<td><b>Avatar</b></td>
							<td><b>Approve</b></td>
							<td><b>Deny</b></td>
							</tr>";
		
		for($i=0; $i<$count; $i++)
		{	
			$pendingMember = mysql_result($result,$i,"Username");
			echo    "<tr><td>";						
			echo mysql_result($result,$i,"Username");
			echo    "</td><td>";
			?><img src = "PhotoSource.php?username=<? echo $pendingMember;?>" /><?
			echo    "</td><td>";
			echo	"<form action='ApproveMember.php?Username=$pendingMember' method='post'>
						<input type='submit' value='Approve'>
						</form>";
			echo    "</td><td>";			
			echo	"<form action='DenyMember.php?Username=$pendingMember' method='post'>
						<input type='submit' value='Deny'>
						</form>";
			echo	"</td></tr>";
		}
			echo	"</table><br>";
	
		//Display Threads
		$query = "SELECT * FROM THREAD
						WHERE GName = '$inputGroupName';";		

		$result = mysql_query($query, $link);

		$count = mysql_numrows($result);

		echo "<b>Threads</b>";
		echo   "<table border = '1'>
							<tr>
							<td><b>Title</b></td>
							<td><b>Date Created</b></td>
							<td><b>Author</b></td>
							</tr>";

		for($i=0; $i<$count; $i++)
		{
			echo    "<tr><td>";
			$threadName = mysql_result($result,$i,"Title");
			echo "<a href='ThreadPage.php?threadName=$threadName'>";
			echo	$threadName;
			echo "</a>";
			echo    "</td><td>";
			echo mysql_result($result,$i,"StartDateTime");
			echo    "</td><td>";
			echo mysql_result($result,$i,"Author");
			echo	"</td></tr>";
		}
			echo	"</table><br>";
			
		//Create a thread
		echo '<a href="CreateThread.php#">Create New Thread</a><br>';
		
		//Search all posts
		echo '<br><b>Search all posts</b><br>';
		echo '<form action="PostResults.php" method="post">
			Search: <input type="text" name="inputSearchText" />
			<input type="submit" value="Search">			
			</form>';
		
		//Link to Member List
		echo '<form action="MemberList.php" method="link">
			<input type="submit" value="Member List">
			</form>';

		//Delete Group
		echo '<form action="DeleteGroup.php" method="link">
			<input type="submit" value="Delete Group">
			</form>';
	} //END IF ADMIN
	else
	{
		//Check if you're a member 
		$query = "SELECT * FROM MemberOf
					WHERE GName = '$inputGroupName'
					AND Username = '$inputUsername';";		

		$result = mysql_query($query, $link);
		
		$count = mysql_numrows($result);
	
		//Checks if you're a member
		if($count == 1)
		{
			//Check if you're approved
			if(mysql_result($result,'0',"Status") == 'Approved')
			{
				//Check if group owner
				$query = "SELECT * FROM FORUM_GROUP
					WHERE GName = '$inputGroupName'
					AND OwnerOf = '$inputUsername';";		

				$result = mysql_query($query, $link);
				
				$count = mysql_numrows($result);
				
				if($count == 1)
				{
					//Group Owner Options
						//Link to edit profile
						
						
						//List of pending members
						$query = "SELECT * FROM MemberOf
										WHERE GName = '$inputGroupName'
										AND Status = 'Pending';";		

						$result = mysql_query($query, $link);

						$count = mysql_numrows($result);
					
						echo "<b>Pending Members</b>";
						echo   "<table border = '1'>
											<tr>
											<td><b>Username</b></td>
											<td><b>Avatar</b></td>
											<td><b>Approve</b></td>
											<td><b>Deny</b></td>
											</tr>";
						
						for($i=0; $i<$count; $i++)
						{	
							$pendingMember = mysql_result($result,$i,"Username");
							echo    "<tr><td>";						
							echo mysql_result($result,$i,"Username");
							echo    "</td><td>";
							?><img src = "PhotoSource.php?username=<? echo $pendingMember;?>" /><?
							echo    "</td><td>";
							echo	"<form action='ApproveMember.php?Username=$pendingMember' method='post'>
										<input type='submit' value='Approve'>
										</form>";
							echo    "</td><td>";			
							echo	"<form action='DenyMember.php?Username=$pendingMember' method='post'>
										<input type='submit' value='Deny'>
										</form>";
							echo	"</td></tr>";
						}
							echo	"</table><br>";				
										
										
					//Display Threads
					$query = "SELECT * FROM THREAD
									WHERE GName = '$inputGroupName';";		

					$result = mysql_query($query, $link);

					$count = mysql_numrows($result);

					echo "<b>Threads</b>";
					echo   "<table border = '1'>
										<tr>
										<td><b>Title</b></td>
										<td><b>Date Created</b></td>
										<td><b>Author</b></td>
										<td><b>Delete</b></td>
										</tr>";

					for($i=0; $i<$count; $i++)
					{
						echo    "<tr><td>";
						$threadName = mysql_result($result,$i,"Title");
						echo "<a href='ThreadPage.php?threadName=$threadName'>";
						echo	$threadName;
						echo "</a>";
						echo    "</td><td>";
						echo mysql_result($result,$i,"StartDateTime");
						echo    "</td><td>";
						echo mysql_result($result,$i,"Author");
						echo    "</td><td>";
						
						$ThreadTitle = mysql_result($result,$i,"Title");
						echo	"<form action='DeleteThread.php?GName=$ThreadTitle' method='post'>
									<input type='submit' value='Delete'>
									</form>";
						echo	"</td></tr>";
					}
						echo	"</table><br>";
				}
				else
				{
					//Display Threads
					$query = "SELECT * FROM THREAD
									WHERE GName = '$inputGroupName';";		

					$result = mysql_query($query, $link);

					$count = mysql_numrows($result);

					echo "<b>Threads</b>";
					echo   "<table border = '1'>
										<tr>
										<td><b>Title</b></td>
										<td><b>Date Created</b></td>
										<td><b>Author</b></td>
										</tr>";

					for($i=0; $i<$count; $i++)
					{
						echo    "<tr><td>";
						$threadName = mysql_result($result,$i,"Title");
						echo "<a href='ThreadPage.php?threadName=$threadName'>";
						echo	$threadName;
						echo "</a>";
						echo    "</td><td>";
						echo mysql_result($result,$i,"StartDateTime");
						echo    "</td><td>";
						echo mysql_result($result,$i,"Author");
						echo	"</td></tr>";
					}
						echo	"</table><br>";
				}
				
				//Create a thread
				echo '<a href="CreateThread.php#">Create New Thread</a><br>';
				
				//Search all posts
				echo '<br><b>Search all posts</b><br>';
				echo '<form action="PostResults.php" method="post">
					Search: <input type="text" name="inputSearchText" />
					<input type="submit" value="Search">			
					</form>';
				
				//Link to Member List
				echo '<form action="MemberList.php" method="link">
					<input type="submit" value="Member List">
					</form>';
				
			} //END IF YOU'RE APPROVED
			else
			{
				echo 'Request to join this group is still pending.';
			}
		} //END IF YOU'RE A MEMBER
		else
		{
			//ASK TO JOIN
			echo 'Would you like to join this group?';
			echo '<form action="JoinGroup.php" method="link">
			<input type="submit" value="Join">
			</form>';
		}
	}//END IF ADMIN ELSE
} //END IF SITE APPROVED
else
{
	echo "Group has yet to be approved.";
}

mysql_close($link);
?>