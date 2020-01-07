<?php
    // Category.php中已包含DBAccess.php和db.php。
    require_once('Classes/Category.php');
    require_once('Classes/Authentication.php');

    if(!isset($_SESSION)){
        session_start();
    }

    // 用于保护管理员界面
    Authentication::protect();

    // $superAdmin放入Authentication Class中了
    $superAdmin = Authentication::$superAdmin;    
    
    if(!isset($_SESSION['userTheme'])){
    	$_SESSION['userTheme'] = 'cold';
    }
    
    $message = '';

    $category = new Category();    

    // 进行插入新category操作时
    if(isset($_POST['insertSubmit']) && strlen(trim($_POST['insertN']))>0){
        
        $category->setCategoryName($_POST['insertN']);
        $result = $category->insertCategory();
        if($result){
            $message = 'Category inserted, id: '.$result;
        }else{
            $message = 'Something wrong happened, maybe category is already existed.';
        }        
    }

    // 当进行删除操作时
    if(isset($_GET['action']) && $_GET['action']=='delete' && isset($_GET['id'])){
        $result = $category->deleteCategory($_GET['id']);
        if($result>0){            
            $message = 'Category deleted.';
        }elseif($result=='foreignKey'){
            $message = "Can't delete category, foreign key restrict.";
        }
    }

    // 当点击edit时
    if(isset($_GET['action']) && $_GET['action']=='edit' && isset($_GET['id'])){
        $id = $_GET['id'];
    }

    // 当进行修改操作并点击确认时
    if(isset($_POST['editSubmit']) && strlen(trim($_POST['editName']))>0 && $_POST['editId']>0){
        $category->setCategoryName($_POST['editName']);
        $result = $category->updateCategory($_POST['editId']);
        if($result){
            $message = 'Category updated.';
        }else{
            $message = 'Something wrong happened.';
        }
    }


    $categories = $category->getCategories();

    ob_start();
    include 'Templates/admin/authen-categories.html.php';
    $output = ob_get_clean();
    include 'Templates/admin/authen-layout.html.php';





?>