<?php
	require "fileupload.class.php";
	require "../config/db.inc.php";

	$up = new UploadFile(array('filepath'=>'../upload/','allowtype'=>array('doc','jpg')));
	$filepath = "";
	$username = "cutoutsy";
	$num = 2;
	if ($up->uploadFile('filetest')) {
		//for ($i=0; $i < count($up->getNewFileName()); $i++) { 
		//	$filepath .=$up->getNewFileName()[$i];
			//echo $up->getNewFileName()[$i];
			//$insert = "insert into ctf_file(filepath) values('$filepath')";
			//if(mysql_query($insert,$link)){
			//	echo "上传成功";
			//}
		//}
		$filepath = implode(",", $up->getNewFileName()); 
		$insert = "insert into ctf_process(username,filepath,num) values('$username','$filepath',$num)";
		if(mysql_query($insert,$link)){
			echo "上传成功";
		}else{
			echo "======";
		}
		//echo $filepath;
	}else{
		print_r($up->getErrorMsg());
	}
?>