<?php
	session_start();
	require "../../classes/fileupload.class.php";
  require "../../config/db.inc.php";
  $up = new UploadFile(array('filepath'=>'../../upload/','allowtype'=>array('doc','jpg')));
  $filepath = "";
  $username = $_SESSION['username'];
  
  print_r($_FILES);

    $newId = mysql_query("select max(id) from ctf_process",$link);
    list($nid) = mysql_fetch_row($newId);

    $pjudge = "select username from ctf_process where id=$nid";
    $prjudge = mysql_query($pjudge);
    if ($pjudge) {
    	list($usernamet) = mysql_fetch_row($pjudge);
    	if($usernamet == ""){
    		if ($up->uploadFile('filetest')) {
		      $filepath = implode(",", $up->getNewFileName()); 
		      $insert = "update ctf_process set username='$username',filepath='$filepath',status=0 where id=$nid";
		      if(mysql_query($insert,$link)){
		      }else{
		        //echo "======";
		      }
		    }else{
		      print_r($up->getErrorMsg());
		    }
    	}
    }else{
    	echo mysql_error();
    }
    //$id = mysql_insert_id();
    /*
    if ($up->uploadFile('filetest')) {
      $filepath = implode(",", $up->getNewFileName()); 
      //$insert = "insert into ctf_process(username,filepath,status) values('$username','$filepath',0)";
      $insert = "update ctf_process set username='$username',filepath='$filepath',status=0 where id=$nid";
      if(mysql_query($insert,$link)){
      }else{
        echo "======";
      }
    }else{
      print_r($up->getErrorMsg());
    }
    */
?>