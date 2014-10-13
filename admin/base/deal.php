<?php
	include "../../config/db.inc.php";

	$sql = "select * from ctf_process where status=0";

	$result = mysql_query($sql);
	if($result && mysql_num_rows($result) > 0){
		echo "新提交";
	}
?>
