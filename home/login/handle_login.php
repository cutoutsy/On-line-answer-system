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
	if(isset($_POST['login']) and $_POST['username']!=null and $_POST['userpwd'] != null){
		$user = $_POST['username'];
		$pass = md5($_POST['userpwd']);

		$getuser = "select * from ctf_member where username='".mysql_real_escape_string($user)."'";
		$result = mysql_query($getuser);
		$array_row = @mysql_fetch_array($result);
		if($array_row['status'] == 0){
			if(!$array_row){
				echo "<script>alert('用户名不存在!');location.href='./login.html'</script>";
				exit();
			}
			if($pass == $array_row['userpwd']){
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['id'] = $array_row['id'];
				$_SESSION['user_share'] = md5($array_row['id'].$array_row['userpwd']);
				$_SESSION["isLogin"] = 1;
				echo "<script>alert('登录成功!')</script>";
				header("location:../user/user.php");
			}else{
				echo "<script>alert('密码错误!');location.href='./login.html'</script>";
			}
		}else{
			echo "<script>alert('该账号已登录过!');location.href='./login.html'</script>";
			exit();
		}
	}else{
		echo "<script>alert('用户名密码不能为空!');location.href='./login.html'</script>";
	}
}

?>