<?php
    define('title', 'Login');
    
    require_once('Classes/DBAccess.php');
    require_once('Classes/Authentication.php');  
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

    $message = '';

    if(isset($_POST['loginSubmit'])){
        if(strlen(trim($_POST['username']))>0 && strlen(trim($_POST['password']))>0){
            $result = Authentication::login($_POST['username'], $_POST['password']);

            if(!$result){
                $message = 'Incorrect username or password.';
            }
        }
    }

    ob_start();
    include 'Templates/login.html.php';
    $output = ob_get_clean();
    include 'Templates/Layout.html.php';




?>