<!doctype html>
<?php
  session_start();
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>XXXCTF</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href="../resource/css/newbootstrap.css" type="text/css" media="screen" />
    <link rel=stylesheet href="../resource/css/bootstrap-responsive.css" type="text/css" media="screen" />
    <link rel=stylesheet href="../resource/css/myboot.css" type="text/css" media="screen" />
    <script type="text/javascript" src="../resource/js/bootstrap.js"></script>
    <script type="text/javascript" src="../resource/js/jquery.min.js"></script>
       <script src="../resourcejs/stickUp.min.js"></script>
</head>
<body>
    <div class="navbar navbar-default">
  <div class="navbar-header">
    <a class="navbar-brand" href="#">XXXCTF</a>
  </div>
  <div class="navbar-collapse collapse navbar-responsive-collapse">
    <ul class="nav navbar-nav">
      <li ><a href="../user/user.php">答题</a></li>
      <li><a href="#">排行榜</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><?php echo $_SESSION['username']; ?></a></li>
    </ul>
  </div>
</div>
<div>
  <table class="table table-striped table-hover table-bordered differentTable">
  <thead class="mysuccess">
    <tr>
      <th class="col-lg-2 vcenter"><span class="label label-info ">排名</span></th>
      <th class="col-lg-2 vcenter"><span class="label label-info">用户名</span></th>
      <th><span class="label label-info">进度</span></th>
    </tr>
  </thead>
  <tbody>
    <?php
      include "../../config/db.inc.php";
      include "../../classes/ajaxpage.class.php";
      $sql = @mysql_query("select * from ctf_member");
      $row = @mysql_num_rows($sql);
      $page = new AjaxPage($row,10);
      $page->set('head','个');

      $addrank = "select id,score,time from ctf_member";
      $addresult = mysql_query($addrank);
      if($addresult && mysql_num_rows($addresult) > 0){
        while(list($id,$score,$time) = mysql_fetch_row($addresult)){
          $rankval = $score+$time;
          $updaterank = "update ctf_member set rank=$rankval where id=$id";
          mysql_query($updaterank);
        }
      }

      $rsql = "select username,finish from ctf_member order by rank DESC limit $page->limit";
      $result = mysql_query($rsql);
      $totalsql = @mysql_query("select * from ctf_flag");
      $totolq = @mysql_num_rows($totalsql);
      $rank = 1;
      if($result && mysql_num_rows($result) > 0){
        while(list($username,$finish) = mysql_fetch_row($result)){
          $finsharr=explode("-",$finish); 
          echo '<tr class="mywarning">';
          echo '<td id="ranking" class=""><span class="label label-info ">'.($rank++).'</span></td>';
          echo '<td id="team"><span class="label label-info ">'.$username.'</span></td>';
          echo '<td id="progress">';
          echo '<ul class="list-inline list-inlineul">';
          for ($i=1; $i < $totolq+1; $i++) { 
            if(in_array($i, $finsharr)){
               echo '<li><a href="#"  class="btn btn-info btn-xs btn-circle ">'.$i.'</a></li>';
            }else{
              echo '<li><a href="#" class="btn btn-primary btn-xs btn-circle">'.$i.'</a></li>';
            }
          }
          echo '</ul>';
          echo '</td>';
          echo "</tr>";
        }
      }
      echo '<li class="dark-row" style="text-align:right">'; 
      echo $page->fpage();
      echo '</li>';
    ?>
  </tbody>
</table> 
</div>
<div class="footer ">
    <div class="navbar navbar-default navbar-fixed-bottom">
    <div class="row text-center">
        <dl class="text-muted">
            <dd>&nbsp;</dd>
            <dd>&copy;2014 xxx公司</dd>
            <dd>power by xxx公司</dd>
        </dl>
    </div>
</div>
</div> 
</body>
</html>