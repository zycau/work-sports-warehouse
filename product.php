<?php
    define('title', 'Product');

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

    $added = '';

    // 将传过来的id存在session中，这样添加购物车后可以还保留在原来的页面。
    if(isset($_GET['id'])){
        $_SESSION['productId'] = $_GET['id'];
    }

    // 展示商品信息
    if(isset($_SESSION['productId'])){
        $sql = 'SELECT * FROM `products`,`categories`,`brands`
                WHERE `products`.Category = `categories`.CategoryID
                AND `products`.Brand = `brands`.BrandID
                AND `products`.ProductID = :id';
        $m = $pdo->prepare($sql);
        $m->bindValue(':id', $_SESSION['productId'], PDO::PARAM_INT);
        $P = $db->exe($m);
    }


    // 点击添加购物车按钮
    if(isset($_POST['addToCart'])){        
        // 点击添加购物车按钮后，先做id和number的判断。
        if($_POST['productId']>0 && $_POST['productQty']>0 && $_POST['productQty']<=100){
            // 如果没有购物车的session变量，则创建一个。
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart'] = new ShoppingCart();
            }

            // 创建一个新的Product object，并获取该product信息。
            $product = new Product();
            $product->getProduct($_POST['productId']);

            // 创建一个新的CartItem object，并将该产品信息填入。
            $item = new CartItem($_POST['productId'], $product->getProductName(), $product->getPrice(), $_POST['productQty'], $product->getPic());

            // 将新的item加入购物车。
            $_SESSION['cart']->addItem($item);

            // 定义文字变量，以及右上角显示的数量。
            $added = 'Item has been added to the cart!';
            $_SESSION['topRight'] = $_SESSION['cart']->calcQty();

            // 此时若刷新，会再次添加购物车！！

        }        

    }

    ob_start();
    include 'Templates/product.html.php';
    $output = ob_get_clean();
    include 'Templates/Layout.html.php'

?>