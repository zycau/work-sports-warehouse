<!-- 在家里和在学校的端口不一样，在家里有88 -->
<?php
	if($_SERVER['SERVER_NAME']=='localhost' || $_SERVER['SERVER_ADDR']=='127.0.0.1'){
		$dsn='mysql: host=localhost:88;dbname=sportswarehouse_zyc;charset=utf8';
		$username = 'root';
		$password = '';
	}else{
		$dsn = 'mysql: host=localhost;dbname=yzidau_yucheng_sportswarehouse;charset=utf8';
		$username = 'yzidau_zyc';
		$password = 'A8EQ==D0+33I';
	}
?>