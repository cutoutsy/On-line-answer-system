<?php
		if (mysql_query('CREATE DATABASE '.$_SESSION["dbname"].' CHARACTER SET "utf8"COLLATE "utf8_general_ci"',$link))
		  {
		  echo "<h3>Database created......</h3>";
		  }
		else
		  {
		  echo "<h3>Error creating database: " . mysql_error()."</h3>";
		  }
		mysql_select_db($_SESSION["dbname"], $link);
		$sql = "CREATE TABLE users 
		(
		uid int not null AUTO_INCREMENT,
		email varchar(255) not null,
		nick varchar(255) not null,
		passwd varchar(255) not null,
		passwdmd5 varchar(255) not null,
		primary key(uid)
		)ENGINE=InnoDB DEFAULT CHARSET=utf8";
		if(mysql_query($sql,$link)){
			echo "<h3>Tables created......"."<br>";
		}else{
			echo "<h3>Error creating database:".mysql_error()."</h3>";
		}
		$url = "./index.html";
		//mysql_close($link);
?>

<html>   
<head>   
<meta http-equiv="refresh" content="2;  
url=<?php echo $url; ?>">   
</head>   
<body>   
<h3>正在跳转到注册页面……</h3>
</body> 
</html>  