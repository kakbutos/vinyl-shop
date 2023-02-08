<?php
/**
 * @var array $items
 * @var array $images
 * @var string $pagination
 */
$path = '';

?>

<div class="products-list">
	<?php foreach ($items as $item):?>
	<a class="product-card" href="/product/<?=$item->getId() ?>/">
		<div class="product-card-image-container">

			<img src="/assets/img/<?=$item->getImageList()[0]->getPath() ?>" alt="">
		</div>
		<div class="product-card-info">
			<div class="product-card-name-container">
				<?=$item->getName() ?>
			</div>
			<div class="product-card-artist-container">
				<?=$item->getArtist() ?> (<?=$item->getReleaseDate() ?>)
			</div>
			<div class="product-card-price-container">
				<?=$item->getPrice() ?>
			</div>
		</div>
	</a>
	<?php endforeach; ?>
</div>
<div class="centrator">
	<?=$pagination?>
</div>