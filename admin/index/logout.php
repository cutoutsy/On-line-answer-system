<?php
	session_start();
	$username = $_SESSION['username'];

	$_SESSION = array();

	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),'',time()-4200,'/');
	}
	session_destroy();

	header("Location:../../admin.php");
?>