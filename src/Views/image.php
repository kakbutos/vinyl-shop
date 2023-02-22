<?php
/**
 * @var string $images
 */
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/admin_style.css">
</head>

<body>

<div class="products-list">
	<?php foreach ($images as $image):?>
		<a class="product-card" href="/product/<?=$image->getId() ?>/">
			<div class="product-card-image-container">

				<img src="/assets/img/<?=$image->getImageList()[0]->getPath() ?>" alt="">
			</div>
			<div class="product-card-info">
				<div class="product-card-name-container">
					<?=$image->getName() ?>
				</div>
				<div class="product-card-artist-container">
					<?=$image->getArtist() ?> (<?=$image->getReleaseDate() ?>)
				</div>
				<div class="product-card-price-container">
					<?=$image->getPrice() ?>
				</div>
			</div>
		</a>
	<?php endforeach; ?>
</div>

</body>

</html>