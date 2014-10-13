<?php
	include "../public/header.php";
?>
<div id="main">
	<div class="head-dark-box">
		<div class="tit">系统管理>会员管理>编辑会员</div>
		</div>	
		<div class="msg-box">
		<ul class="viewmess">
			<li class="dark-row">
				<span class="list_width width_font">用户名</span>
				<span class="list_width width_font" style="width:200px">队伍名称</span>
				<span class="list_width width_font">注册时间</span>
				<span class="list_width width_font">操&nbsp;&nbsp;作</span>
			</li>


<?php
	$username = $_GET['username'];
	include "../../config/db.inc.php";
	include "../../classes/ajaxpage.class.php";
	$sql = @mysql_query("select * from ctf_member where username='$username'");
	$row = @mysql_num_rows($sql);
	$page = new AjaxPage($row,10);
	$page->set('head','个会员');
	$rsql = "select id,username,teamname from ctf_member where username='$username' order by id DESC limit $page->limit";
	$result = mysql_query($rsql);
	if($result && mysql_num_rows($result) > 0){
		while(list($id,$username,$teamname) = mysql_fetch_row($result)){
		echo '<li class="dark-row" style="padding-top:5px; padding-bottom:5px">';
		echo '<span class="list_width" style="width:200px">';
		echo '<input type="checkbox" name="id[]"  value="123">'.$username.'</span>';

		echo '<span class="list_width">'.$teamname.'</span>';

		echo '<span class="list_width">2014-09-30</span>';
				
		echo '<span class="list_width" style="width:160px;">';
						
		echo '【<a href="./mod.php?username='.$username.'&teamname='.$teamname.'&id='.$id.'">修改</a>】';
		echo '【<a onclick="return confirm';
		echo "('确定要删除用户吗?')";
		echo '"href="./del.php?id='.$id.'">删除</a>】';

		echo '</span>';
		echo "</li>";
		}
	}else{
		echo '<span class="list_width">没有该会员，请检查您输入的用户名！</span>';
	}
	echo '<li class="dark-row" style="text-align:right">';
						
	echo $page->fpage();
	echo '</li>';
?>

				 </form>
				</ul>	
			</div>
                   
		</div>

<?php
	include "../public/footer.php";
?>	