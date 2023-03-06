<?php

use Eshop\src\Models\Product;
use \Eshop\src\Service\PageService;
/**
 * @var Product $product
 * @var string $productTags
 *
 */
	$mainImagePath= '';
	$mainImageName= '';
	$imageList = $product->getImageList();
	for ($i=0, $iMax = count($imageList); $i< $iMax; $i++){
		if ($imageList[$i]->IsMain()){
			$mainImagePath = $imageList[$i]->getPath();
			$mainImageName = $imageList[$i]->getName();
			break;
		}
	}

?>

<div id="modal" class="modal">
	<div class="modal-content">
		<span class="close">&times;</span>
		<p>Товар успешно добавлен в корзину</p>
	</div>
</div>

<div class="product-detail-container">
	<div class="product-detail-image-side">
		<div class="product-detail-main-image-container">
			<img src="/assets/img/<?=$mainImagePath?>/<?=$mainImageName?>" alt="">
		</div>
		<div class="product-detail-galery-container">
			<?php foreach ($imageList as $image):?>
				<img src="/assets/img/<?=$image->getPath()?>/<?=$image->getName()?>" alt="">
			<?php endforeach; ?>
		</div>
	</div>
		<div class="product-detail-info-side">
			<div class="product-detail-name-container">
				<?=PageService::safe($product->getName())?>
			</div>
			<div class="product-detail-line-property-container">
				<div class="product-detail-line-property-name">
					Исполнитель:
				</div>
				<div class="product-detail-line-property">
					<?=PageService::safe($product->getArtist())?>
				</div>
			</div>
			<div class="product-detail-line-property-container">
				<div class="product-detail-line-property-name">
					Жанры:
				</div>
				<div class="product-detail-line-property">
					<?=PageService::safe($productTags)?>
				</div>
			</div>
			<div class="product-detail-line-property-container">
				<div class="product-detail-line-property-name">
					Год издания:
				</div>
				<div class="product-detail-line-property">
					<?=$product->getReleaseDate()?>
				</div>
			</div>

			<div class="product-detail-line-property-container">
				<div class="product-detail-line-property-name">
					Качество винила:
				</div>
				<div class="product-detail-line-property-vinyl"
					 data-vinyl="<?=$product->getVinylStatusName()?> (<?=$product->getVinylStatus()?>): <?=$product->getVinylStatusDesk()?>">

					<?=PageService::safe($product->getVinylStatus())?><p class="vinyl-info">(?)</p>
				</div>
			</div>

			<div class="product-detail-line-property-container">
				<div class="product-detail-line-property-name">
					Качество конверта:
				</div>
				<div class="product-detail-line-property">
					<?=PageService::safe($product->getCoverStatus())?>
				</div>
			</div>

			<div class="product-detail-line-property-container">
				<div class="product-detail-line-property-name">
					Композиции:
				</div>
			</div>

			<?php $tracks = PageService::formatTrackForDetailPage($product->getTracks())  ?>
			<div class="product-detail-line-property-container">
				<?php if (count($tracks) <= 1): ?>
					<div class="product-detail-line-property-tracks-list">
							<div class="product-detail-line-property-tracks">
								<?=PageService::safe($tracks[0])?>
							</div>
					</div>
				<?php else: ?>
				<div class="product-detail-line-property-tracks-list">
					<?php foreach ($tracks[0] as $item): ?>
						<div class="product-detail-line-property-tracks">
							<?=PageService::safe($item)?>
						</div>
					<?php endforeach;?>
				</div>

				<div class="product-detail-line-property-tracks-list">
					<?php foreach ($tracks[1] as $item): ?>
						<div class="product-detail-line-property-tracks">
							<?=PageService::safe($item)?>
						</div>
					<?php endforeach;?>
				</div>
				<?php endif; ?>
			</div>


			<div class="product-detail-buy-container">
				<div class="product-detail-buy-price">
					<?=$product->getPrice()?>
				</div>
				<a href="/cart/add" class="buy-button" data-id="<?=$product->getId()?>"> Купить </a>
			</div>
	</div>
</div>

<script src="/js/cart_script.js"></script>