<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputText = $_POST['inputSearchText'];
$inputGroupName = $_SESSION['groupName'];

echo '<form action="GroupPage.php" method="link">
		<input type="submit" value="Back">
		</form>';

//Search Results
$query = "SELECT * FROM THREAD
			WHERE THREAD.Title IN
			(SELECT DISTINCT Thread FROM POST
			WHERE POST.Text LIKE '%$inputText%'
			AND POST.GName = '$inputGroupName')
			AND THREAD.GName = '$inputGroupName';";	

$result = mysql_query($query, $link);

$count = mysql_numrows($result);

//Display Threads
echo "<b>Search Results</b>";
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
	
?>