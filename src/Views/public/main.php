<?php
/**
 * @var array $items
 * @var array $images
 */
$path = '';

?>

<div class="products-list">
	<?php foreach ($items as $item):?>
	<a class="product-card" href="">
		<div class="product-card-image-container">
			<?php foreach ($images as $image)
			{
				if ($image->getProductId() === $item->getId()){$path = $image->getPath();}
			} ?>
			<img src="/assets/img/<?=$path?>" alt="">
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