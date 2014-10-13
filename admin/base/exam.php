<?php
	include "../public/header.php";
?>
<script>
	function hidepscore(){
		document.getElementById('pscore').style.display="none";
	}
	function hideexp(){
		document.getElementById('exptitle').style.display="none";
		document.getElementById('explain').style.display="none";
	}
	function showall(){
		document.getElementById('pscore').style.display="block";
		document.getElementById('exptitle').style.display="block";
		document.getElementById('explain').style.display="block";
	}

</script>
	<div id="main">
		<div class="head-dark-box">
			<div class="tit">题目审核>开始审核>正在审核</div>
		</div>

		 <form  method="post" action="#">
			<div class="msg-box">
				<ul class="viewmess">
					<li class="light-row">
						<span class="col_width">用户<span>:</span></span>
						<input name="username" type="text"  value="<?php echo $_GET['username']; ?>" class="text-box" disabled />
					</li>
					<li class="dark-row">
						<span class="col_width">题号<span>:</span></span>
						<input name="num" type="text"  value="<?php echo $_GET['num']; ?>" class="text-box" disabled /> 
					</li>
					<li class="light-row">
						<span class="col_width">答案<span>:</span></span>
						<?php
							include "../../config/db.inc.php";
							include "../../classes/ajaxpage.class.php";
							$id = $_GET['id']; 
							$file_dir = "../../upload/";
							$rsql = "select filepath from ctf_process where id=$id";
							$result = mysql_query($rsql);
							if($result && mysql_num_rows($result) > 0){
								list($filepath) = mysql_fetch_row($result);
									$paths = explode(',',$filepath);
									for ($i=0; $i < count($paths) ; $i++) {
										$link = $file_dir.$paths[$i];
										if (@end(explode(".",$paths[$i])) === "jpg") {
											echo '<a href="'.$link.'">查看图片'.($i+1).'</a>';
											echo '&nbsp;&nbsp;|&nbsp;&nbsp;';
										}else{
											echo '<a href="'.$link.'">下载doc'.($i+1).'</a>';
											echo '&nbsp;&nbsp;|&nbsp;&nbsp;';
										}
									}
							}
						?>
					</li>

					<li class="light-row">
						<span class="col_width">判定<span>:</span></span>
						<input type="radio" name="estatus" value="pass" onclick="hideexp()"/>通过&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="estatus" value="fail" onclick="hidepscore()"/>不通过
					</li>

					<li class="light-row" id="pscore">
						<span class="col_width">打分<span>:</span></span>
						<select name="score">
							<option value="5">5分</option>
							<option value="10" selected = "selected">10分</option>
							<option value="15">15分</option>
						</select>
						<!--
						<span style="color:blue">(若通过，请选择分数)</span>
						-->
					</li>

					<li class="light-row" id="exptitle">
						<span class="col_width">具体说明：<!--<span style="color:blue">(若不通过，给出说明)</span>--></span>
					</li>
				
					
					<li class="light-row" style="margin:0px; padding:0px" id="explain">
						<textarea cols="80" rows="10" name="explain" ></textarea>
					</li>
					<li class="light-row">
						<span class="col_width"> &nbsp; </span>
						<input type="submit" class="button"  name="receive" value="完成">&nbsp;&nbsp;
						<input type="reset" class="button" onclick="showall()" value="重 置">
					</li>

				</ul>	
			</div>
                    </form>	
	</div>

<?php
	//include "../../config/db.inc.php";
	if (isset($_POST['receive'])) {
		$username = $_GET['username'];
		$num = $_GET['num'];;
		if($_POST['estatus']=="pass"){
			$score = $_POST['score'];

			$getscore = "select score from ctf_member where username='$username'";
			list($nowscore) = mysql_fetch_row(mysql_query($getscore));
			$putscore = $nowscore+$score;
			$setscore = "update ctf_member set score=$putscore where username='$username'";
			mysql_query($setscore);


			$getfinish = "select finish from ctf_member where username='$username'";
			//$finish = $num.",";
			mysql_query($getfinish);
			list($nowfinish) = mysql_fetch_row(mysql_query($getfinish));
			$putfinish = $nowfinish.$num."-";
			$setfinish = "update ctf_member set finish='$putfinish' where username='$username'";
			mysql_query($setfinish);
			$explain = "已通过";
			$insert = "insert into ctf_receive(num,username,score,explaination,status) values($num,'$username',$score,'$explain',1)";
		}else{
			$explain = $_POST['explain'];
			$insert = "insert into ctf_receive(num,username,score,explaination,status) values($num,'$username',0,'$explain',1)";
		}
		if(mysql_query($insert)){
			echo '<h1 style="font-size: 20px;color: green;margin-left:400px">';
			echo $username."审核成功";
			echo "</h1>";
		}else{
			echo '<h1 style="font-size: 20px;color: red;margin-left:400px">';
			echo $username."审核失败";
			echo "</h1>";
			
		}
	}
?>

<?php
	include "../public/footer.php";
?>