<?php
/**
 * @var string $quantity
 */
?>

<div class="header">
	<div class="logo-container">
		<a href="/" class="logo-link">
			<img src="/assets/icon/vinil.png" alt="/">
			<span>4Vinil</span>
		</a>
	</div>
	<div class="search-container">
		<form action="/find" class="search-form" >
			<input type="text" name="search-string" class="search-input" placeholder="найти">
		</form>
	</div>
	<div class="additional-header-container">
		<a href="/cart" class="cart-button">
			<span class="products-quantity" id="quantity"><?= $quantity ?></span>
			<img src="/assets/icon/carts.png" alt="" >
		</a>

	</div>
</div>

<script src="/js/cart_script.js"></script>