<?php
class Category{
	private $_categoryName;
	private $_categoryId;
	private $_description;
	private $_db;

	// 一旦生成这个class，就连接数据库
	public function __construct(){
		require_once 'Classes/DBAccess.php';
		include 'settings/db.php';

		try{
			$this->_db = new DBAccess($dsn, $username, $password);
		}
		catch(PDOException $e){
			echo 'Unable to connect to database, '.$e->message();
		}
	}

	// 得到CategoyID
	public function getCategoryId(){
		return $this->_categoryId;
	}

	// 得到CategoyName
	public function getCategoryName(){
		return $this->_categoryName;
	}

	// 得到description
	public function getDescription(){
		return $this->_description;
	}

	// CategoryId无需设定。
	// 设定CategoryName，用于更新或者插入。
	public function setCategoryName($n){
		$this->_categoryName = trim($n);
	}

	// 设定description，用于更新或者插入。
	public function setDescription($d){
		$this->_description = trim($d);
	}

	// 只选取一个特定id的category的函数
	public function getCategory($id){
		try{
			$pdo = $this->_db->connect();
			$sql = 'SELECT * FROM categories 
				   WHERE CategoryID = :id';
			$m = $pdo->prepare($sql);
			$m->bindValue(':id', $id, PDO::PARAM_INT);
			// 只选取一个category，所以需要加[0]
			$result = ($this->_db->exe($m))[0];

			$this->_categoryId = $result['CategoryID'];
			$this->_categoryName = $result['CategoryName'];
			$this->_description = $result['Description'];
		}
		catch(PDOException $e){
			throw $e;
		}
	}

	// 选取所有category的函数。
	public function getCategories(){
		try{
			$pdo = $this->_db->connect();
			$sql = 'SELECT * FROM categories';
			$result = $this->_db->preExe($sql);
			return $result;
		}
		catch(PDOException $e){
			throw $e;
		}
	}

	// 得到所有categories的个数。
	public function categoriesNumber(){
		try{
			$pdo = $this->_db->connect();
			$sql = 'SELECT COUNT(*) FROM categories';
			$m = $pdo->prepare($sql);
			$result = $this->_db->singleValue($m);
			return $result;
		}
		catch(PDOException $e){
			throw $e;
		}
	}

	// 插入一个新的category
	public function insertCategory(){
		// 检验是否已经存在
		try{
			$pdo = $this->_db->connect();
			$sql = 'SELECT CategoryName FROM categories
				   WHERE CategoryName = :n';
			$m = $pdo->prepare($sql);
			$m->bindParam(':n', $this->_categoryName, PDO::PARAM_STR);
			$result = $this->_db->singleValue($m);
			if($result){
				return false;
			}
		}catch(PDOExeption $e){
			throw $e;
		}
		
		
		try{
			$pdo = $this->_db->connect();
			$sql = 'INSERT INTO categories (CategoryName) VALUES (:n)';
			$m = $pdo->prepare($sql);
			// bindParam和bindValue的区别需百度，其实区别较小，这里用前者是为了防止先使用insertCategory，再设定$this->_categoryName和$this->_description。
			$m->bindParam(':n', $this->_categoryName, PDO::PARAM_STR);		
			$result = $this->_db->exeNoQuery($m,true);
			return $result;
		}
		catch(PDOExeption $e){
			throw $e;
		}
	}

	// 更新一个category
	public function updateCategory($id){
		// 检验是否已经存在
		try{
			$pdo = $this->_db->connect();
			$sql = 'SELECT CategoryName FROM categories
				   WHERE CategoryName = :n';
			$m = $pdo->prepare($sql);
			$m->bindParam(':n', $this->_categoryName, PDO::PARAM_STR);
			$result = $this->_db->singleValue($m);
			if($result){
				return false;
			}
		}catch(PDOExeption $e){
			throw $e;
		}
		
		try{
			$pdo = $this->_db->connect();
			$sql = 'UPDATE categories SET CategoryName = :n WHERE CategoryID = :id';
			$m = $pdo->prepare($sql);
			// bindParam和bindValue的区别需百度，其实区别较小，这里用前者是为了防止先使用insertCategory，再设定$this->_categoryName和$this->_description。
			$m->bindParam(':n', $this->_categoryName, PDO::PARAM_STR);	
			$m->bindParam(':id', $id, PDO::PARAM_INT);
			$result = $this->_db->exeNoQuery($m);
			return $result;
		}
		catch(PDOExeption $e){
			throw $e;
		}		
	}

	// 删除一个category。
	public function deleteCategory($id){
		try{
			$pdo = $this->_db->connect();
			$sql = 'DELETE FROM categories WHERE CategoryID = :id';
			$m = $pdo->prepare($sql);
			// bindParam和bindValue的区别需百度，其实区别较小，这里用前者是为了防止先使用insertCategory，再设定$this->_categoryName和$this->_description。			
			$m->bindValue(':id', $id, PDO::PARAM_INT);
			$result = $this->_db->exeNoQuery($m);
			return $result;
		}
		catch(PDOExeption $e){
			throw $e;
		}	
	}


}
?>