<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputProfileUsername = $_SESSION['ProfileUsername'];
$inputStatus = $_POST['dropdown'];

$query = "UPDATE USER
			SET Status = '$inputStatus'
			WHERE Username = '$inputProfileUsername';";	

mysql_query($query, $link);

//If Removed, delete from all groups
if($inputStatus == 'Removed')
{
	$query = "DELETE FROM MemberOf
			WHERE Username = '$inputProfileUsername';";	
			
	mysql_query($query, $link);
}

mysql_close($link);

header("Location: UserProfile.php");
?>