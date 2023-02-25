<?php

/**
 * @var array $products
 *
 */
?>

<div class="order-content">

	<form action="/createOrder" method="post">
<!--		<input type="hidden" name="productId" value="--><?//= $product->getId() ?><!--">-->
<!--		<input type="hidden" name="productPrice" value="--><?//= $product->getPrice() ?><!--">-->
		<div class="person-info">
			<h3>Контактная информация</h3>

			<label for="name">ФИО<span class="required-field"> *</span></label>
			<input type="text" required id="name" name="fullname">

			<label for="email">Email<span class="required-field"> *</span></label>
			<input type="email" required id="email" name="email">

			<label for="phone">Телефон<span class="required-field"> *</span></label>
			<input type="tel" required id="phone" name="phone" class="phone">


			<label for="comment">Комментарий</label>
			<textarea name="comment" rows="5" cols="40"></textarea>
		</div>

		<div class="order-info">
			<div class="order-info-content">
				<h3>Ваш заказ</h3>
				<?php foreach ($products as $id => $product): ?>
				<div class="product-title">
					<?=$product['artist'] . ' -'?>
					<?=$product['name']?>
				</div>

				<div class="count-price">
					<div class="count">
						<?=$product['qty'] . ' шт.'?>
<!--						<button type="button" onclick="this.nextElementSibling.stepDown()" class="change-count-button">-</button>-->
<!--						<input type="number" min="0" max="99" value="1" readonly class="product-count" id="product-count" name="count">-->
<!--						<button type="button" onclick="this.previousElementSibling.stepUp()" class="change-count-button">+</button>-->
					</div>

					<div class="price" id="#price">
						<?= $product['price'] . ' руб'?>
					</div>
				</div>
				<?php endforeach ?>
			</div>

			<div class="order-info-footer">
				<div class="total-price">
					<h4>Итого</h4>
					<span class="summ"></span>
				</div>

				<input class="order-button" type="submit" value="Оформить заказ">
			</div>

		</div>
	</form>

</div>

<script src="/js/Order_Script.js"></script>

