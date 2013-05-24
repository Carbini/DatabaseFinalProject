<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputUsername = $_POST['inputUsername'];

echo '<form action="UserHome.php" method="link">
		<input type="submit" value="Back">
		</form>';

//Search Results
$query = "SELECT * FROM USER 
			WHERE Username LIKE '$inputUsername%'
			AND Status != 'Removed'
			ORDER BY Username;";	

$result = mysql_query($query, $link);

$count = mysql_numrows($result);

echo "<b>Search Results</b>";
echo   "<table border = '1'>
        	        <tr>
                	<td><b>Username</b></td>
            	   	<td><b>Avatar</b></td>
					<td><b>Status</b></td>
					<td><b>Profile</b></td>
             	  	</tr>";

for($i=0; $i<$count; $i++)
{
	$inputTempUsername = mysql_result($result,$i,"Username");

	echo    "<tr><td>";
	echo $inputTempUsername;
	echo    "</td><td>";
	?><img src = "PhotoSource.php?username=<? echo $inputTempUsername;?>" /><?
	echo    "</td><td>";
	echo mysql_result($result,$i,"Status");
	echo    "</td><td>";
	echo "<form action='UserProfile.php?Username=$inputTempUsername' method='post'>
		<input type='submit' value='View'>
		</form>";
	echo	"</td></tr>";
}
	echo	"</table><br>";
	
?>