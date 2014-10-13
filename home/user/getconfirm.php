<?php
    session_start();
	include "../../config/db.inc.php";
	$num = $_POST['num'];
	$key = $_POST['userkey'];
    $username = $_SESSION['username'];

    $sjudge = "select finish from ctf_member where username='$username'";
    $judge = mysql_query($sjudge);
    list($finish) = mysql_fetch_row($judge);
    $finsharr=explode("-",$finish); 
    if(in_array($num, $finsharr)){
        echo "已经提交，不能重复提交";
    }else{
        	$sql = "select score,anskey from ctf_flag where num=$num";
            $result = mysql_query($sql);
            if($result && mysql_num_rows($result) > 0){
                list($score,$anskey) = mysql_fetch_row($result);
                if ($key==$anskey) {
                	echo "key正确";
                    $getscore = "select score from ctf_member where username='$username'";
                    list($nowscore) = mysql_fetch_row(mysql_query($getscore));
                    $putscore = $nowscore+$score;
                    $setscore = "update ctf_member set score=$putscore where username='$username'";
                    mysql_query($setscore);
                    //$finish = $num.",";
                    $getfinish = "select finish from ctf_member where username='$username'";
                    list($nowfinish) = mysql_fetch_row(mysql_query($getfinish));
                    $putfinish = $nowfinish.$num."-";
                    $setfinish = "update ctf_member set finish='$putfinish' where username='$username'";
                    mysql_query($setfinish);
                }else{
                	echo "key错误";
                }
                
            }
        }
?>