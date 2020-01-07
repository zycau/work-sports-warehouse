<?php
    
    require_once('Classes/DBAccess.php');
    require_once('Classes/Authentication.php');
    include 'settings/db.php';

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

    $db = new DBAccess($dsn, $username, $password);
    $pdo = $db->connect();

    // 进行插入新brand操作时
    if(isset($_POST['insertSubmit']) && strlen(trim($_POST['insertN']))>0){
        // 判断是否已经存在。
        $sql = 'SELECT BrandName FROM brands WHERE BrandName = :n';
        $m = $pdo->prepare($sql);
        $m->bindValue(':n', $_POST['insertN'], PDO::PARAM_STR);
        $result = $db->singleValue($m);

        if($result){
            $message = 'Something wrong happened, maybe brand is already existed.';
        }else{
            $sql = 'INSERT INTO brands (BrandName) VALUES (:n)';
            $m = $pdo->prepare($sql);
            $m->bindValue(':n', $_POST['insertN'], PDO::PARAM_STR);
            $result = $db->exeNoQuery($m, true);

            $message = 'Brand inserted, id: '.$result;
        }
    }

    // 当进行删除操作时
    if(isset($_GET['action']) && $_GET['action']=='delete' && isset($_GET['id'])){
        $sql = 'DELETE FROM brands WHERE BrandID = :id';
        $m = $pdo->prepare($sql);
        $m->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
        $result = $db->exeNoQuery($m);
        if($result>0){            
            $message = 'Brand deleted.';
        }elseif($result=='foreignKey'){
            $message = "Can't delete brand, foreign key restrict.";
        }else{
            $message = 'Somthing wrong happened.';
        }
    }

    // 当点击edit时
    if(isset($_GET['action']) && $_GET['action']=='edit' && isset($_GET['id'])){
        $id = $_GET['id'];
    }

    // 当进行修改操作并点击确认时
    if(isset($_POST['editSubmit']) && strlen(trim($_POST['editName']))>0 && $_POST['editId']>0){
        // 判断是否已经存在。
        $sql = 'SELECT BrandName FROM brands WHERE BrandName = :n';
        $m = $pdo->prepare($sql);
        $m->bindValue(':n', $_POST['editName'], PDO::PARAM_STR);
        $result = $db->singleValue($m);

        if($result){
            $message = 'Something wrong happened, maybe brand is already existed.';
        }else{
            $sql = 'UPDATE brands SET BrandName = :n WHERE BrandID = :id';
            $m = $pdo->prepare($sql);
            $m->bindValue(':n', $_POST['editName'], PDO::PARAM_STR);
            $m->bindValue(':id', $_POST['editId'], PDO::PARAM_INT);
            $result = $db->exeNoQuery($m);

            $message = 'Brand updated.';
        }
    }

    $sql = 'SELECT * FROM brands';
    $brands = $db->preExe($sql);
    
    ob_start();
    include 'Templates/admin/authen-brands.html.php';
    $output = ob_get_clean();
    include 'Templates/admin/authen-layout.html.php';





?>