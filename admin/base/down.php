<?php
	include "../../config/db.inc.php";
	include "../../classes/ajaxpage.class.php";
	$id = $_GET['id'];
	//$file_name = "1.doc";     //下载文件名  
	$file_dir = "../../upload/";
	//print_r($_GET);
	$rsql = "select filepath from ctf_process where id=$id";
	$result = mysql_query($rsql);
	if($result && mysql_num_rows($result) > 0){
		list($filepath) = mysql_fetch_row($result);
		//echo $filepath;
		$paths = explode(',',$filepath);
		//print_r($paths);
		for ($i=0; $i < count($paths) ; $i++) { 
			//echo $i;
			$file_name = $paths[$i];
			echo $file_name;
			
			if (! file_exists ( $file_dir . $file_name )) {  
    			echo "文件找不到";  
    			exit ();  
			} else {  
		    	//打开文件  
		    	$file = fopen ( $file_dir . $file_name, "r" );  
		    	//输入文件标签   
		    	Header ( "Content-type: application/octet-stream" );  
		   		Header ( "Accept-Ranges: bytes" );  
		    	Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) );  
		    	Header ( "Content-Disposition: attachment; filename=" . $file_name );  
		    	//输出文件内容   
		    	//读取文件内容并直接输出到浏览器  
		    	echo fread ( $file, filesize ( $file_dir . $file_name ) );  
		    	fclose ( $file );  
		    	//exit ();  
		    	echo '<script LANGUAGE="javascript">';
				
				echo 'window.open ("./down.php")';
			
				echo "</script>";
			}
		}
	}
	
?>