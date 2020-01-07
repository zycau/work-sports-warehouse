<?php
    define('title', 'Sports Warehouse');

    require_once('Classes/DBAccess.php');
    include 'settings/db.php';

    if(!isset($_SESSION)){
        session_start();
    }

    if(!isset($_SESSION['topRight'])){
        $_SESSION['topRight'] = 0;
    }

    $db = new DBAccess($dsn, $username, $password);
    $pdo = $db->connect();

    $sql = 'SELECT * FROM `categories`';    
    $C = $db->preExe($sql);

    // 确定featured产品的个数，并取一个随机数。
    $sql = 'SELECT * FROM `products` WHERE Featured = 1';
    $PF = $db->preExe($sql);
    $r = rand(0,(count($PF)-5));    

    $sql = "SELECT * FROM `products` WHERE Featured = 1 LIMIT $r, 5";
    $P = $db->preExe($sql);

    ob_start();

    include 'Templates/home.html.php';

    $output = ob_get_clean();

    include 'Templates/Layout.html.php';

?>