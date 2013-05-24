<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputViewerUsername = $_SESSION['username'];
if(isset($_GET['Username']))
	$_SESSION['ProfileUsername'] = $_GET['Username'];	
$inputProfileUsername = $_SESSION['ProfileUsername'];

echo '<form action="UserHome.php" method="link">
		<input type="submit" value="Homepage">
		</form>';

$query = "SELECT * FROM USER
				WHERE Username = '$inputProfileUsername';";	

$result = mysql_query($query, $link);


echo $inputProfileUsername;
echo "'s Profile<br><br>";

//Check if admin
$query2 = "SELECT * FROM USER
				WHERE Username = '$inputViewerUsername'
				AND Status = 'Admin';";	

$result2 = mysql_query($query2, $link);

$count2 = mysql_numrows($result2);

if($count2 == 1)
{
	//Status
	echo   "<table border = '1'>
				<tr>
				<td><b>Member Status</b></td>
				<td><b>Edit</b></td>
				</tr>";
				
	echo    "<tr><td>";
	echo mysql_result($result,0,"Status");
	echo    "</td><td>";
	echo	"<form action='EditStatus.php' method='link'>
				<input type='submit' value='Edit'>
				</form>";
	echo	"</td></tr>";
	echo	"</table><br>";
	
	//Full Name
	echo   "<table border = '1'>
				<tr>
				<td><b>Full Name</b></td>
				<td><b>Edit</b></td>
				</tr>";
				
	echo    "<tr><td>";
	echo mysql_result($result,0,"FullName");
	echo    "</td><td>";
	echo	"<form action='EditFullName.php' method='link'>
				<input type='submit' value='Edit'>
				</form>";
	echo	"</td></tr>";
	echo	"</table><br>";

	//Description
	echo   "<table border = '1'>
				<tr>
				<td><b>Description</b></td>
				<td><b>Edit</b></td>
				</tr>";
				
	echo    "<tr><td>";
	echo mysql_result($result,0,"Description");
	echo    "</td><td>";
	echo	"<form action='EditDescription.php' method='link'>
				<input type='submit' value='Edit'>
				</form>";
	echo	"</td></tr>";
	echo	"</table><br>";

	//Picture
	echo   "<table border = '1'>
				<tr>
				<td><b>Avatar</b></td>
				<td><b>Edit</b></td>
				</tr>";
				
	echo    "<tr><td>";
	?><img src = "PhotoSource.php?username=<? echo $inputProfileUsername;?>" /><?
	echo    "</td><td>";
	echo	"<form action='EditPicture.php' method='link'>
				<input type='submit' value='Edit'>
				</form>";
	echo	"</td></tr>";
	echo	"</table><br>";
	
}//END IF ADMIN
//Check if it's the viewers profile
else if($inputViewerUsername == $inputProfileUsername)
{
	//Status
	echo   "<table border = '1'>
				<tr>
				<td><b>Member Status</b></td>
				</tr>";
				
	echo    "<tr><td>";
	echo mysql_result($result,0,"Status");
	echo	"</td></tr>";
	echo	"</table><br>";
	
	//Full Name
	echo   "<table border = '1'>
				<tr>
				<td><b>Full Name</b></td>
				<td><b>Edit</b></td>
				</tr>";
				
	echo    "<tr><td>";
	echo mysql_result($result,0,"FullName");
	echo    "</td><td>";
	echo	"<form action='EditFullName.php' method='link'>
				<input type='submit' value='Edit'>
				</form>";
	echo	"</td></tr>";
	echo	"</table><br>";

	//Description
	echo   "<table border = '1'>
				<tr>
				<td><b>Description</b></td>
				<td><b>Edit</b></td>
				</tr>";
				
	echo    "<tr><td>";
	echo mysql_result($result,0,"Description");
	echo    "</td><td>";
	echo	"<form action='EditDescription.php' method='link'>
				<input type='submit' value='Edit'>
				</form>";
	echo	"</td></tr>";
	echo	"</table><br>";

	//Picture
	echo   "<table border = '1'>
				<tr>
				<td><b>Avatar</b></td>
				<td><b>Edit</b></td>
				</tr>";
				
	echo    "<tr><td>";
	?><img src = "PhotoSource.php?username=<? echo $inputProfileUsername;?>" /><?
	echo    "</td><td>";
	echo	"<form action='EditPicture.php' method='link'>
				<input type='submit' value='Edit'>
				</form>";
	echo	"</td></tr>";
	echo	"</table><br>";
		
	//Edit Password
	echo	"<form action='EditPassword.php' method='link'>
				<input type='submit' value='Change Password'>
				</form>";
}
//Else just a viewer
else
{
	//Status
	echo   "<table border = '1'>
				<tr>
				<td><b>Member Status</b></td>
				</tr>";
				
	echo    "<tr><td>";
	echo mysql_result($result,0,"Status");
	echo	"</td></tr>";
	echo	"</table><br>";
	
	//Full Name
	echo   "<table border = '1'>
				<tr>
				<td><b>Full Name</b></td>
				</tr>";
				
	echo    "<tr><td>";
	echo mysql_result($result,0,"FullName");
	echo	"</td></tr>";
	echo	"</table><br>";

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
				<td><b>Avatar</b></td>
				</tr>";
				
	echo    "<tr><td>";
	?><img src = "PhotoSource.php?username=<? echo $inputProfileUsername;?>" /><?
	echo	"</td></tr>";
	echo	"</table><br>";
}		
	
mysql_close($link);
?>