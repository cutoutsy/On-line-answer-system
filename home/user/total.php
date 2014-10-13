<?php
	include "../../config/db.inc.php";
    $sql = @mysql_query("select * from ctf_flag");
    $row = @mysql_num_rows($sql);
    echo $row;
?>