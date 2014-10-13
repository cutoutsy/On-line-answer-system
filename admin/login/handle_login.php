<?php
	include "../../config/db.inc.php";
	header("Content-type:text/html;charset=utf-8");
	session_start();
	$action = $_POST['action'];
	switch($action){
		case 'login':
			login();
			break;

		default:
		break;
	}

function login(){
	if(isset($_POST['sub']) and $_POST['username']!=null and $_POST['userpwd'] != null){
		$user = $_POST['username'];
		$pass = $_POST['userpwd'];//MD5加密

		$getuser = "select * from ctf_admin where username='$user'";
		$result = mysql_query($getuser);
		$array_row = mysql_fetch_array($result);
		if(!$array_row){
			echo "<script>alert('用户名不存在!');location.href='login.php'</script>";
			exit();
		}
		if($pass == $array_row['userpwd']){
			if(strtoupper(trim($_POST['code'])) == $_SESSION['code']){
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['id'] = $array_row['id'];
				$_SESSION['user_share'] = md5($array_row['id'].$array_row['userpwd']);
				$_SESSION["isLogin"] = 1;
				header("location:../index/index.php");
			}else{
				echo "<script>alert('验证码错误!');location.href='./login.php'</script>";
			}
		}else{
			echo "<script>alert('密码错误!');location.href='login.php'</script>";
		}
	}else{
		echo "<script>alert('用户名密码不能为空!');location.href='login.php'</script>";
	}
}

?>