<?php
	
    // Authentication.php中已包含DBAccess.php。
    require_once('Classes/Authentication.php');    
    include 'settings/db.php';

    if(!isset($_SESSION)){
        session_start();
    }

    // $superAdmin放入Authentication Class中了
    $superAdmin = Authentication::$superAdmin;

    // 用于保护管理员界面
    Authentication::protect();
    
    if(!isset($_SESSION['userTheme'])){
    	$_SESSION['userTheme'] = 'cold';
    }
    
    $message = '';

    if(!in_array($_SESSION['username'],$superAdmin)){
        header('Location: authen-user.php');
    }

    // 点击删除用户时
    if(isset($_GET['name']) && isset($_GET['act']) && $_GET['act']=='delete'){
    	$result = Authentication::deleteUser($_GET['name']);
    	if($result){
    		$message = 'User deleted';
    	}else{
    		$message = 'Something wrong happened';
    	}
    }
    
    // 点击增加用户时
    if(isset($_POST['submitNewUser'])){
    	if(strlen(trim($_POST['newUser']))==0){
    		$message = 'Invalid username';
    	}elseif($_POST['newUserPw'] !== $_POST['repUserPw']){
    		$message = 'Please confirm the password';
    	}elseif(strlen(trim($_POST['newUserPw']))==0 && strlen(trim($_POST['repUserPw']))==0){
    		$message = 'Need password';
    	}else{
    		$result = Authentication::createUser($_POST['newUser'], $_POST['newUserPw']);
    		if($result){
    			$message = 'User created';
    		}else{
    			$message = 'User already existed';
    		}
    	}    	
    }
    
    // 得到$admin，以便在html中显示user表格。
    $db = new DBAccess($dsn, $username, $password);
	$pdo = $db->connect();
	$sql = 'SELECT username FROM user';
	$admin = $db->preExe($sql);

    ob_start();
    include 'Templates/admin/authen-administrator.html.php';
    $output = ob_get_clean();
    include 'Templates/admin/authen-layout.html.php';






?>