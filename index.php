<?php
session_start();

if(!isset($_SESSION["username"])){
	echo '<form method="POST" action="login.php">
<input type="text" id="u" placeholder="username" name="u"/>
<input type="password" id="p" placeholder="password" name="p"/>
<input type="submit" value="Login"></form>';
	}
	else{echo "успех";}
?>