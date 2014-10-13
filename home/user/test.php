<?php
	session_start();
	include "../../config/db.inc.php";
	$username = $_SESSION['username'];
	$sql = "select id from ctf_receive where username='$username'";
	$totalsql = @mysql_query($sql);
    $totolq = @mysql_num_rows($totalsql);
    $k = 0;
   	for ($i=0; $i < $totolq; $i++) { 
    
   		while(list($id) = mysql_fetch_row($totalsql)){
   			$k++;
   			if ($k == $totolq) {
   				$usql = "update ctf_receive set status=2 where id=$id";
   				mysql_query($usql);
   			}
   		}
   	}

	


?>