<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputGroupName = $_POST['inputGroupName'];

echo '<form action="UserHome.php" method="link">
		<input type="submit" value="Back">
		</form>';

//Search Results
$query = "SELECT * FROM FORUM_GROUP 
			WHERE GName LIKE '$inputGroupName%'
			AND Status = 'Approved'
			ORDER BY GName;";	

$result = mysql_query($query, $link);

$count = mysql_numrows($result);

echo "<b>Search Results</b>";
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
	?><img src = "PhotoSourceGroup.php?groupName=<? echo $groupName;?>" /><?
	echo    "</td><td>";
	echo "<a href='GroupPage.php?groupName=$groupName'>";
	echo	$groupName;
	echo "</a><br><br>";
	echo    "</td><td>";
	echo mysql_result($temp,0,"Description");
	echo    "</td><td>";
	echo mysql_result($temp,0,"OwnerOf");
	echo	"</td></tr>";
}
	echo	"</table><br>";
	
?>