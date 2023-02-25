<?php
use Eshop\src\Service\PageService;
/**
 * @var array $imageList
 * @var int $productId
 * @var string $info
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
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<div class="container">
	<div class="content">

		<?=$info ?>

		<div class="image-header">
			<div class="image-title">Изменить изображения</div>
			<div class="image-add">
				 <form action="/admin/image/add/<?= $productId ?>/" method="POST" enctype="multipart/form-data">
					 <input type="file" name="file">
					 <input type="submit" value="Загрузить">
				 </form>
			</div>
		</div>
		<div class="image-list">
			<?php foreach ($imageList as $image):?>
				<div class="image-card">
					<div class="card-image-container">

						<img src="/assets/img/<?=$image->getPath() ?>/<?= $image->getName() ?>" alt="">
					</div>
					<div class="image-card-info">
						<div class="image-card-name-container">
							<?=PageService::truncate($image->getName(), 20)  ?>
						</div>
						<div class="image-isMain-container">
							<?php if( $image->IsMain() === true): ?>Основное изображение
							<?php else: ?>Дополнительное изображение
							<?php endif; ?>
						</div>
						<div class="image-action-container">
							<a href="/admin/image/isMain/<?= $image->getId() ?>/" class="image-button"> Сделать основным </a>
							<a href="/admin/image/delete/<?= $image->getId() ?>/" class="image-button"> Удалить </a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="button-move">
			<a href="/admin" class="image-button"> Вернуться на главную </a>
		</div>
	</div>
</div>

</body>

</html>