<?php
    $navArr = [['home.php','Home'],['#','About SW'],['contact.php','Contact Us'],['search.php?search','View Products']];    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= title ?></title>

    <!-- the bxSlider css file -->
    <link rel="stylesheet" href="js/bxslider/dist/jquery.bxslider.min.css">
    <!-- the font awesome css file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.css">
    <!-- the Open+Sans font from googlefonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,700,700i&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="CSS/normalize.min.css">
    <link rel="stylesheet" href="CSS/style.css">    
</head>
<body class='no-js'>
<header>
    <div id='header-top'> 
        <div>
            <div id='menu-icon' class=''>                           
                <p><i class="fas fa-bars"></i> Menu</p>            
            </div>            
            <nav id='d-top-nav'>
                <ul>
                <?php foreach($navArr as $v): ?>
                    <li><a href="<?= $v['0'] ?>"><?= $v['1'] ?></a></li>
                <?php endforeach; ?>
                </ul>                
            </nav>
            <div id='cart'>
                <a href="login.php" id='d-login'><i class="fas fa-lock"></i> Login</a>
                <a href="cart.php">                
                    <i class="fas fa-shopping-cart"></i>View Cart<div><?= $_SESSION['topRight'] ?> items</div>                  
                </a>            
            </div>            
        </div>
    </div>
    <nav id='m-top-nav' class='m-nav' aria-hidden='true'>
        <ul>
            <li><a href="login.php"><i class="fas fa-lock"></i> Login</a></li>
        <?php foreach($navArr as $v): ?>
            <li><a href="<?= $v['0'] ?>"><i class="far fa-circle"></i> <?= $v['1'] ?></a></li>           
        <?php endforeach; ?>
        </ul>
    </nav>
    <div id='header-mid'>       
        <h1><img src="images/d-logo.png" alt="Sports Warehouse Logo" width='300' height='42'></h1>
        <!-- <h1><object data='images/logo.svg' type="image/svg+xml" width='300' height='42'></object></h1> -->        
        <form action="search.php" method='get'>
            <label for="search-bar">search bar</label>
            <input type="text" name='search' id='search-bar' placeholder='Search products'>
            <button type='submit' aria-label='search-button'><i class="fas fa-search"></i></button> 
        </form>
    </div>
    <nav id='header-btm'>
        <ul>
        <?php for($i=0; $i<7; $i++): ?>
            <li><a href="search.php?category=<?= $C[$i]['CategoryID'] ?>"><span><?= $C[$i]['CategoryName'] ?></span></a></li>            
        <?php endfor; ?>
        <?php if(count($C)==8): ?>
            <li><a href="search.php?category=<?= $C[7]['CategoryID'] ?>"><span><?= $C[7]['CategoryName'] ?></span></a></li> 
        <?php elseif(count($C)>8): ?>
            <li>
                <form action="search.php" method='get' id='more-category'>
                    <!-- <label for="more">More:</label> -->
                    <select name="category" id='more' onchange='submit()'>
                        <option>More</option>
                    <?php for($i=7; $i<count($C); $i++): ?>
                        <option value="<?= $C[$i]['CategoryID'] ?>"><?= $C[$i]['CategoryName'] ?></option>
                    <?php endfor; ?>
                    </select>
                </form>
                <script>let submit = ()=>{document.getElementById('more-category').submit()};</script>
            </li>
        <?php endif; ?>
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
    <div>
        <nav id='footer-nav' aria-hidden='true'>
            <p>Site navigation</p>    
            <ul>
            <?php foreach($navArr as $v): ?>
                <li><a href="<?= $v['0'] ?>"><?= $v['1'] ?></a></li>
            <?php endforeach; ?>                
                <li><a href="privacy.php">Privacy Policy</a></li>
            </ul>
        </nav>
        <nav id='footer-cat' aria-hidden='true'>
            <p>Product categories</p>
            <ul>
            <?php for($i=0; $i<7; $i++): ?>
                <li><a href="search.php?category=<?= $C[$i]['CategoryID'] ?>"><span><?= $C[$i]['CategoryName'] ?></span></a></li>
            <?php endfor; ?>                
            </ul>
        </nav>
        <div id='footer-contact'>
            <p>Contact Sports WareHouse</p>
            <div>
                <a href="#">
                    <div class='contact-way'><i class="fab fa-facebook-f"></i></div>
                    <p>Facebook</p>
                </a>
                <a href="#">
                    <div class='contact-way'><i class="fab fa-twitter"></i></div>
                    <p>Twitter</p>
                </a>
                <a href="#other-contact">
                    <div class='contact-way'><i class="fas fa-paper-plane"></i></div>
                    <p>Other</p>
                </a>
            </div>
            <div id='other-contact'>                    
                <ul>
                    <li><a href="contact.php">Online form</a></li>
                    <li><a href="mailto:Sports-warehouse@gmail.com" title="email">Email</a></li>
                    <li><a href="tel:+61432000000" title="phone">Phone</a></li>
                    <li><a href="https://www.google.com.au/maps/search/sports+warehouse">Address</a></li>
                </ul>
            </div>    
        </div>
    </div>    
    <div id='copyright'>
        <p><small>&copy; Copyright 2020 Sports Warehouse. </small></p>
        <p><small>All rights reserved. </small></p>
        <p><small>Website made by Yucheng Zhou.</small></p>
    </div>    
</footer>

<!-- top menu on cellphone -->
<script src="js/topMenu.js"></script>

</body>
</html>

<!-- 
in: title $output 
-->