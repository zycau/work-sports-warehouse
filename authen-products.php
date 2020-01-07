<?php
    require_once('Classes/DBAccess.php');
    require_once('Classes/Authentication.php');
    require_once('Classes/Upload.php');
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

    // 当进行插入新产品操作时
    if(isset($_POST['insertSubmit'])){
        // 进行一系列简单的validation，如果都通过，执行插入操作。
        if(strlen(trim($_POST['insertN']))==0){
            $message = 'Please enter product name';
        }elseif(empty($_FILES['insertPhoto']['name'])){
            $message = 'Please supply product image';
        }elseif(strlen(trim($_POST['insertPrice']))==0 || $_POST['insertPrice']<=0){
            $message = 'Invalid price';
        }elseif(strlen(trim($_POST['insertSalePrice']))==0 || $_POST['insertSalePrice']<=0){
            $message = 'Invalid sale price';
        }elseif(strlen(trim($_POST['insertDescription']))<30){
            $message = 'At least 30 characters for description';
        }else{
            $up = new Upload('images/products/','insertPhoto');
            $up->extTest();
            $up->sizeTest();
            $up->nameTest();
            $result = $up->upload();
            
            if($result){
                $sql = 'INSERT INTO products (ProductName, Photo, Price, SalePrice, `Description`, Brand, Featured, Category) VALUES (:pn, :ph, :pr, :sp, :de, :br, :fe, :ca)';
                $m = $pdo->prepare($sql);
                $m->bindValue(":pn", $_POST['insertN'], PDO::PARAM_STR);
                $m->bindValue(":ph", $up->fn, PDO::PARAM_STR);
                $m->bindValue(":pr", $_POST['insertPrice'], PDO::PARAM_STR);
                $m->bindValue(":sp", $_POST['insertSalePrice'], PDO::PARAM_STR);
                $m->bindValue(":de", $_POST['insertDescription'], PDO::PARAM_STR);
                $m->bindValue(":br", $_POST['insertBrand'], PDO::PARAM_STR);
                $m->bindValue(":fe", $_POST['insertFeatured'], PDO::PARAM_STR);
                $m->bindValue(":ca", $_POST['insertCategory'], PDO::PARAM_STR);
                $result = $db->exeNoQuery($m,true);
                
                if($result){
                    $message = 'Prouct inserted, id: '.$result.'. DO NOT refresh page!';
                }else{
                    $message = 'Something wrong happened.';
                }
                
            }else{
                $message = $up->msg;
            }
        }
    }

    // 当进行删除操作时
    if(isset($_GET['action']) && $_GET['action']=='delete' && isset($_GET['id'])){
        // 如果产品id小于等于26，不允许删除
        if($_GET['id']<=26){
            $message = 'Can not delete the product whose id<=26.';
        }else{
            // 如果无法删除产品图片，操作停止
            if(file_exists($_GET['photo']) && !unlink($_GET['photo'])){
                $message = 'Error deleting '.$_GET['photo'];
            }else{
                $sql = 'DELETE FROM products WHERE ProductID = :id';
                $m = $pdo->prepare($sql);
                $m->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
                $result = $db->exeNoQuery($m);
                if($result>0){            
                    $message = 'Product deleted.';
                }else{
                    $message = 'Somthing wrong happened.';
                }
            }            
        }
    }

    // 当点击edit按钮时
    if(isset($_GET['action']) && $_GET['action']=='edit' && isset($_GET['id'])){
        $id = $_GET['id'];
    }

    // 当编辑以后确定时
    if(isset($_POST['editSubmit'])){
        // 先对表单进行简单的validation，如果都通过，执行else语句。
        if($_POST['editId']<=26){
            $message = 'Can not edit the product whose id<=26.';
        }elseif(strlen(trim($_POST['editName']))==0){
            $message = 'Please enter product name';
        }elseif(strlen(trim($_POST['editPrice']))==0 || $_POST['editPrice']<=0){
            $message = 'Invalid price';
        }elseif(strlen(trim($_POST['editSalePrice']))==0 || $_POST['editSalePrice']<=0){
            $message = 'Invalid sale price';
        }elseif(strlen(trim($_POST['editDescription']))<30){
            $message = 'At least 30 characters for description';
        }else{
            // 设定一个代码，如果为1，则更新数据库，如果在上传图片过程中出现问题，则不更新
            $do = 1;
            
            // 如果更新了图片，则先上传图片，并更新数据库。
            if(!empty($_FILES['editPhoto']['name'])){
                // 上传新图片
                $up = new Upload('images/products/', 'editPhoto');
                $up->extTest();
                $up->sizeTest();
                $up->nameTest();
                $result = $up->upload();

                if(!$result){
                    $message = $up->msg;
                    $do = 0;
                }else{
                    // 如果上传成功，则删除旧图片
                    if(file_exists($_POST['oldPhoto']) && !unlink($_POST['oldPhoto'])){
                        // 如果不能删除旧图片，停止执行。
                        $message = 'Error deleting '.$_POST['oldPhoto'];
                        $do = 0;
                        unlink('images/products/'.$up->fn);
                    }else{
                        // 删除旧图片成功，则在数据库中更新图片路径
                        $sql = 'UPDATE products SET Photo = :ph
                        WHERE ProductID = :id';
                        $m = $pdo->prepare($sql);
                        $m->bindValue(':ph', $up->fn, PDO::PARAM_STR);
                        $m->bindValue(':id', $_POST['editId'], PDO::PARAM_STR);
                        $result = $db->exeNoQuery($m);

                        // 如果在数据库中更新照片路径出现问题，停止执行。
                        if(!$result){
                            $message = 'Something wrong happened when updating photo name.';
                            $do = 0;
                        }
                    }
                }
            }

            // 如果$do为1，则执行其他参数数据库更新操作
            if($do){
                $sql = 'UPDATE products SET ProductName = :pn, Price = :pr, SalePrice = :sp, `Description` = :de, Brand = :br, Featured = :fe, Category = :ca WHERE ProductID = :id';
                $m = $pdo->prepare($sql);
                $m->bindValue(":pn", $_POST['editName'], PDO::PARAM_STR);
                $m->bindValue(":pr", $_POST['editPrice'], PDO::PARAM_STR);
                $m->bindValue(":sp", $_POST['editSalePrice'], PDO::PARAM_STR);
                $m->bindValue(":de", $_POST['editDescription'], PDO::PARAM_STR);
                $m->bindValue(":br", $_POST['editBrand'], PDO::PARAM_STR);
                $m->bindValue(":fe", $_POST['editFeatured'], PDO::PARAM_STR);
                $m->bindValue(":ca", $_POST['editCategory'], PDO::PARAM_STR);
                $m->bindValue(":id", $_POST['editId'], PDO::PARAM_STR);
                $result = $db->exeNoQuery($m);

                if($result){
                    $message = 'Product updated.';
                }else{
                    $message = 'Something wrong happened.';
                }
            }
        }
    }    
    
    // 当点击了搜索键时，需要根据搜索内容定义$_SESSION['searchProduct']
    if(isset($_POST['searchSubmit'])){
        $_SESSION['searchProduct'] = $_POST['searchProduct'];
    }
    
    // 当没有设定过$_SESSION['products']时，或者插入新产品后，则展示所有产品。
    if(!isset($_SESSION['searchProduct'])|| isset($_POST['insertSubmit'])){
        $_SESSION['searchProduct'] = '';
    }

    $sql = 'SELECT * FROM products, brands, categories 
            WHERE products.Category = categories.CategoryID
            AND products.Brand = brands.BrandID
            AND ProductName LIKE :search
            ORDER BY products.ProductID';
    $m = $pdo->prepare($sql);
    $m->bindValue(':search', '%'.$_SESSION['searchProduct'].'%', PDO::PARAM_STR);
    $products = $db->exe($m);

    $sql = 'SELECT * FROM brands';
    $brands = $db->preExe($sql);

    $sql = 'SELECT * FROM categories';
    $categories = $db->preExe($sql);
    
    ob_start();
    include 'Templates/admin/authen-products.html.php';
    $output = ob_get_clean();
    include 'Templates/admin/authen-layout.html.php';

?>