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
	<title>4Vinil</title>
	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/style.css">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
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