<?php
	session_start();
	include "../../config/db.inc.php";
	$username = $_SESSION['username'];
	$sql = "select num from ctf_process where username='$username' and status=0";
	$result = mysql_query($sql);
	if($result && mysql_num_rows($result) > 0){
		list($num) = mysql_fetch_row(mysql_query($sql));
		echo $num;
	}else{
		echo "";
	}
	
?>