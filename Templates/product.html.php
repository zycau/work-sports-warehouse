<?php
    if(count($P)==1):
    $p = $P[0];
?>
<div id='product'>
    <div id='product-wrap'>
        <div class='product-img'><img src="images/products/<?= $p['Photo'] ?>" alt="<?= $p['ProductName'] ?> picture" width='270' height='270'></div>
        <div class='product-detail'>
            <p><?= $p['ProductName'] ?></p>
        <?php if($p['SalePrice'] != $p['Price']){ ?>        
            <p><em>$<?= $p['SalePrice'] ?></em></p>
            <p>was <span>$<?= $p['Price'] ?></span></p>        
        <?php }else{ ?>        
            <p>$<?= $p['Price'] ?></p>
            <p></p>        
        <?php } ?>
            <p>Brand: <?= $p['BrandName'] ?></p>
            <p>Category: <?= $p['CategoryName'] ?></p>        
            <form action="product.php" method='post'>
                <input type="hidden" name='productId' value='<?= $p['ProductID'] ?>'>
                <label for="productNumber">Number: </label>
                <input type="number" min='1' max='100' id='productNumber' name='productQty' value='1' required>
                <input type="submit" name='addToCart' value='Add to cart'>
                <p><?= $added ?></p>
            </form>
            <p class='product-description'><?= $p['Description'] ?></p>
        </div>    
    </div>
    
    <?php endif; ?>
</div>


<!-- 
in: $P $added
out: addToCart (productId,productQty)
  -->