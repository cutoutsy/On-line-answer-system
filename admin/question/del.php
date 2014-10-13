<?php
	include "../../config/db.inc.php";
	$id = $_GET['id'];
	$delete = "delete from ctf_flag where id=$id";
	if(mysql_query($delete,$link)){
		echo '<h1 style="font-size: 20px;color: green;margin-left:400px">';
		echo "删除成功";
		echo "</h1>";
	}else{
		echo '<h1 style="font-size: 20px;color: red;margin-left:400px">';
		echo "删除失败";
		echo "</h1>";
	}
?>