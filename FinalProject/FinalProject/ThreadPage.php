<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputGroupName = $_SESSION['groupName'];
$inputUsername = $_SESSION['username'];
if(isset($_GET['threadName']))
	$_SESSION['threadName'] = $_GET['threadName'];	
$inputThreadName = $_SESSION['threadName'];

//Search for thread posts
$query = "SELECT * FROM POST 
			WHERE Thread = '$inputThreadName'
			AND GName = '$inputGroupName'
			ORDER BY PostNo;";	

$result = mysql_query($query, $link);

$count = mysql_numrows($result);

$_SESSION['postCount'] = $count;

echo '<form action="GroupPage.php" method="link">
		<input type="submit" value="Group Homepage">
		</form>';

echo $inputThreadName;

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
						<td><b>Delete</b></td>
						<td><b>Text</b></td>
						<td><b>Date</b></td>
						<td><b>Author</b></td>
						<td><b>Avatar</b></td>
						<td><b>Profile</b></td>
						</tr>";

	for($i=0; $i<$count; $i++)
	{
		$tempPostNo = mysql_result($result,$i,"PostNo");

		echo    "<tr><td>";
		echo "<form action='DeletePost.php?postNo=$tempPostNo' method='post'>
			<input type='submit' value='Delete'>
			</form>";
		echo    "</td><td>";
		echo mysql_result($result,$i,"Text");
		echo    "</td><td>";
		echo mysql_result($result,$i,"StartDateTime");
		echo    "</td><td>";
		echo mysql_result($result,$i,"Author");
		echo    "</td><td>";
		$inputTempUsername = mysql_result($result,$i,"Author");
		?><img src = "PhotoSource.php?username=<? echo $inputTempUsername;?>" /><?
		echo    "</td><td>";
		$inputTempUsername = mysql_result($result,$i,"Author");
		echo "<form action='UserProfile.php?Username=$inputTempUsername' method='post'>
			<input type='submit' value='View'>
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
						<td><b>Delete</b></td>
						<td><b>Text</b></td>
						<td><b>Date</b></td>
						<td><b>Author</b></td>
						<td><b>Avatar</b></td>
						<td><b>Profile</b></td>
						</tr>";

	for($i=0; $i<$count; $i++)
	{
		echo    "<tr><td>";
		
		$tempPostAuthor = mysql_result($result,$i,"Author");
		
		if($tempPostAuthor == $inputUsername)
		{
			$tempPostNo = mysql_result($result,$i,"PostNo");

			echo "<form action='DeletePost.php?postNo=$tempPostNo' method='post'>
				<input type='submit' value='Delete'>
				</form>";
		}
		
		echo    "</td><td>";
		echo mysql_result($result,$i,"Text");
		echo    "</td><td>";
		echo mysql_result($result,$i,"StartDateTime");
		echo    "</td><td>";
		echo mysql_result($result,$i,"Author");
		echo    "</td><td>";
		$inputTempUsername = mysql_result($result,$i,"Author");
		?><img src = "PhotoSource.php?username=<? echo $inputTempUsername;?>" /><?
		echo    "</td><td>";
		$inputTempUsername = mysql_result($result,$i,"Author");
		echo "<form action='UserProfile.php?Username=$inputTempUsername' method='post'>
			<input type='submit' value='View'>
			</form>";
		echo	"</td></tr>";
	}
		echo	"</table><br>";
}

//Post to thread
echo '<b>Create a new post</b>';
echo '<form action="CreatePost.php" method="link">
		<input type="submit" value="Create">
		</form>';

mysql_close($link);
?>