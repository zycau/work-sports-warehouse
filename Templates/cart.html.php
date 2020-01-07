<?php if($_SESSION['topRight']==0): ?>
	<div id="noitem">
		<p>There is no item in your shopping cart, <a href="home.php">back to home.</a></p>
		<p><i class="fas fa-cart-plus"></i></p>
	</div>
	

<?php else: ?>	
	<div id="shopping-cart">
		<h2>Shopping Cart</h2>
	<?php foreach($_SESSION['cart']->getItems() as $v): ?>
		<!-- $_SESSION['cart']中的item来源于CartItem Class，在这里先利用id将每个item连接到$product上，$product是在cart.php中设置好的，来源于Product Class，这样就可以在这里用Product Class中的方法了 -->
		<?php $product->getProduct($v->getItemId()) ?>

		<div class='cart-item' id="qty<?= $product->getProductId() ?>">
			<div class='item-pic'><a href="product.php?id=<?= $product->getProductId() ?>"><img src="images/products/<?= $product->getPic() ?>" alt="<?= $product->getProductName() ?> picture" height='120'></a></div>
			<div class="item-content">
				<p><a href="product.php?id=<?= $product->getProductId() ?>"><?= $product->getProductName() ?></a></p>
				<p><span>Brand: <?= $product->getBrand() ?></span><span>Category: <?= $product->getCategory() ?></span></p>
				<p>$ <?= $product->getPrice() ?></p>
				<div>
					<!-- 当按了plus或者minus按钮后，利用id定位到这个商品。 -->
					<form action="cart.php#qty<?= $product->getProductId() ?>" method='post' >	
						<span>Quantity: </span>
						<!-- 以下hidden的input用于传递该商品的id -->
						<input type="hidden" name='itemId1' value="<?= $product->getProductId() ?>">	
						<button class='plus' type='submit' name='plus'><i class="fas fa-plus"></i></button>						
						<span><?= $v->getQuantity() ?></span>
						<button class='minus' type='submit' name='minus'><i class="fas fa-minus"></i></button>
					</form>

					<form action="cart.php" method='post'>
						<!-- 以下hidden的input用于传递该商品的id -->
						<input type="hidden" name='itemId2' value="<?= $product->getProductId() ?>">
						<input type='submit' name='removeItem' value="Remove" />						
					</form>					
				</div>
			</div>
		</div>
	<?php endforeach; ?>
		<div id="for-checkout">
			<p>$ <?= $_SESSION['cart']->calcTotal() ?></p>			
			<div>
				<form action="checkout.php" method='post'>
					<input type="submit" name='submitCheckout' value="Checkout!">
				</form>
			</div>
		</div>
	</div>

<?php endif; ?>


<!-- 
in: $_SESSION['topRight']
out: removeItem (itemId)
-->