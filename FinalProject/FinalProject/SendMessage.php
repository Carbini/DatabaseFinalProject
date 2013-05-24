<?php
echo '<form action="Mailbox.php" method="link">
		<input type="submit" value="Back">
		</form>';

echo '<b>Send Message</b>
			<form action="MessageSent.php" method="post">
			To:	<input type="text" name="inputReceiver" />
			Subject: <input type="text" name="inputSubject" />
			<br>Message: <br><textarea name="inputMessage" cols = "25" rows = "5"/></textarea>
			<input type="submit" value="Send" />
			</form>';

?>