<?php
	header('Content-Type:text/html;charset=utf-8');
	if(isset($_POST['submitname'])){
		$dbhost =  $_POST['dbhost'];
		$dbname = $_POST['dbname'];
		$dbuser = $_POST['dbuser'];
		$dbpw = $_POST['dbpw'];
		$username = $_POST['username'];
		$passwd = $_POST['password'];
		$passwd2 = $_POST['password2'];

		echo '<div style="width:400px;margin-left:auto;margin-right:auto;margin-top:100px;">';
		//connect mysql
		$link = @mysql_connect($dbhost,$dbuser,$dbpw);
		if(!$link){
			echo "安装失败，请检查数据库信息是否正确！";
			exit();
		}

		//create database
		if (mysql_query('CREATE DATABASE '.$dbname.' CHARACTER SET "utf8"COLLATE "utf8_general_ci"',$link))
		{
			//echo "<h3>database created......</h3>";
		}
		else
		{
			//echo "<h3>Error creating database: " . mysql_error()."</h3>";
			echo "安装失败，请检查数据库信息是否正确！";
			exit();
		}

		//choose database
		if(mysql_select_db($dbname, $link)){
			//echo '<h3>choose database succeed!</h3>';
		}else{
			//echo '<h3>choose database failed!</h3>';
			echo "安装失败，请检查数据库信息是否正确！";
			exit();
		}

		//create admin table
		$createadmin = "CREATE TABLE ctf_admin
		(
			id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			username VARCHAR(20) NOT NULL DEFAULT '',
  			userpwd VARCHAR(40) NOT NULL DEFAULT '',
  			PRIMARY KEY  (id)
		)ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if(mysql_query($createadmin,$link)){
			//echo "<h3>ctf_admin created......"."<br>";
		}else{
			//echo "<h3>Error creating tables:".mysql_error()."</h3>";
			echo "安装失败，请检查数据库信息是否正确！";
			exit();
		}

		$insertadmin = "insert into ctf_admin(username,userpwd) values('$username','$passwd')";
		if(mysql_query($insertadmin,$link)){
		}else{
			//echo "<h3>Error:".mysql_error()."</h3>";
			echo "安装失败，请检查数据库信息是否正确！";
			exit();
		}

		//create merber table
		$createmember = "CREATE TABLE ctf_member(
			id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  			username VARCHAR(50) NOT NULL DEFAULT '',
  			userpwd VARCHAR(40) NOT NULL DEFAULT '',
  			email VARCHAR(60) NOT NULL DEFAULT '',
  			teamname VARCHAR(20) NOT NULL DEFAULT '',
  			registerdate date default NULL,
  			finish VARCHAR(60) NOT NULL DEFAULT '',
  			status INT(11) UNSIGNED NOT NULL default 0,
  			time INT(11) UNSIGNED NOT NULL DEFAULT 0,
  			starttime INT(11) UNSIGNED NOT NULL DEFAULT 0,
  			score INT(11) UNSIGNED NOT NULL DEFAULT 0,
  			rank INT(11) UNSIGNED NOT NULL DEFAULT 0,
  			PRIMARY KEY  (id)
		)ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if(mysql_query($createmember,$link)){
			//echo "<h3>ctf_member created......"."<br>";
		}else{
			//echo "<h3>Error creating tables:".mysql_error()."</h3>";
			echo "安装失败，请检查数据库信息是否正确！";
			exit();
		}

		//create flag table
		$createflag = "CREATE TABLE ctf_flag(
			id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			status INT(11) UNSIGNED NOT NULL DEFAULT 0,
			num INT(11) UNSIGNED NOT NULL,
  			title VARCHAR(50) NOT NULL DEFAULT '',
  			content TEXT NOT NULL,
  			anskey VARCHAR(50) NOT NULL DEFAULT '',
  			score INT(11) UNSIGNED NOT NULL DEFAULT 0,
  			PRIMARY KEY  (id)
		)ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if(mysql_query($createflag,$link)){
			//echo "<h3>ctf_flag created......"."<br>";
		}else{
			//echo "<h3>Error creating tables:".mysql_error()."</h3>";
			echo "安装失败，请检查数据库信息是否正确！";
			exit();
		}

		//create process table
		$createprocess = "CREATE TABLE ctf_process(
			id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			num INT(11) UNSIGNED NOT NULL DEFAULT 0,
			username VARCHAR(50) NOT NULL DEFAULT '',
  			filepath VARCHAR(255) NOT NULL DEFAULT '',
  			status INT(11) UNSIGNED NOT NULL,
  			PRIMARY KEY  (id)
		)ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if(mysql_query($createprocess,$link)){
			//echo "<h3>ctf_process created......"."<br>";
		}else{
			//echo "<h3>Error creating tables:".mysql_error()."</h3>";
			echo "安装失败，请检查数据库信息是否正确！";
			exit();
		}

		//create receive table
		$createreceive="CREATE TABLE ctf_receive(
			id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			num INT(11) UNSIGNED NOT NULL DEFAULT 0,
			score INT(11) UNSIGNED NOT NULL DEFAULT 0,
			username VARCHAR(50) NOT NULL DEFAULT '',
  			explaination VARCHAR(255) NOT NULL DEFAULT '',
  			status INT(11) UNSIGNED NOT NULL DEFAULT 0,
  			PRIMARY KEY  (id)
		)ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if(mysql_query($createreceive,$link)){
			//echo "<h3>ctf_receive created......"."<br>";
		}else{
			//echo "<h3>Error creating tables:".mysql_error()."</h3>";
			echo "安装失败，请检查数据库信息是否正确！";
			exit();
		}

		$inputs=array(
			"HOST"=>$dbhost,
			"USER"=>$dbuser,
			"DBNAME"=>$dbname,
			"PASS"=>$dbpw
			);
		$confile = '../config/config.inc.php';
		/*
		$handle = fopen($confile,"a+") or die('打开<b>'.$confile.'</b>文件失败！！');
		foreach($inputs as $key => $val) {
			fwrite($handle, 'define("'.$key.'", "'.$val.'");');
			fwrite($handle, "\n");
		}
		echo "</div>";
		*/
		$configText = file_get_contents($confile);
		foreach($inputs as $key => $val) {
			$pattern[]='/define\(\"'.$key.'\",\s*.+\);/';
			$repContent[]='define("'.$key.'", "'.$val.'");';
		}
		$configText = preg_replace($pattern, $repContent, $configText);
		if(!file_put_contents($confile, $configText)){
			echo "安装失败，请检查数据库信息是否正确！";
			exit();
		}
		$url = "../admin.php";
	}
?>

<html>   
<head>   
<meta http-equiv="refresh" content="3; 
url=<?php echo $url; ?>">   
</head>   
<body>   
<h3 style="text-align:center">安装成功，正在跳转到后台页面……</h3>
</body> 
</html> 
