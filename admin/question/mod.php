<?php
	include "../public/header.php";
?>
		<div id="main">
		  	<div class="head-dark-box">
				<div class="tit">后台管理->题目管理->修改题目</div>
			</div>	
		    <form name="article" method="post" action="#">
			<div class="msg-box">
				<ul class="viewmess">
					<li class="light-row">
						<span class="col_width">题号&nbsp;<span class="red_font">*</span></span>
						<input type="text" class="text-box" name="number" size="30" value="<?php echo $_GET['num'] ?>" maxlength="40">
					</li>
					<li class="light-row">
						<span class="col_width">题目标题&nbsp;<span class="red_font">*</span></span>
						<input type="text" class="text-box" name="title" size="30" value="<?php echo $_GET['title'] ?>" maxlength="40">
					</li>

					<li class="light-row">
						<span class="col_width">题目分数&nbsp;<span class="red_font">*</span></span>
						<input type="text" class="text-box" name="score" size="30" value="<?php echo $_GET['score'] ?>" maxlength="40">
					</li>

					<li class="light-row">
						<span class="col_width">题目内容：</span>
						
					</li>
				
					
					<li class="light-row" style="margin:0px; padding:0px">
						<textarea cols="80" rows="10" name="content"><?php echo $_GET['content'] ?></textarea>
					</li>
				
	
					<li class="dark-row">
						<span class="col_width">&nbsp;  </span>
						<input type="submit" class="button"  value="修 改" name="update">&nbsp;&nbsp;
						<input type="reset" class="button" value="重 置">&nbsp;&nbsp;
						<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" >
						<input type="button" onclick="if(confirm('确定要删除吗?')) window.location='<{$url}>/del/id/<{$post.id}>'" class="button" value="删 除">
					</li>
				</ul>	
			</div>
                    </form>	
		</div>

<?php
	include "../../config/db.inc.php";
	if(isset($_POST['update'])){
		$id = $_POST['id'];
		$num = $_POST['number'];
		$title = $_POST['title'];
		$content = $_POST['content'];
		$score = $_POST['score'];
		$update = "update ctf_flag set num=$num,title='$title',content='$content',score='$score' where id=$id";
		if(mysql_query($update,$link)){
			echo '<h1 style="font-size: 20px;color: green;margin-left:400px">';
			echo "修改成功";
			echo "</h1>";
		}else{
			echo '<h1 style="font-size: 20px;color: red;margin-left:400px">';
			echo "修改失败";
			echo "</h1>";
		}
	}
?>

<?php
	include "../public/footer.php";
?>	


