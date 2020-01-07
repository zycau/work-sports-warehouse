    <div id='slide-show'>
        <div class="bxslider">
            <div class='single-slide'>
                <img src="images/slide-image-1.png" alt="View our brand new range of Sports balls" class='slide-pic' width='850' height='300'>                
                <div class='slide-text'>
                    <p>View our brand new range of <span>Sports balls</span></p>
                    <p><a href="search.php?category=5">Shop now</a></p>
                </div>
            </div>
            <div class='single-slide'>
                <img src="images/slide-image-2.png" alt="Get protected with the new range of protective helmets" class='slide-pic' width='850' height='300'>               
                <div class='slide-text'>
                    <p>Get protected with the new range of <span>Protective helmets</span></p>
                    <p><a href="search.php?category=2">Shop now</a></p>
                </div>
            </div>
            <div class='single-slide'>
                <img src="images/slide-image-3.png" alt="Get ready to race with our professional training gear" class='slide-pic' width='850' height='300'>                
                <div class='slide-text'>
                    <p>Get ready to race with our professional <span>Training gear</span></p>
                    <p><a href="search.php?category=7">Shop now</a></p>
                </div>
            </div>
        </div>        
    </div>
    <section id='products'>
        <h2>Featured products</h2>
        <div id='products-area'>
            <?php foreach ($P as $v): ?>
            <a href="product.php?id=<?= $v['ProductID'] ?>" class='item'>
                <div><img src="images/products/<?= $v['Photo'] ?>" alt="<?= $v['ProductName'] ?> picture" width='140' height='140'></div>
                <div class='item-text'>
                <?php if($v['SalePrice'] != $v['Price']){ ?>
                    <p><em><?= $v['SalePrice'] ?></em></p>
                    <p>was <span><?= $v['Price'] ?></span></p>
                    <p><?= $v['ProductName'] ?></p>
                <?php }else{ ?>
                    <p><?= $v['SalePrice'] ?></p>
                    <p></p>
                    <p><?= $v['ProductName'] ?></p>
                <?php } ?>
                </div>                
            </a>
            <?php endforeach; ?>            
        </div>
    </section>
    <section id='brands'>
        <h2>Our brands and partnerships</h2>
        <div id='brands-text'>
            <p>These are some of our top brands and partnerships</p>
            <p>The best of the best is here.</p>    
        </div>            
        <div id='brands-back'>
            <div id='brands-logo'>
                <a href="search.php?brand=1"><img src="images/logo_nike.png" alt="Nike Logo" width='70' height='24'></a>
                <a href="search.php?brand=2"><img src="images/logo_adidas.png" alt="Adidas Logo" width='70' height='46'></a>
                <a href="search.php?brand=3"><img src="images/logo_skins.png" alt="Skins Logo" width='70' height='16'></a>
                <a href="search.php?brand=4"><img src="images/logo_asics.png" alt="Asics Logo" width='70' height='23'></a>
                <a href="search.php?brand=5"><img src="images/logo_newbalance.png" alt="Newbalance Logo" width='70' height='37'></a>
                <a href="search.php?brand=6"><img src="images/logo_wilson.png" alt="Wilson Logo" width='70' height='16'></a>
            </div>            
        </div>
    </section>

    <!-- bxSlider slide show plugin-->
    <!-- The code has been modified a little bit to fix the errors in console, so I did't use the 'min' type -->
    <script src="js/bxslider/dist/jquery.bxslider.js"></script>

    <!-- slide show using bxSlider -->
    <script src="js/slideShow.js"></script>