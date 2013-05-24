<?php
$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19", $link);

session_start();
$inputUsername = $_GET['username'];


$photoData = mysql_query("SELECT * FROM USER WHERE Username = '$inputUsername';", $link);

$photoData = mysql_fetch_assoc($photoData);
$photoData = $photoData['Picture'];

header("Content-type: image/jpeg");

echo $photoData;

mysql_close($link); 
?>
