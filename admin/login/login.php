<html>
	<head>
		<title>我的后台</title>
		<meta http-equiv="Windows-Target" content="_top" />
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta http-equiv="Windows-Target" content="_top" />
		<link rel="stylesheet" type="text/css" href="../resource/css/style.css" />
		<script>
			function newgdcode(obj,url){
				obj.src = url+'?nowtime='+new Date().getTime();
			}
		</script>
	</head>

<body class="center" onload="document.getElementById('login-form').username.focus()">
<div id="login-box">
<div id="main">
	<div class="head-dark-box">
		&nbsp;<b>管理平台登录</b>
	</div>

	<form method="post" action="./handle_login.php" id="login-form">
		<ul>	
			<li style="height:25px" class="dark-row" >
				<span class="list_width">用户名</span>
				<input type="text" class="text-box" size="15" name="username">
			</li>
			<li style="height:25px" class="light-row">
				<span class="list_width">密&nbsp;&nbsp;&nbsp;码</span>
				<input type="password" class="text-box" size="15" name="userpwd">
			</li>
			<li style="height:25px" class="dark-row">
				<span class="list_width">验证码</span>
				<input type="text" onkeyup="if (this.value != this.value.toUpperCase()) this.value=this.value.toUpperCase();"  class="text-box" size="6" name="code" />
				<img style="cursor:pointer;" alt="看不清，换一张" onclick="javascript:newgdcode(this,this.src);" src="imgcode.php" />
			</li>
			<li style="height:25px" class="light-row">
				<input type="hidden" name="action" value="login"> 
				<span class="list_width">&nbsp;</span>
				<input type="submit" class="button" name="sub" value="登录系统" />
			</li>
		</ul>
	</form>
</div>
</div>
</body>
</html>

