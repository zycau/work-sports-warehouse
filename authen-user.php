<?php
	
    // Authentication.php中已包含DBAccess.php。
    require_once('Classes/Authentication.php');    
    include 'settings/db.php';

    if(!isset($_SESSION)){
        session_start();
    }

    // 用于保护管理员界面
    Authentication::protect();

    // $superAdmin放入Authentication Class中了
    $superAdmin = Authentication::$superAdmin;
    
    if(!isset($_SESSION['fun'])){
    	$_SESSION['fun'] = 'theme';
    }
    
    if(!isset($_SESSION['userTheme'])){
    	$_SESSION['userTheme'] = 'cold';
    }
    
    $message = '';

    // 选择不同功能时，定义$_SESSION['fun']，以展示不同的页面
    if(isset($_GET['fun'])){
    	if($_GET['fun']=='theme'){    		
    		$_SESSION['fun'] = 'theme';
    	}elseif($_GET['fun']=='pw'){    		
    		$_SESSION['fun'] = 'pw';
    	}  	
    }    

    // 点击更换主题时
    if(isset($_POST['submitTheme'])){
    	if($_POST['themes']=='cold'){
    		$_SESSION['userTheme'] = 'cold';
    	}elseif($_POST['themes']=='warm'){
    		$_SESSION['userTheme'] = 'warm';
    	}
    }

    // 点击修改密码时
    if(isset($_POST['submitChangePw'])){
    	if(strlen(trim($_POST['curPw']))>0 && strlen(trim($_POST['newPw']))>0 && strlen(trim($_POST['repPw']))>0){
    		$result = Authentication::changePassword($_POST['curPw'],$_POST['newPw'],$_POST['repPw']);
    		if($result){
    			$message = 'Password changed';    			
    		}else{
    			$message = 'Something wrong happened';
    		}

    	}else{
    		$message = 'Invalid input';
    	}    	
    }


    ob_start();
    include 'Templates/admin/authen-user.html.php';
    $output = ob_get_clean();
    include 'Templates/admin/authen-layout.html.php';






?>