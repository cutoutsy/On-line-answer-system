<?php
	include "../public/header.php";
?>
	<div id="main">
		<div class="head-dark-box">
			<div class="tit">题目审核>开始审核>正在审核</div>
		</div>
		<div class="msg-box">
			<ul class="viewmess">
						<li class="dark-row">
						<li class="light-row">
						<?php
							include "../../config/db.inc.php";
							include "../../classes/ajaxpage.class.php";
							$sql = @mysql_query("select * from ctf_process");
							$row = @mysql_num_rows($sql);
							$page = new AjaxPage($row,10);
							$page->set('head','个提交');
							$rsql = "select id,username,num,filepath from ctf_process order by id DESC limit $page->limit";
							$set1 = "update ctf_process set status=1";
							$setok = mysql_query($set1);
							$result = mysql_query($rsql);
							if($result && mysql_num_rows($result) > 0){
								while(list($id,$username,$num,$filepath) = mysql_fetch_row($result)){
									echo '<li id="examone" class="dark-row" style="padding-top:5px; padding-bottom:5px">';
									echo '<span class="col_width">'.$username.'提交了第'.$num.'题的答案</span>';
									echo '<span class="list_width" style="width:160px;">';
									echo '【<a onclick="changecol()" href="./exam.php?username='.$username.'&num='.$num.'&id='.$id.'">审核</a>】';
									echo '</span>';
									echo "</li>";
								}	
							}
							echo '<li class="dark-row" style="text-align:right">';
										
							echo $page->fpage();
							echo '</li>';
						?>
					</li>
			</ul>		
		</div>
		<a id="dis" onclick="disapear()" href="../base/index.php">
			<div id="mess">
			</div>
		</a>
	</div>
<script type="text/javascript">
window.setInterval(loadXMLDoc, 3000);
mess=document.getElementById("mess");
function loadXMLDoc()
{
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    	if (xmlhttp.responseText != "") {
	    	mess.innerHTML=xmlhttp.responseText;
	    	mess.style.display="block";
	    	//alert(xmlhttp.responseText);
	    }
    }
  }
xmlhttp.open("GET","deal.php",true);
xmlhttp.send();
}

adis = document.getElementById("adis");
adis.onclick=function(){
	mess.style.display="none";
}
</script>


<?php
	include "../public/footer.php";
?>