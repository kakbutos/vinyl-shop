<?php
use \Eshop\src\Service\PageService;
/**
 * @var Product $product
 * @var string $productTags
 *
 */
	$mainImagePath= '';
	$imageList = $product->getImageList();
	for ($i=0, $iMax = count($imageList); $i< $iMax; $i++){
		if ($imageList[$i]->IsMain()){
			$mainImagePath = $imageList[$i]->getPath();
			break;
		}
	}

?>
<div class="product-detail-container">
	<div class="product-detail-image-side">
		<div class="product-detail-main-image-container">
			<img src="/assets/img/<?=$mainImagePath?>" alt="">
		</div>
		<div class="product-detail-galery-container">
			<?php foreach ($imageList as $image):?>
				<img src="/assets/img/<?=$image->getPath()?>" alt="">
			<?php endforeach; ?>
		</div>
	</div>
		<div class="product-detail-info-side">
			<div class="product-detail-name-container">
				<?=$product->getName()?>
			</div>
			<div class="product-detail-line-property-container">
				<div class="product-detail-line-property-name">
					Исполнитель:
				</div>
				<div class="product-detail-line-property">
					<?=$product->getArtist()?>
				</div>
			</div>
			<div class="product-detail-line-property-container">
				<div class="product-detail-line-property-name">
					Жанры:
				</div>
				<div class="product-detail-line-property">
					<?=$productTags ?>
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

					<?=$product->getVinylStatus()?><p class="vinyl-info">(?)</p>
				</div>
			</div>

			<div class="product-detail-line-property-container">
				<div class="product-detail-line-property-name">
					Качество конверта:
				</div>
				<div class="product-detail-line-property">
					<?=$product->getCoverStatus()?>
				</div>
			</div>

			<div class="product-detail-line-property-container">
				<div class="product-detail-line-property-name">
					Композиции:
				</div>
			</div>

			<?php $tracks = PageService::formatTrackForDetailPage($product->getTracks())  ?>
			<div class="product-detail-line-property-container">
				<div class="product-detail-line-property-tracks-list">
					<?php foreach ($tracks[0] as $item): ?>
						<div class="product-detail-line-property-tracks">
							<?=$item?>
						</div>
					<?php endforeach;?>
				</div>

				<div class="product-detail-line-property-tracks-list">
					<?php foreach ($tracks[1] as $item): ?>
						<div class="product-detail-line-property-tracks">
							<?=$item?>
						</div>
					<?php endforeach;?>
				</div>
			</div>

			<div class="product-detail-buy-container">
				<div class="product-detail-buy-price">
					<?=$product->getPrice()?>
				</div>
				<a href="/order/<?=$product->getId()?>/" class="buy-button"> Купить </a>
			</div>
	</div>
</div>