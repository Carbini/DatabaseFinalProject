<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputViewerUsername = $_SESSION['username'];
if(isset($_GET['GName']))
	$_SESSION['groupName'] = $_GET['GName'];	
$inputGroupName = $_SESSION['groupName'];

echo '<form action="GroupPage.php" method="link">
		<input type="submit" value="Back to Group">
		</form>';

$query = "SELECT * FROM FORUM_GROUP
				WHERE GName = '$inputGroupName';";	

$result = mysql_query($query, $link);


echo $inputGroupName;
echo "'s Profile<br><br>";

echo "Group Owner: ";
echo mysql_result($result,0,"OwnerOf");
echo "<br><br>";

//Check if admin
$query2 = "SELECT * FROM USER
				WHERE Username = '$inputViewerUsername'
				AND Status = 'Admin';";	

$result2 = mysql_query($query2, $link);

$count2 = mysql_numrows($result2);

if($count2 == 1)
{
	//Description
	echo   "<table border = '1'>
				<tr>
				<td><b>Description</b></td>
				<td><b>Edit</b></td>
				</tr>";
				
	echo    "<tr><td>";
	echo mysql_result($result,0,"Description");
	echo    "</td><td>";
	echo	"<form action='EditGroupDescription.php' method='link'>
				<input type='submit' value='Edit'>
				</form>";
	echo	"</td></tr>";
	echo	"</table><br>";

	//Picture
	echo   "<table border = '1'>
				<tr>
				<td><b>Picture</b></td>
				<td><b>Edit</b></td>
				</tr>";
				
	echo    "<tr><td>";
	?><img src = "PhotoSourceGroup.php?groupName=<? echo $inputGroupName;?>" /><?
	echo    "</td><td>";
	echo	"<form action='EditGroupPicture.php' method='link'>
				<input type='submit' value='Edit'>
				</form>";
	echo	"</td></tr>";
	echo	"</table><br>";
	
}//END IF ADMIN
//Check if it's the owner
else if($inputViewerUsername == mysql_result($result,0,"OwnerOf"))
{
	//Description
	echo   "<table border = '1'>
				<tr>
				<td><b>Description</b></td>
				<td><b>Edit</b></td>
				</tr>";
				
	echo    "<tr><td>";
	echo mysql_result($result,0,"Description");
	echo    "</td><td>";
	echo	"<form action='EditGroupDescription.php' method='link'>
				<input type='submit' value='Edit'>
				</form>";
	echo	"</td></tr>";
	echo	"</table><br>";

	//Picture
	echo   "<table border = '1'>
				<tr>
				<td><b>Picture</b></td>
				<td><b>Edit</b></td>
				</tr>";
				
	echo    "<tr><td>";
	?><img src = "PhotoSourceGroup.php?groupName=<? echo $inputGroupName;?>" /><?
	echo    "</td><td>";
	echo	"<form action='EditGroupPicture.php' method='link'>
				<input type='submit' value='Edit'>
				</form>";
	echo	"</td></tr>";
	echo	"</table><br>";
}
//Else just a viewer
else
{
	//Description
	echo   "<table border = '1'>
				<tr>
				<td><b>Description</b></td>
				</tr>";
				
	echo    "<tr><td>";
	echo mysql_result($result,0,"Description");
	echo	"</td></tr>";
	echo	"</table><br>";

	//Picture
	echo   "<table border = '1'>
				<tr>
				<td><b>Picture</b></td>

				</tr>";
				
	echo    "<tr><td>";
	?><img src = "PhotoSourceGroup.php?groupName=<? echo $inputGroupName;?>" /><?
	echo	"</td></tr>";
	echo	"</table><br>";
}		
	
mysql_close($link);
?>