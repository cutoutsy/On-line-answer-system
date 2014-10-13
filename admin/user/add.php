<?php
	include "../public/header.php";
?>
<script>
	function checkteam(){
		if(document.getElementById('team').value == ""){
			document.getElementById("teamapp").innerHTML = "不能为空";
		}else{
			document.getElementById("teamapp").innerHTML = "";
		}
	}
	function checkname(){
		if(document.getElementById('username').value == ""){
			document.getElementById("usernameapp").innerHTML = "不能为空";
		}else{
			document.getElementById("usernameapp").innerHTML = "";
		}
	}
	function checkpw(){
			var pwd1= document.getElementById('pw1').value;
			//var pwd2= document.getElementById('pw2').value;
			if(pwd1 == ""){
				document.getElementById("pw1app").innerHTML = "不能为空";
			}else{
				document.getElementById("pw1app").innerHTML = "";
			}
		}

	function checkpwag(){
		var pwd1= document.getElementById('pw1').value;
		var pwd2= document.getElementById('pw2').value;
		if(pwd1 != pwd2){
			document.getElementById("pw2app").innerHTML = "密码不一致";
			//return false;
		}else{
			document.getElementById("pw2app").innerHTML = "";
		}
	}
</script>
		<div id="main">
			<div class="head-dark-box">
				<div class="tit">系统管理>用户管理>添加用户</div>
			</div>	
		    <form  method="post" action="#">
			<div class="msg-box">
				<ul class="viewmess">
					<li class="dark-row">
						<span class="col_width">队伍名称<span class="red_font">*</span></span>
						<input name="teamname" type="text" onblur="checkteam()" id="team" value="" class="text-box">
						<span id="teamapp" style="color:red"></span>
					</li>
					<li class="light-row">
						<span class="col_width">用户名&nbsp;&nbsp;&nbsp;<span class="red_font">*</span></span>
						<input name="username" type="text" onblur="checkname()" id="username" value="" class="text-box">
						<span id="usernameapp" style="color:red"></span>
					</li>
					<li class="dark-row">
						<span class="col_width">登录密码<span class="red_font">*</span></span>
						<input name="userpwd" type="password" onblur="checkpw()" id="pw1" value="" class="text-box"> 
						<span id="pw1app" style="color:red"></span>
					</li>
					<li class="light-row">
						<span class="col_width">确认密码<span class="red_font">*</span></span>
						<input name="repwd" type="password"  onblur="checkpwag()" id="pw2" value=""  size="20" class="text-box">
						<span id="pw2app" style="color:red"></span>
					</li>
					<li class="light-row">
						<span class="col_width"> &nbsp; </span>
						<input type="submit" class="button"  name="insert" value="添 加">&nbsp;&nbsp;
						<input type="reset" class="button" value="重 置">
					</li>

				</ul>	
			</div>
                    </form>	
		</div>

<?php
	include "../../config/db.inc.php";
	if(isset($_POST['insert'])){
		$username = $_POST['username'];
		$pwd = md5($_POST['userpwd']);
		$teamname = $_POST['teamname'];
		$date = date("Y-m-d");
		$insert = "insert into ctf_member(username,userpwd,teamname,registerdate) values('$username','$pwd','$teamname','$date')";
		if(mysql_query($insert,$link)){
			echo '<h1 style="font-size: 20px;color: green;margin-left:400px">';
			echo $username."添加成功";
			echo "</h1>";
		}else{
			//echo mysql_error();
			echo '<h1 style="font-size: 20px;color: red;margin-left:400px">';
			echo $username."添加失败";
			echo "</h1>";
		}
	}
?>
<?php
	include "../public/footer.php";
?>	


