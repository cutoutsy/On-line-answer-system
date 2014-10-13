<?php
	include "../public/header.php";
?>

		<div id="main">
			<div class="head-dark-box">
				<div class="tit">系统管理>会员管理>修改会员</div>
			</div>	
		    <form  method="post" action="#">
			<div class="msg-box">
				<ul class="viewmess">
					<li class="light-row">
						<span class="col_width">队伍名称&nbsp;&nbsp;&nbsp;<span class="red_font">*</span></span>
						<input name="teamname" type="text"  value="<?php echo $_GET['teamname']; ?>" class="text-box">
					</li>
					<li class="light-row">
						<span class="col_width">用户名&nbsp;&nbsp;&nbsp;<span class="red_font">*</span></span>
						<input name="username" type="text"  value="<?php echo $_GET['username']; ?>" class="text-box">
					</li>
					<li class="dark-row">
						<span class="col_width">登录密码<span class="red_font">*</span></span>
						<input name="userpwd" type="password"  value="" class="text-box"> 如果为空则不修改密码 
					
					</li>
					<li class="light-row">
						<span class="col_width">确认密码<span class="red_font">*</span></span>
						<input name="repwd" type="password"  value=""  size="20" class="text-box">
					</li>
				
					<li class="light-row">
						<span class="col_width"> &nbsp; </span>
						<input type="submit" class="button"  value="修 改" name="update">&nbsp;&nbsp;
						<input type="reset" class="button" value="重 置">&nbsp;&nbsp;
						<input type="button" onclick="if(confirm('确定要删除吗?')) window.location='<{$url}>/del/id/<{$post.id}>'" class="button" value="删 除">
					</li>
				</ul>	
			</div>
                    </form>	
		</div>

<?php
	include "../../config/db.inc.php";
	if(isset($_POST['update'])){
		$id = $_GET['id'];
		$username = $_POST['username'];
		$pwd = $_POST['userpwd'];
		$teamname = $_POST['teamname'];
		$update = "update ctf_member set username='$username',teamname='$teamname' where id=$id";
		echo $update;
		if(mysql_query($update,$link)){
			echo '<h1 style="font-size: 20px;color: green;margin-left:400px">';
			echo $username."修改成功";
			echo "</h1>";
		}else{
			echo '<h1 style="font-size: 20px;color: red;margin-left:400px">';
			echo $username."修改失败";
			echo "</h1>";
		}
	}
?>
<?php
	include "../public/header.php";
?>	


