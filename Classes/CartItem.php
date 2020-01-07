<?php 
	// 这个object比较简单，只用来设定并获得购物车里单个商品的id，名字，价格，数量。
	class CartItem {
		private $_itemId;
		private $_itemName;
		private $_price;
		private $_quantity;		

		public function __construct($id, $name, $price, $quantity){
			$this->_itemId = (int)$id;
			$this->_itemName = $name;
			$this->_price = (float)$price;
			$this->_quantity = (int)$quantity;			
		}

		public function getItemId(){
			return $this->_itemId;
		}

		public function getItemName(){
			return $this->_itemName;
		}

		public function getPrice(){
			return $this->_price;
		}

		public function setQuantity($q){
			if($q >= 0){
				$this->_quantity = (int)$q;
			}else{
				throw new Exception('Quantity must be positive');
			}
			
		}

		public function getQuantity(){
			return $this->_quantity;
		}


	}


 ?>