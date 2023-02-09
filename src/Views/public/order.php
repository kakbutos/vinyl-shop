<?php
/**
 * @var string $header
 * @var Product $product
 * @var array $orders
 */
use Eshop\src\Models\Product;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="centrator">
	<div class="container">

			<?= $header ?>

			<div class="order-content">

				<form action="/order" method="post">
					<div class="person-info">
						<h3>Контактная информация</h3>

						<label for="name">ФИО</label>
						<input type="text" id="name" name="fullname">

						<label for="email">Email</label>
						<input type="text" id="email" name="email">

						<label for="phone">Телефон</label>
						<input type="text" id="phone" name="phone">

						<label for="comment">Комментарий</label>
						<textarea name="comment" rows="5" cols="40"></textarea>
					</div>

					<div class="order-info">
						<div class="order-info-content">
							<h3>Ваш заказ</h3>
							<div class="product-title">
								<?=$product->getArtist() . ' -'?>
								<?=$product->getName()?>
							</div>

							<div class="count-price">
								<div class="count">
									<button type="button" onclick="this.nextElementSibling.stepDown()">-</button>
									<input type="number" min="0" max="99" value="1" readonly class="product-count">
									<button type="button" onclick="this.previousElementSibling.stepUp()">+</button>
								</div>

								<div class="price">
									<?= $product->getPrice() . ' руб'?>
								</div>
							</div>
						</div>

						<div class="order-info-footer">
							<div class="total-price">
								<h4>Итого</h4>
								<?= $product->getPrice() . ' руб' ?>
							</div>

							<input class="order-button" type="submit" value="Оформить заказ">
						</div>

					</div>
				</form>

			</div>
	</div>
</div>

</body>
</html>
