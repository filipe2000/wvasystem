<?php
if (isset($_REQUEST['sair'])) {
	session_destroy();
	session_unset('user');
	session_unset('pswd');
	header("Location: index.php");
}

?>