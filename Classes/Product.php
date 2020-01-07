<?php
    require_once('Classes/DBAccess.php');
    class Product{
        private $_productId;
        private $_productName;
        private $_price;
        private $_pic;
        private $_brand;
        private $_category;
        private $_db;

        public function __construct(){
            include 'settings/db.php';
            try{
                $this->_db = new DBAccess($dsn,$username,$password);

            }catch(PDOException $e){
                echo 'Unable to connect to database, '.$e->message();
            }
        }

        // 当有id传入时，从数据库中搜索对应这个id的product
        public function getProduct($id){
            try{
                $pdo = $this->_db->connect();
                $sql = 'SELECT * FROM `products`,`categories`,`brands`
                       WHERE `products`.Category = `categories`.CategoryID
                       AND `products`.Brand = `brands`.BrandID
                       AND `products`.ProductID = :id';
                $m = $pdo->prepare($sql);
                $m->bindValue(':id', $id, PDO::PARAM_INT);
                $P = $this->_db->exe($m);
                $result = $P[0];

                $this->_productId = $result['ProductID'];
                $this->_productName = $result['ProductName'];
                $this->_price = $result['SalePrice'];
                $this->_pic = $result['Photo'];
                $this->_brand = $result['BrandName'];
                $this->_category = $result['CategoryName'];
            }catch(PDOException $e){
                throw $e;
            }
        }

        // 得到并返回所有的商品，在这里限定个数为15个
        public function getProducts(){
            try{
                $pdo = $this->_db->connect();
                $sql = 'SELECT * FROM `products`,`categories`,`brands`
                       WHERE `products`.Category = `categories`.CategoryID
                       AND `products`.Brand = `brands`.BrandID';
                $result = $this->_db->preExe($sql);
                return $result;
            }catch(PDOException $e){
                throw $e;
            }
        }

        // 在getProduct()以后获取商品的id。
        public function getProductId(){
            return $this->_productId;
        }

        // 在getProduct()以后获取商品的名字。
        public function getProductName(){
            return $this->_productName;
        }

        // 在getProduct()以后获取商品的价格。
        public function getPrice(){
            return $this->_price;
        }

        // 在getProduct()以后获取商品的照片。
        public function getPic(){
            return $this->_pic;
        }

        // 在getProduct()以后获取商品的品牌。
        public function getBrand(){
            return $this->_brand;
        }

        // 在getProduct()以后获取商品的类别。
        public function getCategory(){
            return $this->_category;
        }


    }


?>