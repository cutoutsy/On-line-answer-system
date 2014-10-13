<?php
	include "config.inc.php";
	$link = @mysql_connect(HOST,USER,PASS);
	if (!$link)
	{
		die('Could not connect: ' . mysql_error());
	}
	if(mysql_select_db(DBNAME, $link)){
	}else{
		echo 'choose database failed!';
	}

