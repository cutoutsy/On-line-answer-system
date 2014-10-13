<?php
	session_start();
	require "../../config/db.inc.php";
	$username = $_SESSION['username'];
	$getstarttime = "select starttime from ctf_member where username='$username'";
	list($starttime) = mysql_fetch_row(mysql_query($getstarttime));
	if ($starttime == 0) {
		echo "0";
	}else{
		$nowtime = time();
		$divktime = $nowtime - $starttime;
		$backtime = 7200 - $divktime;
		echo $backtime;
	}

?>