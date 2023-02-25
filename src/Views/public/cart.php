<?php
/**
 * @var array $products
 */
?>

<div class="cart">
	<div class="cart-name">Корзина</div>
	<form class="checkout" id="checkout" method="post" action="/checkout">
		<div class="cart-content">
			<div class="cart-products-list">
				<?php foreach ($products as $id => $product): ?>
					<div class="cart-product-item">
						<div class="cart-product-item-content">

							<a class="cart-product-image" href="/product/<?= $id ?>/">
								<div class="cart-product-image-container">
									<img src="/assets/img/<?= $product['imgPath'] ?>/<?= $product['imgName'] ?>" alt="">
								</div>
							</a>

							<div class="cart-product-info">
								<div class="cart-product-title">
									<div class="cart-product-name"><?= $product['name'] ?></div>
									<div class="cart-product-artist"><?= $product['artist'] ?></div>
								</div>
								<a href="/cart/delete/<?= $id ?>/" class="delete-product-button"> Удалить </a>

							</div>

							<div class="cart-price" id="price<?= $id ?>">
								<?= $product['price'] . ' руб' ?>
							</div>

							<div class="cart-product-quantity">
								<div class="count">
									<button type="button" onclick="this.nextElementSibling.stepDown()" class="decr-count-button" id="<?= $id ?>">-</button>
									<input type="number" min="1" max="99" value="<?= $product['qty'] ?>" readonly class="product-count" id="product-count<?= $id ?>" name="count">
									<button type="button" onclick="this.previousElementSibling.stepUp()" class="incr-count-button" id="<?= $id ?>">+</button>
								</div>
							</div>

							<div class="cart-total-price">
								<span class="sum" id="sum<?= $id ?>"><?= $product['qty'] * $product['price'] . ' руб' ?></span>
							</div>

						</div>
					</div>
				<?php endforeach; ?>
			</div>
	</form>
</div>
<input class="order-button" type="submit" form="checkout" value="Оформить заказ">
<!--</div>-->

<script src="/js/cart_script.js"></script>