<?php
	session_start();
	include "../../config/db.inc.php";
	$time = $_POST['time'];
	$username = $_SESSION['username'];
	$savetime = "update ctf_member set time=$time,status=1 where username='$username'";
	if (mysql_query($savetime)) {
		echo "ok";
	}else{
		echo "false";
	}
	$_SESSION = array();

	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),'',time()-4200,'/');
	}
	session_destroy();
?>