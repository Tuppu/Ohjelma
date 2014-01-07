<?php
session_start();
?>

<form method = "post" action = "checklogin.php">

	Username <input type = "text" id = "myusername" name = "myusername"/><br/>
	Password <input type = "password" id = "mypassword" name = "mypassword"/><br/>

	<input type = "submit" name = "submit" value = "Login"/>
</form>