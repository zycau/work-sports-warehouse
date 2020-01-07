<?php
    $system = [['user',$_SESSION['username']],['categories','Products'],['administrator','Administrator']];    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SW Administration</title>
    
    <!-- the font awesome css file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <!-- the Open+Sans font from googlefonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,700,700i&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="CSS/normalize.min.css">
    <link rel="stylesheet" href="CSS/admin-style.css">
<body  class="<?= $_SESSION['userTheme'] ?>">
<header>
    <div id='header-top'> 
        <div>
            <p>SW Administration System</p>
            <div>
                <a href="logout.php" id='d-login'><i class="fas fa-lock"></i> Logout</a>                          
            </div>
        </div>
    </div>
    
    <div id='header-mid'>       
        <h1><img src="images/d-logo.png" alt="Sports Warehouse Logo" width='300' height='42'></h1>
        <!-- <h1><object data='images/logo.svg' type="image/svg+xml" width='300' height='42'></object></h1> -->        
    </div>

    <nav id='header-btm'>
        <ul>
        <?php foreach($system as $v): ?>
            <?php if($v[0]!=='administrator' || in_array($_SESSION['username'],$superAdmin)): ?>
            <li><a href="authen-<?= $v[0] ?>.php"><span><?= $v[1] ?></span></a></li>            
            <?php endif; ?>            
        <?php endforeach; ?>
        </ul>
    </nav>
</header>
<div id='wrap'>
    <!-- jQuery -->
    <script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>

    <?= $output ?>
</div>
<footer>      
    <div id='copyright'>
        <p><small>&copy; Copyright 2020 Sports Warehouse. </small></p>
        <p><small>All rights reserved. </small></p>
        <p><small>Website made by Awesomesauce Design.</small></p>
    </div>    
</footer>
    
    <script type="text/javascript" src='js/admin-delete.js'></script>

</body>
</html>

<!-- 
in: $output $superAdmin
-->