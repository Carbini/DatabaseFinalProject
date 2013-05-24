<?php
session_start(); 
session_destroy();
?>

<html>

Daniel Lyons<br>
Derek Marsi<br>
Ryan Reed<br><br>
CPSC 431<br>
December 2012<br>
Final Project<br><br>


<?php

$link = mysql_connect('ecsmysql', 'cs431f19', 'azieghez');
if (!$link) {
   die('Could not connect: ' . mysql_error());
}

mysql_select_db("cs431f19",$link);

mysql_close($link);

?>

<b>Login</b>
<form action="Login.php" method="post">
Username:	<input type="text" name="inputUsername" />
Password:	<input type="password" name="inputPassword" />
	<input type="submit" value="Login" />
</form><br>


<b>Register</b>
<form action="Register.php" method="post">
Username:	<input type="text" name="inputUsername" />
	<input type="submit" value="Register" />
</form>

</html>