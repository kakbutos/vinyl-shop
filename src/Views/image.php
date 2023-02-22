<?php
/**
 * @var array $imageList
 */
// echo '<pre>';
// print_r($imageList);
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/style.css">
</head>

<body>

<div class="products-list">
	<?php foreach ($imageList as $image):?>
		<a class="product-card">
			<div class="product-card-image-container">

				<img src="/assets/img/<?=$image->getPath() ?>/<?= $image->getName() ?>" alt="">
			</div>
			<div class="product-card-info">
				<div class="product-card-name-container">
					<?=$image->getName() ?>
				</div>
				<div class="product-card-artist-container">
					<?= $image->IsMain() ?>
				</div>
			</div>
		</a>
	<?php endforeach; ?>
</div>

</body>

</html>