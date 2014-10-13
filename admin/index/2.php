<?php
	include "../../config/db.inc.php";
	include "../../classes/ajaxpage.class.php";
	$randnum=rand(1,3);

	$sql = "select username from ctf_process where id=$randnum";

	$result = mysql_query($sql);
	if($result && mysql_num_rows($result) > 0){
		echo "有答案提交了...";
	}
?>