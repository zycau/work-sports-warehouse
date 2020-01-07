<?php
    define('title', 'Pay success');

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

    $orderId = -1;
    
    if(isset($_POST['pay']) && isset($_SESSION['cart'])){
        $orderId = $_SESSION['cart']->saveCart($_SESSION['FN'],$_SESSION['LN'],$_SESSION['PC'],$_SESSION['A'],$_SESSION['CN'],$_SESSION['E'],$_POST['cardNumber'],$_POST['nameOnCard'],$_POST['expiryDate'],$_POST['csv']);

        if($orderId>0){
            session_destroy();
        }
        
        $_SESSION['topRight'] = 0;
    }

    ob_start();
    include 'Templates/paySuccess.html.php';
    $output = ob_get_clean();
    include 'Templates/Layout.html.php';


?>