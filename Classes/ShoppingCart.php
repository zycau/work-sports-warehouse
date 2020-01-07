<?php 
	require_once('CartItem.php');
	require_once('DBAccess.php');

	class ShoppingCart{
		private $_cartItems = []; //[item1, item2,...], 其中item1 = new CartItem(1, icecream, 5.2, 2)
		private $_shoppingOrderId;

		// 用于计算购物车中一共有多少种商品
		public function count(){
			return count($this->_cartItems);
		}

		// 用于设定购物车的id
		public function setShoppingOrderId($id){
			$this->_shoppingOrderId = (int)$id;
		}

		// 用于获得购物车中展示所有物品及其信息的数组
		public function getItems(){
			return $this->_cartItems;
		}


		// 内部函数，用于测试传入的物品是否已在购物车中，如果是，返回这个物品。
		private function inCart($item){
			$found = null;
			foreach($this->_cartItems as $i){
				// 每一个加入$this->_cartItems的元素都是CartItem的object，所以可以在下面应用getItemId()这个函数。
				if($i->getItemId() == $item->getItemId()){
					$found = $item;
				}
			}
			return $found;
		}

		// 内部函数，用于查看传入的物品在购物车中的序号是多少（序号从0开始），返回这个序号，如果没有则返回-1。
		private function itemIndex($item){
			$index = -1;
			for($i=0; $i<$this->count(); $i++){
				if($item->getItemId() == $this->_cartItems[$i]->getItemId()){
					$index = $i;
				}
			}
			return $index;
		}

		// 用于更新购物车中的某种商品的数量，新的数量=旧的数量+新增加的数量
		private function updateItem($item){
			// 在这里应用了itemIndex()这个内部函数
			$index = $this->itemIndex($item);
			if($index>=0){ //这个if语句只是为了保险，其实既然update，那必然已在购物车中
				$oldQty = $this->_cartItems[$index]->getQuantity();
				$addQty = $item->getQuantity();
				$newQty = $oldQty + $addQty;
				$this->_cartItems[$index]->setQuantity($newQty);
				// 因为$this->_cartItems[$index]的数量已经重新设定为$newQty，所以如果再次add同一个item，数量会翻倍！！！
			}
		}

		// 用于在购物车中添加物品，如果已经有该物品则更新物品。
		public function addItem($item){
			if($this->inCart($item)){
				$this->updateItem($item);
			}else{
				$this->_cartItems[] = $item;
			}
		}

		// 用于移除购物车中的商品。
		public function removeItem($id){
			for($i=0; $i<$this->count(); $i++){
				if($id == $this->_cartItems[$i]->getItemId()){
					unset($this->_cartItems[$i]);
					$this->_cartItems = array_values($this->_cartItems);
					break;
				}
			}
			// $index = $this->itemIndex($item);
			// if($index>=0){
			// 	unset($this->_cartItems[$index]);
			// 	$this->_cartItems = array_values($this->_cartItems);
			// }
		}

		// 根据id获取某个item，然后就可以使用CartItem.php中的函数了。
		public function getItem($id){
			for($i=0; $i<$this->count(); $i++){
				if($id == $this->_cartItems[$i]->getItemId()){
					return $this->_cartItems[$i];
				}
			}
		}

		// 计算购物车中所有物品的总价
		public function calcTotal(){			
			$value = 0;
			foreach($this->_cartItems as $v){
				$value += $v->getPrice()*$v->getQuantity();
			}
			return $value;
		}

		// 计算购物车中共有多少件商品。
		public function calcQty(){			
			$value = 0;
			foreach($this->_cartItems as $v){
				$value += $v->getQuantity();
			}
			return $value;
		}
		
		// 将购物车的信息，以及用户信息保存至数据库
		public function saveCart($firstName, $lastName, $postcode, $address, $contactNumber, $email, $cardNumber, $nameOnCard, $expiry, $csv){
			// require_once('Classes/DBAccess.php')在文件最开始已经加上了
			include 'settings/db.php';

			$db = new DBAccess($dsn, $username, $password);
			$pdo = $db->connect();

   			//注意：下面的curtime()是sql函数。
			$sql = "INSERT `shoppingorder`(OrderDate, FirstName, LastName, Postcode, `Address`, ContactNumber, Email, CreditCardNumber, ExpiryDate, NameOnCard, Csv) VALUES (curtime(), :fn, :ln, :pc, :add, :cn, :e, :ccn, :ed, :noc, :csv) ";
			$m = $pdo->prepare($sql);
			$m->bindValue(':fn', $firstName, PDO::PARAM_STR);
			$m->bindValue(':ln', $lastName, PDO::PARAM_STR);
			$m->bindValue(':pc', $postcode, PDO::PARAM_STR);
			$m->bindValue(':add', $address, PDO::PARAM_STR);			
			$m->bindValue(':cn', $contactNumber, PDO::PARAM_STR);
			$m->bindValue(':e', $email, PDO::PARAM_STR);
			$m->bindValue(':ccn', $cardNumber, PDO::PARAM_STR);
			$m->bindValue(':ed', $expiry, PDO::PARAM_STR);
			$m->bindValue(':noc', $nameOnCard, PDO::PARAM_STR);
			$m->bindValue(':csv', $csv, PDO::PARAM_STR);

			$shoppingCartId = $db->exeNoQuery($m, true);

			foreach($this->_cartItems as $v){
				$sql = 'INSERT `orderitem` (itemId, shoppingOrderId, quantity, price) VALUES (:id, :soid, :q, :p)';
				$m = $pdo->prepare($sql);
				$m->bindValue(':id', $v->getItemId(), PDO::PARAM_INT);
				$m->bindValue(':soid', $shoppingCartId, PDO::PARAM_INT);
				$m->bindValue(':q', $v->getQuantity(), PDO::PARAM_INT);
				$m->bindValue(':p', $v->getPrice(), PDO::PARAM_STR);
				$db->exeNoQuery($m);
			}

			return $shoppingCartId;
		}

		// 用来做测试的函数
		public function test(){
			print_r($this->_cartItems);
		}

	}

 ?>