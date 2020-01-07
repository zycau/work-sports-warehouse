<?php
    
    define('title', 'Products');

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

    function test($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

    // 初始查询语句
    $sql0 = 'SELECT * FROM
            `products`,`categories`,`brands`
            WHERE `products`.Category = `categories`.CategoryID
            AND `products`.Brand = `brands`.BrandID ';
    
    //共有三大来源：1.search/category/brand三选一。2.sort表格提交后的命令。3.选择页码命令。
    
    //如果选所有商品，然后选最后一页，然后选一个类别，提交。这时如果再点后退，会出现空页面。问题在于：退后时那个类别也是被勾选了的，所以得到的结果还是那个类别的商品（只有一页），不过页码是所有商品的最后一页（第三页），所以是空页面。
    

    // 第二或第三大来源时
    if(isset($_GET['sortSubmit']) || isset($_GET['page'])){
        // 当传来的$_GET['sort']值在数组$sortIn中时，从$sortOut选择相应的查询语句组件。对于$_GET['itemNumber']更简单，但同理。
        $sortIn = ['N','ND','P','PD'];
        $sortOut =  ['ProductName','ProductName DESC','SalePrice','SalePrice DESC'];
        $itemNumberInOut = ['10','20'];        
        
        // 首先考虑在哪些category的checkbox里打了勾。
        $temp = '';
        for($i=1;$i<=(int)$C[count($C)-1]['CategoryID'];$i++){
            if(isset($_GET["category$i"])){
                $temp .= $i.',';
            }
        }
        $temp = rtrim($temp,',');
        
        if(strlen($temp)>0){
            $_SESSION['categoryCheck'] = ' AND CategoryID IN ('.$temp.')';
        }
        
        //考虑按照什么来排序
        if(isset($_GET['sort']) && $_GET['sort']!='0'){
            // 当传来的$_GET['sort']值在数组$sortIn中时，从$sortOut选择相应的查询语句组件。
            if(in_array($_GET['sort'], $sortIn)){
                $_SESSION['sortSelect'] = $_GET['sort'];//用于判断下拉框选择哪个选项。
                $_SESSION['sort'] = $sortOut[array_search($_GET['sort'], $sortIn)];
                $_SESSION['orderBy'] = ' ORDER BY '.$_SESSION['sort'];    
            }
            
        }
        
        //考虑每页显示的数量，这里只有当$_SESSION['itemNumber']没被设定过的时候，才等于10。
        //如果需要更改排序条件后仍停留在原来的页码，把下面的$_SESSION['limit']更换为后面一段中的$_SESSION['limit']，然后删去$_SESSION['page'] = 1
        if(isset($_GET['itemNumber']) && in_array($_GET['itemNumber'], $itemNumberInOut)){
            $_SESSION['itemNumber'] = $_GET['itemNumber'];
            $_SESSION['limit'] = ' LIMIT '.$_SESSION['itemNumber'];
        } 
        
        // 表明更改上述条件后，页码重新从1开始计数。当然如果需要更改排序条件后仍停留在原来的页码，按照上述条件操作。
        $_SESSION['page'] = 1;
        
        //考虑从第几页开始
        if(isset($_GET['page']) && is_numeric($_GET['page'])){
            $_SESSION['page'] = $_GET['page'];
            $_SESSION['limit'] = ' LIMIT '.($_SESSION['page']-1)*$_SESSION['itemNumber'].','.$_SESSION['itemNumber'];
        }

        // $_SESSION['limit'] = ' LIMIT '.($_SESSION['page']-1)*$_SESSION['itemNumber'].','.$_SESSION['itemNumber'];
        
    }else{ //若不是从第二、三大来源，则这些参数初始化
        $_SESSION['categoryCheck'] = '';
        $_SESSION['orderBy'] = '';
        $_SESSION['sort'] = '';
        $_SESSION['sortSelect'] = '';
        $_SESSION['itemNumber'] = 10;
        $_SESSION['page'] = 1;
        $_SESSION['limit'] = ' LIMIT '.$_SESSION['itemNumber']; 
    }
    
    
    // 第一大来源时,is_numeric()用于判断传来的是否是纯数字，防止注入攻击。
    if(isset($_GET['search'])){
        $_SESSION['sql'] = $sql0.' AND ProductName LIKE :search';
        $_SESSION['search'] = test($_GET['search']);
    }elseif(isset($_GET['category']) && is_numeric($_GET['category'])){
        $_SESSION['sql'] = $sql0.' AND `categories`.CategoryID = "'.test($_GET['category']).'"';
    }elseif(isset($_GET['brand']) && is_numeric($_GET['brand'])){
        $_SESSION['sql'] = $sql0.' AND `brands`.BrandID = "'.test($_GET['brand']).'"';
    }
    
    $sql = $_SESSION['sql'].$_SESSION['categoryCheck'].$_SESSION['orderBy'].$_SESSION['limit'];
    $sqlC = $_SESSION['sql'].$_SESSION['categoryCheck'];
    
    // echo $sql.'!!!!!!!!!!!!!';
    // echo $_SESSION['categoryCheck'].'????????';
    // echo $_SESSION['itemNumber'].'!!!!!!!!!!!!!';
    // echo $_SESSION['orderBy'].'!!!!!!!!!!!!!';
    // echo $_SESSION['limit'].'!!!!!!!!!!!!!';
    
    // 执行语句，代C的是为了计算所有结果的个数。
    $m = $pdo->prepare($sql);
    $mC = $pdo->prepare($sqlC);
    if(isset($_SESSION['search'])){
        $m->bindValue(':search','%'.$_SESSION['search'].'%', PDO::PARAM_STR);
        $mC->bindValue(':search','%'.$_SESSION['search'].'%', PDO::PARAM_STR);
    }
    $P = $db->exe($m);
    $PC = $db->exe($mC);
    $_SESSION['count'] = count($PC);

    // 开始：以下语句用于检测如果出现back回退问题时，重新定义$sql和$sqlC并查询，但还是有bug，如果先选6个种类确定后，再到第二页，再选一个种类，确定后按back，会回到初始查询结果。其实以下这些可以不要，因为在苹果safari浏览器中，不会有回退问题出现！
    $_SESSION['back'] = count($P);
    if($_SESSION['count']>0 && $_SESSION['back']==0){        
        $sql = $_SESSION['sql'].$_SESSION['orderBy'].$_SESSION['limit'];
        $sqlC = $_SESSION['sql'];
        $m = $pdo->prepare($sql);
        $mC = $pdo->prepare($sqlC);
        if(isset($_SESSION['search'])){
            $m->bindValue(':search','%'.$_SESSION['search'].'%', PDO::PARAM_STR);
            $mC->bindValue(':search','%'.$_SESSION['search'].'%', PDO::PARAM_STR);
        }
        $P = $db->exe($m);
        $PC = $db->exe($mC);
        $_SESSION['count'] = count($PC);
    }
    // 终止
    
    
    // 定义显示文字的变量
    if(isset($_GET['search'])){        
        $_SESSION['condition'] = $_GET['search'];
        if(strlen($_GET['search'])==0){
            $_SESSION['condition'] = 'all products';
        }
    }elseif(isset($_GET['category'])){        
        // $_SESSION['condition'] = $db->singleValue($m,10);
        $sql = 'SELECT CategoryName FROM categories WHERE CategoryID = :id';
        $m = $pdo->prepare($sql);
        $m->bindValue(':id', $_GET['category'], PDO::PARAM_STR);        
        $_SESSION['condition'] = $db->singleValue($m);
    }elseif(isset($_GET['brand'])){        
        // $_SESSION['condition'] = $db->singleValue($m,12);
        $sql = 'SELECT BrandName FROM brands WHERE BrandID = :id';
        $m = $pdo->prepare($sql);
        $m->bindValue(':id', $_GET['brand'], PDO::PARAM_STR);        
        $_SESSION['condition'] = $db->singleValue($m);        
    }
    
    $searchTitle = 'Results of '.$_SESSION['condition'];
    
    // $message的三种情况
    if($_SESSION['count']==0){
        $message = 'There is no result of '.$_SESSION['condition'];        
    }elseif($_SESSION['count']==1){
        $message = $_SESSION['count'].' product found';
    }else{
        $message = $_SESSION['count'].' products found';
    }  
    
    ob_start();
    include 'Templates/searchResult.html.php';
    $output = ob_get_clean();
    include 'Templates/Layout.html.php';

?>