<?php
	include "../public/header.php";
?>
<script>
	function hidekey(){
		document.getElementById('quekey').style.display="none";
	}
	function showkey(){
		document.getElementById('quekey').style.display="block";
	}
	function showall(){
		document.getElementById('quekey').style.display="block";
	}

	function checknumber(){
		if(document.getElementById('number').value == ""){
			document.getElementById("numberapp").innerHTML = "不能为空";
		}else{
			document.getElementById("numberapp").innerHTML = "";
		}
	}

	function checktitle(){
			if(document.getElementById("title").value == ""){
				document.getElementById("titleapp").innerHTML = "不能为空";
			}else{
				document.getElementById("titleapp").innerHTML = "";
			}
		}
	function checkkey(){
			if(document.getElementById("anskey").value == ""){
				document.getElementById("keyapp").innerHTML = "不能为空";
			}else{
				document.getElementById("keyapp").innerHTML = "";
			}
		}
</script>
		<div id="main">
		  	<div class="head-dark-box">
				<div class="tit">后台管理->题目管理->添加题目</div>
			</div>	
		    <form name="article" method="post" action="#">
			<div class="msg-box">
				<ul class="viewmess">
					<li class="light-row">
						<span class="col_width">题号&nbsp;<span class="red_font"></span></span>
						<input type="text" class="text-box" onblur="checknumber()" id="number" name="number" size="30" maxlength="40">
						<span id="numberapp" style="color:red"></span>
					</li>
					<li class="light-row">
						<span class="col_width">题目标题&nbsp;<span class="red_font"></span></span>
						<input type="text" class="text-box" onblur="checktitle()" id="title" name="title" size="30" value="" maxlength="40">
						<span id="titleapp" style="color:red"></span>
					</li>
					<li class="light-row">
						<span class="col_width">题目分数&nbsp;<span class="red_font"></span></span>
						<select name="score">
							<option value="5">5分</option>
							<option value="10" selected = "selected">10分</option>
							<option value="15">15分</option>
						</select>
						<!--
						<span style="color:blue">(若通过，请选择分数)</span>
				
						<input type="text" class="text-box" onblur="checkscore()" id="score" name="score" size="30" value="" maxlength="40">
						<span id="scoreapp" style="color:red"></span>-->
					</li>

					<li class="light-row">
						<span class="col_width">判定类型<span>:</span></span>
						<input type="radio" name="pstatus" value="auto" checked="checked" onclick="showkey()"/>自动&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="pstatus" value="person"  onclick="hidekey()"/>人工
					</li>

					<li class="light-row" id="quekey">
						<span class="col_width">题目key值&nbsp;<span class="red_font"></span></span>
						<input type="text" class="text-box" id="anskey" onblur="checkkey()" name="anskey" size="30" value="" maxlength="40">
						<span id="keyapp" style="color:red"></span>
					</li>
					<li class="light-row">
						<span class="col_width"><span class="red_font"></span></span>
					</li>
					<li class="light-row">
						<span class="col_width">题目内容<span class="red_font"></span></span>
					</li>
					<li class="light-row" style="margin:0px; padding:0px">
						<textarea cols="80" rows="10" name="content"></textarea>
						<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
						<script type="text/javascript">
						CKEDITOR.replace( 'content',{height:300,extraPlugins : 'uicolor',uiColor: '#FAFAFA',filebrowserImageUploadUrl:'/brocms/admin.php/article/upimage',filebrowserFlashUploadUrl:'/brocms/admin.php/article/upflash',toolbar :
						[
						['Source','-','Templates'],
					    ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
					    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],['ShowBlocks'],['Image','Capture','Flash'],['Maximize'],
					    '/',
					    ['Bold','Italic','Underline','Strike','-'],
					    ['Subscript','Superscript','-'],
					    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
					    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
					    ['Link','Unlink','Anchor'],
					    ['Table','HorizontalRule','Smiley','SpecialChar'],
					    '/',
					    ['Styles','Format','Font','FontSize'],
					    ['TextColor','BGColor'],
					    ['attachment'],
						]
						});
						</script>
					</li>
				
	
					<li class="dark-row">
						<span class="col_width">&nbsp;  </span>
						<input type="submit" class="button"  value="添 加" name = "insert">&nbsp;&nbsp;
						<input type="reset" class="button" onclick="showall()" value="重 置">
					</li>
				</ul>	
			</div>
                    </form>	
		</div>

<?php
	include "../../config/db.inc.php";
	if(isset($_POST['insert'])){
		$num = $_POST['number'];
		$title = $_POST['title'];
		$score = $_POST['score'];
		$content = $_POST['content'];
		$content = str_replace(array("<p>","</p>"),"", $content);
		if ($_POST['pstatus']=="auto") {
			$key = $_POST['anskey'];
			$insert = "insert into ctf_flag(num,title,content,score,anskey) values('$num','$title','$content',$score,'$key')";
		}else{
			$insert = "insert into ctf_flag(num,status,title,content,score) values('$num',1,'$title','$content',$score)";
		}
		if(mysql_query($insert,$link)){
			echo '<h1 style="font-size: 20px;color: green;margin-left:400px">';
			echo "添加成功";
			echo "</h1>";
		}else{
			echo '<h1 style="font-size: 20px;color: red;margin-left:400px">';
			echo "添加失败";
			echo "</h1>";
		}
	}
?>
<?php
	include "../public/footer.php";
?>	


