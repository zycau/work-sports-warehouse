<?php
	define('title', 'Shopping Cart');

    // ShoppingCart.php中已包含DBAccess.php和CartItem.php。
    require_once('Classes/ShoppingCart.php');
    require_once('Classes/Product.php');
    include 'settings/db.php';

    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['topRight'])){
        $_SESSION['topRight'] = 0;
    }    

    $db = new DBAccess($dsn, $username, $password);
    $pdo = $db->connect();

    // 用于维持header和footer。
    $sql = 'SELECT * FROM `categories`';    
    $C = $db->preExe($sql);
    $sql = 'SELECT * FROM `brands`';    
    $B = $db->preExe($sql);

    $product = new Product();
    
    // 点击“+”按钮后，该商品的数量加一。
    if(isset($_POST['plus']) && $_POST['itemId1']>0){
        $qtyOld = $_SESSION['cart']->getItem($_POST['itemId1'])->getQuantity();
        if($qtyOld<=98){
            $qtyNew = (int)$qtyOld + 1;
            $_SESSION['cart']->getItem($_POST['itemId1'])->setQuantity($qtyNew);
        }        
    }

    // 点击“-”按钮后，该商品的数量减一。
    if(isset($_POST['minus']) && $_POST['itemId1']>0){
        $qtyOld = $_SESSION['cart']->getItem($_POST['itemId1'])->getQuantity();
        if($qtyOld>1){
            $qtyNew = (int)$qtyOld - 1;
            $_SESSION['cart']->getItem($_POST['itemId1'])->setQuantity($qtyNew);
        }        
    }

    // 点击remove按钮后，在购物车中删去该商品
    if(isset($_POST['removeItem']) && $_POST['itemId2']>0){
        $_SESSION['cart']->removeItem($_POST['itemId2']);        
    }

    // 重新定义右上角购物车中的数字
    if(isset($_SESSION['cart'])){
        $_SESSION['topRight'] = $_SESSION['cart']->calcQty(); 
    }
           

    ob_start();
    include 'Templates/cart.html.php';
    $output = ob_get_clean();    
    include 'Templates/Layout.html.php';



?>