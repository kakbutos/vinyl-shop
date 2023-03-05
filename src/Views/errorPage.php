<?php
/**
 * @var int $responseCode
 */
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/admin_style.css">
	<title>Ошибка</title>
</head>
<body>

	<div class="error-page">
		<?php if($responseCode === 500): ?>
			<img class="error-image" src="/assets/icon/code500.png" alt="/">
			<div class="error-page-info">
				Упс, что-то пошло не так
			</div>
		<?php elseif ($responseCode === 404): ?>
		<img class="error-image" src="/assets/icon/code404.webp" alt="/">
		<div class="error-page-info">
			Страница не найдена
		</div>
		<?php endif; ?>
		<a class="image-button" href="/">Вернуться на главную</a>
	</div>

</body>
</html>