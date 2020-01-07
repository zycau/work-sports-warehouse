<?php
    define('title', 'Pay');

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

    // 如果在checkout.html.php中点了submit，则把用户的送货信息存在session中，以便在pay.php中使用，并存入数据库中。
    if(isset($_POST['submitAndPay'])){
        if(strlen($_POST['firstName'])>0 && strlen($_POST['lastName'])>0 && strlen($_POST['contactNumber'])>0 && strlen($_POST['postcode'])>0 && strlen($_POST['address'])>0){
            $_SESSION['FN'] = $_POST['firstName'];
            $_SESSION['LN'] = $_POST['lastName'];
            $_SESSION['CN'] = $_POST['contactNumber'];
            $_SESSION['E'] = $_POST['email'];
            $_SESSION['PC'] = $_POST['postcode'];
            $_SESSION['A'] = $_POST['address'];

        }

    };

    

    ob_start();
    include 'Templates/pay.html.php';
    $output = ob_get_clean();    
    include 'Templates/Layout.html.php';



?>