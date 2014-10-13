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
    <link rel="stylesheet" href="../resource/css/flipclock.css">
    <script type="text/javascript" src="../resource/js/bootstrap.js"></script>
    <script type="text/javascript" src="../resource/js/jquery.min.js"></script>
    <script type="text/javascript" src="../resource/js/ajaxfileupload.js"></script>
    <script src="../resource/js/flipclock.js"></script>

</head>
<body>
    <div class="navbar navbar-default">
  <div class="navbar-header">
    <a class="navbar-brand" >XXXCTF</a>
  </div>
  <div class="navbar-collapse collapse navbar-responsive-collapse">
    <ul class="nav navbar-nav">
      <li id="test"><a href="#">答题</a></li>
      <li id="ranking"><a href="../rank/rank.php">排行榜</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><?php echo $_SESSION['username']; ?></a></li>
    </ul>
  </div>
</div>
<div class="leftsid col-lg-2 ">
    <div class="row-fluid text-center ">
            <ul  class="mynav">
            </ul>
    </div>
    <script type="text/javascript">
                $(document).ready(function(){
                $.post('./first.php',
                                         
                  function(starttime){

                    if(starttime == "0"){
                        //alert("=====");
                        //$(".startbutton").show();
                     }else{

                      $.post('./getquestion.php',
                      {
                        num:1
                      },
                      function(data){
                        var str = data.split("--");
                        document.getElementById("title").innerHTML=str[0]+"("+str[1]+")";
                        document.getElementById("content").innerHTML=str[2];
                        document.getElementById("sendnum").value=this_id;
                        if(str[3]=="0"){
                          $("#confirmkk").show();
                          $("#upfile").hide();
                        }else{
                          $("#confirmkk").hide();
                          $("#upfile").show();
                        }
                      });
                        //$("#showstatus").show();
                        $(".startbutton").hide();
                        var starttime = starttime;
                        clock.setTime(starttime);
                        clock.setCountdown(true);
                        clock.start();
                        $(".right_top").show();
                        $(".rightsid").show();

                     }
                     });
                  $(".rightsid, .endwarn").hide();
                  var this_id =1;
                         $(".mynav").empty();
                         $.post("./total.php",
                          function(data){
                            var html = "";
                            for(var i = 1;i<=data;i++){
                                  html += '<li><a>第' + i+ '关</a></li>';
                            }
                            $(".leftsid ul").prepend(html);
                            $(".mynav li,#test").click(function(){
                            $(this).addClass("afterclick");
                            $(this).siblings().removeClass("afterclick");
                             this_id = $(this).prevAll().length+1; 

                             $.post('./getquestion.php',
                             {
                              num:this_id
                             },
                            function(data){
                                var str = data.split("--");

                                document.getElementById("title").innerHTML=str[0]+"("+str[1]+")";
                                document.getElementById("content").innerHTML=str[2];
                                document.getElementById("sendnum").value=this_id;
                                if(str[3]=="0"){
                                  $("#confirmkk").show();
                                  $("#upfile").hide();
                                }else{
                                  $("#confirmkk").hide();
                                  $("#upfile").show();
                                }
                              });       
                                                // $(".rightsid").hide();
                                                /*
                                                 *获取题目数据
                                                 */
                                 });
                          });

                            $(".dobutton").click(function(){
                                           //alert(this_id);

                                           $(".startbutton").hide();
                                           $.post('./getquestion.php',
                                           {
                                            num:this_id
                                           },
                                              function(data){

                                              var str = data.split("--");
                                              document.getElementById("title").innerHTML=str[0]+"("+str[1]+")";
                                              document.getElementById("content").innerHTML=str[2];
                                              document.getElementById("sendnum").value=this_id;
                                              if(str[3]=="0"){
                                                $("#confirmkk").show();
                                                $("#upfile").hide();
                                              }else{
                                                $("#confirmkk").hide();
                                                $("#upfile").show();
                                              }
                                        });    
                                           /*
                                            *获取题目数据
                                            */
                                            $(".right_top").show();
                                            clock.start();
                                           $(".rightsid").show();
                                     });
                                $(".endsubmit").click(function(){
                                  var count=document.getElementById("filetest").files.length;
                                  if(count<1){
                                    alert('请选择文件');
                                  }else{
                                    if(count > 5){
                                      alert("文件个数不能超过5个")
                                    }else{
                                  
                                  $.ajaxFileUpload
                                    ({
                                        url: './dealfile.php', //用于文件上传的服务器端请求地址
                                        secureuri: false, //是否需要安全协议，一般设置为false
                                        fileElementId: 'filetest', //文件上传域的ID
                                        //data:{'id':this_id},
                                        dataType: 'json', //返回值类型 一般设置为json
                                        success:function (data, status)  //服务器成功响应处理函数
                                        {
                                            alert("ok");
                                        }
                                        /*
                                        error: function (data, status, e)//服务器响应失败处理函数
                                        {
                                            alert(e);
                                        }
                                        */
                                    });
                                    
                          
              
                                    $.post('./getupconfirm.php',
                                    {
                                      num:this_id
                                    },
                                    function(data){
                                      //alert(data);
                                      
                                      document.getElementById("result").innerHTML=data;
                                      document.getElementById("result").style.display="block";
                                      $("#result").hide(10000);
                                      });
                                  }
                                }

                                  });
                                
                                 $(".confirmkey").click(function(){
                                    var thekey=$(".userkey").val();
                                    //$("#showstatus").show();
                                    $.post('./getconfirm.php',
                                    {
                                      userkey:thekey,
                                      num:this_id
                                    },
                                    function(data){
                                      //alert(data);
                                      document.getElementById("result").innerHTML=data;
                                      document.getElementById("result").style.display="block";
                                      $("#result").hide(10000);
                                        });    
                                    
                                 });

                                 $("#adis").click(function(){
                                    $.post('./test.php',
                                    {
                                      status:0
                                    },
                                    function(data){
                                      //alert(data);
                                        }); 
                                 });
                });
    </script>
</div>

<div class="right_top" style="margin-left:1000px;margin-buttom:0px">
<div class="clock right_top" style="margin-top:2em;"></div>
<button class="btn btn-danger span3 endtime" style="margin-left:30px;margin-top:30px;">结束答题</button>
</div>  
</div>
  <script type="text/javascript">
    var clock;
    $(document).ready(function() {
            $(".right_top,#cottime").hide();
            clock = $('.clock').FlipClock({
            clockFace: 'HourlyCounter',
            showSeconds: false
        });
            /*
             *设置倒计时
             */
        var starttime =7200;
        clock.setTime(starttime);
        clock.setCountdown(true);

        $(".endtime").click(function(){
            $("#cottime").show();
        });
        $(".continuedoit").click(function(){
            $("#cottime").hide();
        });
        $(".sureend").click(function(){
              var mytime = starttime-clock.getTime();
              $.post('./savetime.php',
              {
                  time:mytime
              },  
              function(data){
                location.href="../../index.php";
                });    
                });
    });
  </script>
<div class="startbutton col-lg-offset-4">
  <ul class=" row mynavl">
    <li class=""><a href="#" style="margin-left:280px;" class="btn btn-default  dobutton">开始答题</a></li>
    <li class="text-warning col-lg-offset-2"><p><h5>点击按钮开始答题，并且会进行计时，作为排名依据</h5></p></li>
  </ul>
</div>
<div class="col-lg-5 rightsid " style="margin-top:0px;margin-left:200px;position: absolute;">
<h2 id="title">Emphasis classes</h2>

<p class="text-success">题目内容：</p>
<p class="text-success" id="content">Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>

<div>
        <fieldset>

          <div class="form-group" id="confirmkk" style="display:none">
            
            <div class="input-group">
            
            <input type="text" class="form-control userkey" placeholder="Input the Key...">
            <span class="input-group-btn">
            <button class="btn btn-primary confirmkey" type="button">&nbsp;验证key</button>
            </span>
          </div>
        </div>


        <div class="form-group" id="upfile" style="display:none">
            <div class="input-group">
            <input type="file" name="filetest[]" id="filetest" multiple="multiple" accept="image/jpeg,image/pjpeg,application/msword" class="form-control" />
            <span class="input-group-btn">
            <input style="display:none" value="1" id="sendnum" name="sendnum"/> 
            <input type="submit" class="btn btn-primary endsubmit" name="upload" id="fileup" onclick="ajaxFileUpload()" value="上传文件">
            </span>

          </div>
           <p class="help-block text-danger">请上传doc或jpg的文件，且不要超过5个</p>
        </div>
        <!--
        <div id="showstatus" style="display:none">
          正在审核中......
        </div>
-->
        </fieldset>
</div>
</div>
</div>
    
    <div id="result">
    </div>
    <a id="adis" onclick="disapear()" href="#">
      <div id="mess">
        111aaa
      </div>
    </a>

  </div>


<?php
//  require "../../classes/fileupload.class.php";
//  require "../../config/db.inc.php";
//  echo "<script>";
//  echo 'document.getElementById("sendnum").value=this_id;';
  //echo 'document.getElementById("fileup").disable=true;';
//  echo "</script>";
?>

<div class="footer">
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
<script type="text/javascript">
window.setInterval(loadXMLDoc, 3000);
window.setInterval(checktime, 1000);
result=document.getElementById("result");
mess=document.getElementById("mess");
function checktime(){
  var time = clock.getTime();
  if (time == 0) {
    alert("game over");
     $.post('./savetime.php',
        {
          time:7200
        },  
          function(data){
            location.href="../../index.php";
        });  
  }
}
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
        mess.innerHTML="新消息";
        mess.style.display="block";
        result.innerHTML = xmlhttp.responseText;
      }
    
    }
  }
xmlhttp.open("GET","./receive.php",true);
xmlhttp.send();
}

adis = document.getElementById("adis");
adis.onclick=function(){
  mess.style.display="none";
  result.style.display="block";
  $("#result").hide(30000);
}
</script> 
<div class="alert alert-info col-lg-2 " id="cottime" style="margin-left:1050px;margin-top:40px;" >
      <h4>你确定离开吗？</h4>
      <p>
        <button type="button" class="btn btn-warning continuedoit">继续答题</button>
        <button type="button" class="btn btn-danger sureend">结束答题</button>
      </p>
    </div>
</body>
</html>