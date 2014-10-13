<?php
	include "../../classes/ajaxpage.class.php";
	$link = @mysql_connect("localhost","root","xiaochuan");
	if (!$link)
	{
		die('Could not connect: ' . mysql_error());
	}
	if(mysql_select_db("dbctf123", $link)){
	}else{
		echo 'choose database failed!';
	}
	$sql = mysql_query("select * from ctf_member");
	//$result = mysql_query($sql);
	$row = mysql_num_rows($sql);

	while(1){
		$i = 0;
		echo $i;
		$i++;
		}
	echo $row;
	$page = new AjaxPage($row);

	//$sql = "select * from ctf_member ($page->limit)";

	//$rsql = "select id,username,teamname from ctf_member order by id DESC limit 0,25";
	/*
	$rsql = "select * from ctf_member";
			echo $rsql;
			$result = mysql_query($rsql);
			while($result && mysql_num_rows($result) > 0){
				$i = 0;
				while(list($id,$username,$teamname) = mysql_fetch_row($result)){
					echo $username;
							}
						}
	*/
	echo $page->fpage();
?>