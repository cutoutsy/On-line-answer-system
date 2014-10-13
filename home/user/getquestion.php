<?php
    session_start();
	include "../../config/db.inc.php";
	$num = $_POST['num'];
	$sql = "select title,status,score,content from ctf_flag where num=$num";
    $nowtime = time();
    $username = $_SESSION['username'];

    $getstarttime = "select starttime from ctf_member where username='$username'";
    list($starttime) = mysql_fetch_row(mysql_query($getstarttime));
    if ($starttime == 0) {
        $putstart = "update ctf_member set starttime=$nowtime where username='$username'" ;
        mysql_query($putstart);
    }
    
    $result = mysql_query($sql);
    if($result && mysql_num_rows($result) > 0){
        list($title,$status,$score,$content) = mysql_fetch_row($result);
        $title = "题目：".$title;
        $score = $score."分";
        echo $title."--".$score."--".$content."--".$status;
    }
    

?>