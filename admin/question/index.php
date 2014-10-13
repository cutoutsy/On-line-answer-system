<?php
	include "../public/header.php";
?>
		<div id="main">
		  	<div class="head-dark-box">
				<div class="tit">后台管理->题目管理->编辑题目</div>
			</div>	
		    <form  method="post" action="<{$url}>/fpro/page/<{$page}><{if $smarty.get.pid}>/pid/<{$smarty.get.pid}><{/if}><{if $smarty.get.search}>/search/<{$smarty.get.search}><{/if}><{if $smarty.get.audit}>/audit/<{$smarty.get.audit}><{/if}>">
			<div class="msg-box">
				<ul class="viewmess">
					<script>
						var sel=document.getElementById("sel");
						
						sel.onchange=function(){
							var pid=this.options[this.selectedIndex].value;
							window.location="<{$url}>/index/pid/"+pid;
						}

						function search(){
							var pid=sel.options[sel.selectedIndex].value;
							var sval=document.getElementById("sea").value;	
							window.location="<{$url}>/index/pid/"+pid+"/search/"+sval;

						}
					</script>
					</li>
					
					<li class="dark-row">
						<span class="list_width width_font" style="width:140px">题号</span>
						<span class="list_width width_font">标&nbsp;&nbsp;题</span>
						<span class="list_width width_font">分数</span>
						<span class="list_width width_font" style="width:180px">内容</span>
					
						<span class="list_width width_font" style="width:230px">操&nbsp;&nbsp;作</span>
					</li>

					<?php
						include "../../config/db.inc.php";
						include "../../classes/ajaxpage.class.php";
						$param = "";
						$sql = @mysql_query("select * from ctf_flag");
						$row = @mysql_num_rows($sql);
						$page = new AjaxPage($row,10);
						$page->set('head','个题目');
						$rsql = "select id,num,title,content,score from ctf_flag order by id DESC limit $page->limit";
						$result = mysql_query($rsql);
						if($result && mysql_num_rows($result) > 0){
							while(list($id,$num,$title,$content,$score) = mysql_fetch_row($result)){
							$content = mb_substr($content, 0,10,'utf-8')."...";
							echo '<li class="dark-row" style="padding-top:5px; padding-bottom:5px">';
							echo '<span class="list_width" style="width:140px"><input type="checkbox" name="id[]" value=""><a href="" target="_blank">'.$num.'</a></span>';
							echo '<span class="list_width">'.$title.'</span>';
							echo '<span class="list_width">'.$score.'</span>';
							echo '<span class="list_width" style="width:180px">'.$content.'</span>';
				
							echo '<span class="list_width" style="width:190px">';
						
							echo '【<a href="./mod.php?title='.$title.'&num='.$num.'&content='.$content.'&id='.$id.'&score='.$score.'">修改</a>】';
							echo '【<a onclick="return confirm';
							echo "('确定要删除用户吗?')";
							echo '"href="./del.php?id='.$id.'">删除</a>】';

							echo '</span>';
							echo "</li>";
							}
						}

						echo '<li class="dark-row" style="text-align:right">';
						
						echo $page->fpage();
						echo '</li>';
					?>
				</ul>	
			</div>
                    </form>
		</div>

<?php
	include "../public/footer.php";
?>


