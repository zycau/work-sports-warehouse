<?php
    define('title', 'Checkout');

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

    // 本页面只用于显示用户的送货信息

    ob_start();
    include 'Templates/checkout.html.php';
    $output = ob_get_clean();    
    include 'Templates/Layout.html.php';



?>