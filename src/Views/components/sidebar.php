<?php
/**
 * @var array $tags
 */
?>

<div class="side-bar">
	<?php foreach ($tags as $tag):?>
		<a href="" class="category-button">
			<?= $tag->getTitle() ?>
		</a>
	<?php endforeach;?>
</div>