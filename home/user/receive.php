<?php
	session_start();
	include "../../config/db.inc.php";
	$username = $_SESSION['username'];
	$sql = "select id,num,score,explaination from ctf_receive where username='$username' and status=1";

	$result = mysql_query($sql);
	
	if($result && mysql_num_rows($result) > 0){
		list($id,$num,$score,$explaination) = mysql_fetch_row($result);
		echo '<h4 class="ttitle">题号：'.$num.'</h4>';
		echo '<p id="sscore">分数:'.$score.'</p>';
		echo '<p>说明：'.$explaination.'</p>';
	}
	
?>