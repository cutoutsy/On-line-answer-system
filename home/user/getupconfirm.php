<?php
	session_start();
	include "../../config/db.inc.php";
	$num = $_POST['num'];
    //echo $num;
    $username = $_SESSION['username'];
    //$id = mysql_insert_id();

    //$newId = mysql_query("select max(id) from ctf_process",$link);
    //echo $newId;
    //list($nid) = mysql_fetch_row($newId);
    //print_r($nid);
    //$nid = $nid+1;
    /*
    $setnum = "insert into ctf_process(num) values($num)";
    if(mysql_query($setnum)){
        echo "上传成功，正在审核中...";
    }else{
        echo "上传失败，请重新提交";
    }
    */
    $pjudge = "select * from ctf_process where username='$username' and status=0 and num=$num";
    $prjudge = mysql_query($pjudge);
    if (mysql_num_rows($prjudge) > 0) {
        echo "正在审核中...";
    }else{
        $setnum = "insert into ctf_process(num) values($num)";
        if(mysql_query($setnum)){
            echo "上传成功，正在审核中...";
        }else{
            echo "上传失败，请重新提交";
        }
    }

    $sjudge = "select finish from ctf_member where username='$username'";
    $judge = mysql_query($sjudge);
    list($finish) = mysql_fetch_row($judge);
    $finsharr=explode("-",$finish); 
    if(in_array($num, $finsharr)){
        echo "该题目已完成";
    }

   

?>