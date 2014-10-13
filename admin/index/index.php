<?php
	session_start();
	if(isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == 1){
	}else{
		header("Location:../../login/login.php");
		exit();
	}
?>
<html>
	<head>
		<title>管理平台</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
  		<link href="assets/css/bui-min.css" rel="stylesheet" type="text/css" />
   		<link href="assets/css/main-min.css" rel="stylesheet" type="text/css" />
   
	</head>
	<frameset rows="61,*,24" cols="*" framespacing="0" frameborder="no" border="0">
 		<frame src="./top.php" name="top" scrolling="no" noresize="noresize" />
		<frameset cols="200, *">
  			<frame src="./menu.php" name="menu" noresize="noresize" scrolling="no" />
  			<frame src="./main.php" name="main" noresize="noresize" scrolling="yes"/>
		</frameset>
  		<frame src="./bottom.php" name="bottom" scrolling="No" noresize="noresize" />
	</frameset>
</html>


