<?php
/**
 * @var string $info
 */

?>
<?php if ($info !== ''): ?>
<div class="submit-modal">
	<div class="submit-modal-dialog">
		<div class="submit-modal-content">
			<div class="submit-modal-header">
				<a href="#" title="Close" class="cancel-button">×</a>
			</div>
			<div class="submit-modal-body">
				<p>
					<?php if ($info === 'addOk'): ?>
					Изображение успешно добавлено!
					<?php elseif ($info === 'deleteOk'): ?>
					Изображение успешно удалено!
					<?php elseif ($info === 'isMainOk'): ?>
						Основное изображение изменено!
					<?php elseif ($info === 'addError'): ?>
						Ошибка при добавлении изображения!
					<?php elseif ($info === 'deleteError'): ?>
						Ошибка при добавлении изображения!
					<?php elseif ($info === 'isMainError'): ?>
						Ошибка при изменении основного изображения!
					<?php endif; ?>
				</p>
				<button class="btn cancel-button submit-button" style="margin-right: 10px">ок</button>
			</div>
		</div>
	</div>
</div>
<script>
	$('.cancel-button').on('click', function(){
		$('.submit-modal').remove();
	});
</script>
<?php endif; ?>
<?php if ($info === 'addOk'): ?>
	<div class="info-field info">
		Изображение успешно добавлено!
	</div>
<?php elseif ($info === 'deleteOk'): ?>
	<div class="info-field info">
		Изображение успешно удалено!
	</div>
<?php elseif ($info === 'isMainOk'): ?>
	<div class="info-field info">
		Основное изображение изменено!
	</div>
<?php elseif ($info === 'addError'): ?>
	<div class="info-field danger">
		Ошибка при добавлении изображения!
	</div>
<?php elseif ($info === 'deleteError'): ?>
	<div class="info-field danger">
		Ошибка при добавлении изображения!
	</div>
<?php elseif ($info === 'isMainError'): ?>
	<div class="info-field danger">
		Ошибка при изменении основного изображения!
	</div>
	<?php endif; ?>
