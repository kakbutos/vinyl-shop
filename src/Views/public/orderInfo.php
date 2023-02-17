<?php
/**
 * @var Exception $errors
 */

use Eshop\src\Models\Order;

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

<?php if (isset($errors)): ?>
	<div class="alert danger">
		<?= $errors->getMessage() ?>
	</div>
<?php exit(); endif; ?>

<div class="thanks-for-order">

	<div class="logo-container1">
		<img src="/assets/icon/music-album.png" alt="/">
	</div>
	<h1 class="thanks">Спасибо за заказ!</h1>
	<div class="thanks-detail">
		<p>Ваш заказ номер <?php ?> на сумму <?php ?> рублей успешно оформлен.</p>
		<p>Мы свяжемся с вами в ближайшее время для уточнения деталей.</p>
	</div>
	<div class="to-main"><a href="/">Вернуться в магазин</a></div>

</div>

</body>

</html>