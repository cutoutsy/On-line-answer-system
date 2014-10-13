<?php
	include "../public/header.php";
?>
		<div id="menu">
			<div class="option">
				<div class="menutitle">【管理选项】</div>
				<div class="content">
					<ul>
						<li class="opt">
							<a href="./main.php" onclick="switchmenu('optionmenu','menulist',0)" target="main">
							<img onmouseover="cimg(this)" onmouseout="cimg(this)" border="0" src="../resource/images/system_d.gif"><br>
							 题目审核</a>
						</li>
						<li class="opt">
							<a href="./main.php" onclick="switchmenu('optionmenu','menulist',1)" target="main">
							<img onmouseover="cimg(this)" onmouseout="cimg(this)" border="0" src="../resource/images/article_d.gif"><br>
							题目管理</a>
						</li>
						<li class="opt">	
							 <a href="./main.php" onclick="switchmenu('optionmenu','menulist',2)" target="main">
							 <img onmouseover="cimg(this)" onmouseout="cimg(this)" border="0" src="../resource/images/user_d.gif"><br>
							 会员管理</a>
						</li>
					</ul>
				 </div>
			</div>
			<div class="nav"> </div>
			<div class="option">
				<div id="optionmenu" class="menutitle">【题目审核】</div>
				<div id="menulist" class="content"> 
				    	<div style="display:block">				
						<h4 onclick="domenu(this, 'list1')" class="tit">--题目审核--</h4>
						<ul id="list1">
							<li><a class="list" href="../base/index.php" target="main">开始审核</a></li>
						</ul>

					
					</div>

					<div>
					
						<h4 onclick="domenu(this, 'list24')" class="tit">--题库管理--</h4>
						<ul id="list24">
							<li><a class="list"  href="../question/add.php" target="main">添加题目</a></li>
							<li><a class="list"  href="../question/index.php" target="main">编辑题目</a></li>
						</ul>
					</div>

					<div>
					
						<h4 onclick="domenu(this, 'list32')" class="tit">--会员管理--</h4>
						<ul id="list32">
							<li><a class="list" href="../user/add.php" target="main">添加会员</a></li>
							<li><a class="list" href="../user/index.php" target="main">编辑会员</a></li>
						</ul>
					</div>
					
					
				</div>
			</div>	
		</div>
<?php
	include "../public/footer.php";
?>


