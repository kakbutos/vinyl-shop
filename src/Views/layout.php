<?php
/**
 * @var string $header
 * @var string $sidebar
 * @var string $pagination
 * @var string $content
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="centrator">
	<div class="container">
		<div class="layout">
			<?=$header?>

			<?=$sidebar?>

			<div class="content">
				<?=$content?>
			</div>
		</div>
	</div>
</div>

</body>
</html>