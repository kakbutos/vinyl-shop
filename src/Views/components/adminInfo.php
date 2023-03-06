<?php
/**
 * @var string $info
 */

?>
<?php if ($info !== ''): ?>
<div class="submit-modal-image">
	<div class="submit-modal-dialog">
		<div class="submit-modal-content">
			<div class="submit-modal-header">
				<a href="#" title="Close" class="cancel-button">×</a>
			</div>
			<div class="submit-modal-body-image">
				<div class="submit-modal-body-text">
					<?php if ($info === 'addOk'): ?>
					Изображение успешно добавлено!
					<?php elseif ($info === 'updateOrderOk'): ?>
						Продукт успешно изменён в заказе!
					<?php elseif ($info === 'deleteOk'): ?>
					Изображение успешно удалено!
					<?php elseif ($info === 'deleteOrderOk'): ?>
						Продукт успешно удалён!
					<?php elseif ($info === 'isMainOk'): ?>
						Основное изображение изменено!
					<?php elseif ($info === 'addError'): ?>
						Ошибка при добавлении изображения!
						<script> var err = true; </script>
					<?php elseif ($info === 'deleteError'): ?>
						Ошибка при добавлении изображения!
						<script> var err = true; </script>
					<?php elseif ($info === 'updateOrderError'): ?>
						Ошибка при изменении заказа!
						<script> var err = true; </script>
					<?php elseif ($info === 'deleteOrderError'): ?>
						Ошибка при удалении продукта из заказа!
						<script> var err = true; </script>
					<?php elseif ($info === 'isMainError'): ?>
						Ошибка при изменении основного изображения!
						<script> var err = true; </script>
					<?php endif; ?>
				</div>
				<button class="btn cancel-button submit-button image-button-info" style="margin-right: 10px">ок</button>
			</div>
		</div>
	</div>
</div>
<script> if (err) $('.submit-modal-image').addClass('modal-error-info'); </script>
<?php endif; ?>

