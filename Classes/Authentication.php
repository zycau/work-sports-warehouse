<?php 
	require_once('DBAccess.php');

	class Authentication {
		// 定义login页面和登陆成功后的页面的网址，这两个地址可以改动。
		const LoginPageURL = 'login.php';
		const SuccessPageURL = 'authen-user.php';

		// 定义一个静态属性。
		private static $_db;

		public static $superAdmin = ['admin'];

		// 定义一个静态方法创建用户，1.静态方法可以调用静态属性，禁止调用非静态属性。2.静态方法内不允许出现$this，出现就停掉脚本。3.在静态方法中调用类中其他静态方法有两种格式 self:: 和 static::，在父类中声明一个静态方法A，子类中重写了这个静态方法A。在父类其他方法中使用self调用A，会执行父类中A的方法；但是使用static调用，就会执行子类A的方法。
		public static function createUser($name, $pw){
			$hash = password_hash($pw, PASSWORD_DEFAULT);

			include 'settings/db.php';

			// 连接数据库，注意这里只能用self::，而不是$this->
			try{
				self::$_db = new DBAccess($dsn, $username, $password);
			}catch(PDOException $e){
				echo 'Unable to connect to database';
			}

			// 判断用户名是否已经存在
			try{
				$pdo = self::$_db->connect();
				$sql = "SELECT username FROM user
					   WHERE username = :u";
				$m = $pdo->prepare($sql);
				$m->bindParam(':u', $name, PDO::PARAM_STR);
				$result = self::$_db->exe($m);
			}catch(PDOException $e){
				throw $e;
			}

			// 如果用户名已经存在，返回false，如果不存在，在数据库中插入新创建的用户名和密码。
			if(count($result)>0){
				return false;
			}else{
				try{
					$pdo = self::$_db->connect();
					$sql = 'INSERT user (username, password) VALUES(:u, :p)';
					$m = $pdo->prepare($sql);
					$m->bindParam(':u', $name, PDO::PARAM_STR);
					$m->bindParam(':p', $hash, PDO::PARAM_STR);
					self::$_db->exeNoQuery($m);

					return true;

				}catch(PDOException $e){
					throw $e;
				}
			}
			
		}

		// 定义一个静态方法login。
		public static function login($name, $pw ){
		//$username和$password在下面会用到，所以这里用这两个词
			include 'settings/db.php';

			// 连接数据库，注意这里只能用self::，而不是$this->
			try{
				self::$_db = new DBAccess($dsn, $username, $password);
			}catch(PDOException $e){
				echo 'Unable to connect to database';
			}

			// 在数据库中查询，找到输入的username对应的那个被hash过的密码。
			try{
				$pdo = self::$_db->connect();
				$sql = 'SELECT password FROM user
					   WHERE username = :name';
				$m = $pdo->prepare($sql);
				$m->bindParam(':name', $name, PDO::PARAM_STR);
				$hash = self::$_db->singleValue($m);
				if(!$hash){
					return false;
				}
			}catch(PDOException $e){
				throw $e;
			}

			// 验证密码，如果符合的话跳转到登陆成功页面。注意header之后加exit。
			if(password_verify($pw, $hash)){
				$_SESSION['username'] = $name;
				header('Location: '.self::SuccessPageURL);
				exit;
				return true;
			}else{
				return false;
			}
		}

		// 定义一个静态方法修改密码
		public static function changePassword($currentPw, $newPw, $repeatPw){
			if(isset($_SESSION['username'])){
				include 'settings/db.php';
				// 连接数据库，注意这里只能用self::，而不是$this->
				try{
					self::$_db = new DBAccess($dsn, $username, $password);
				}catch(PDOException $e){
					echo 'Unable to connect to database';
				}

				// 在数据库中查询，找到输入的username对应的那个被hash过的密码。
				try{
					$pdo = self::$_db->connect();
					$sql = 'SELECT password FROM user
						   WHERE username = :name';
					$m = $pdo->prepare($sql);
					$m->bindParam(':name', $_SESSION['username'], PDO::PARAM_STR);
					$hash = self::$_db->singleValue($m);					
				}catch(PDOException $e){
					throw $e;
				}

				// 验证密码，如果成功修改密码。
				if(password_verify($currentPw, $hash) && $newPw == $repeatPw){
					$newHash =  password_hash($newPw, PASSWORD_DEFAULT);

					try{
						$pdo = self::$_db->connect();
						$sql = 'UPDATE user SET password = :new 
							   WHERE username = :name';
						$m = $pdo->prepare($sql);
						$m->bindParam(':name', $_SESSION['username'], PDO::PARAM_STR);
						$m->bindParam(':new', $newHash, PDO::PARAM_STR);
						self::$_db->exeNoQuery($m);

						return true;
					}catch(PDOException $e){
						throw $e;
					}

				}else{
					return false;
				}
			}
		}

		// 定义一个静态方法删除用户
		public static function deleteUser($name){
			include 'settings/db.php';
			// 连接数据库，注意这里只能用self::，而不是$this->
			try{
				self::$_db = new DBAccess($dsn, $username, $password);
			}catch(PDOException $e){
				echo 'Unable to connect to database';
			}

			try{
				$pdo = self::$_db->connect();
				$sql = 'DELETE FROM user 
					   WHERE username = :name';
				$m = $pdo->prepare($sql);
				$m->bindParam(':name', $name, PDO::PARAM_STR);
				self::$_db->exeNoQuery($m);
				return true;				
			}catch(PDOException $e){
				throw $e;
			}


		}


		// 定义一个静态方法logout，退出登陆以后跳转到登陆页面。
		public static function logout(){
			unset($_SESSION['username']);
			header('Location: '.self::LoginPageURL);
			exit;
		}

		// 定义一个静态方法protect，如果没有登陆则跳转到登陆页面。所有被保护的页面都应该先引用这个函数。
		public static function protect(){
			if(!isset($_SESSION['username'])){
				header('Location: '.self::LoginPageURL);
				exit;
			}
		}


	}




 ?>