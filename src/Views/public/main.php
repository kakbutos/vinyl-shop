<?php
/**
 * @var array $items
 * @var array $images
 * @var string $pagination
 */

use Eshop\src\Service\PageService;

$path = '';
?>

<div class="products-list">
	<?php foreach ($items as $item):?>
	<a class="product-card" href="/product/<?=$item->getId() ?>/">
		<div class="product-card-image-container">

			<img src="/assets/img/<?=$item->getImageList()[0]->getPath() ?>/<?=$item->getImageList()[0]->getName() ?>" alt="">
		</div>
		<div class="product-card-info">
			<div class="product-card-name-container">
				<?=PageService::safe($item->getName())?>
			</div>
			<div class="product-card-artist-container">
				<?=PageService::safe($item->getArtist())?> (<?=$item->getReleaseDate() ?>)
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