<?php
    define('title', 'Contact Us');
    
    require_once('Classes/formValidation.php');
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

    // 用于维持header和footer。
    $sql = 'SELECT * FROM `categories`';    
    $C = $db->preExe($sql);
    $sql = 'SELECT * FROM `brands`';    
    $B = $db->preExe($sql);
    
    $form = new Validation();

    if(isset($_POST['submitForm'])){        
        $form->name('firstName');
        $form->name('lastName');
        $form->email('email');
        if($form->errLength()==0){
            header('Location: thanks.php');        
        }        
    }
    
    ob_start();
    include 'Templates/contact.html.php';    
    $output = ob_get_clean();
    include 'Templates/Layout.html.php';

?>