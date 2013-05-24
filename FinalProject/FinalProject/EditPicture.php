<?php
$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputProfileUsername = $_SESSION['ProfileUsername'];

echo '<form action="UserProfile.php" method="link">
		<input type="submit" value="Back">
		</form>';


if (isset($_POST['upload']))
{
	$fileName = $_FILES['photo']['tmp_name'];

	if ($_FILES["file"]["error"] > 0)
	{
		echo "Error: " . $_FILES["photo"]["error"] . "<br />";
	}
	else
	{
			$fileopen = fopen($fileName, 'rb');
			$fileread = fread($fileopen, filesize($fileName));
			$fileread = mysql_real_escape_string($fileread);
			fclose($fileopen);

			//$photoData = addslashes(file_get_contents($_FILES['pic']['tmp_name']));
			$uploaded = mysql_query("UPDATE USER SET Picture = '$fileread' WHERE Username = '$inputProfileUsername';" , $link);
		if(!$uploaded)
		{ 
			echo "Error uploading file";
		}
		else
		{
			echo $fileName;
			echo "<br>";
			echo "File uploaded.";
		}
	}
}
else if (!isset($fileName))
{
	echo "Please select a file.";
}

echo " <form action = \"EditPicture.php\" METHOD= 'post' enctype=\"multipart/form-data\"> 
   <br>
   File Location:
   <br>
   <input type=\"file\" name=\"photo\">
       <br>
   <input type=\"submit\" name=\"upload\" value=\"Upload Photo\">
       </form>";

echo " <form name = \"Return\" ACTION= \"UserProfile.php\">
   <br>
   <input type=\"submit\" value=\"Return to your profile\">
   </form>";
   
mysql_close($link); 
?>
