<?php

/**
 * @var array $products
 * @var $totalSum
 * @var $errors
 */

use Eshop\src\Service\PageService;

?>

<div class="order-content">

	<form action="/createOrder" method="post">
		<div class="person-info">
			<h3>Контактная информация</h3>

			<label for="name">ФИО<span class="required-field"> *</span></label>
			<input type="text" required id="name" name="full-name">

			<label for="email">Email<span class="required-field"> *</span></label>
			<input type="email" required id="email" name="email">

			<label for="phone">Телефон<span class="required-field"> *</span></label>
			<input type="tel" required id="phone" name="phone" class="phone">


			<label for="comment">Комментарий</label>
			<textarea name="comment" id="comment" rows="5" cols="40"></textarea>

			<div class="alert"><?= $errors ?? '' ?></div>
		</div>

		<div class="order-info">
			<div class="order-info-content">
				<h3>Ваш заказ</h3>
				<?php foreach ($products as $id => $product): ?>
				<div class="product-title">
					<?=PageService::safe($product['artist']) . ' -'?>
					<?=PageService::safe($product['name'])?>
				</div>
				<div class="count-price">
					<div class="count"><?=$product['qty'] . ' шт.'?></div>

					<div class="price" id="#price"><?= ($product['price'] * $product['qty']) . ' руб'?></div>
				</div>
				<?php endforeach ?>
			</div>

			<div class="order-info-footer">
				<div class="total-price">
					<h4>Итого</h4>
					<span class="sum"><?= $totalSum . ' руб'?></span>
				</div>

				<input class="order-button" type="submit" value="Оформить заказ">
			</div>

		</div>
	</form>

</div>

<script src="/js/order_script.js"></script>

