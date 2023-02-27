<?php
	use Eshop\src\Lib\AuthHelper;
	$helper = AuthHelper::generateFormCsrfToken();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="/css/reset.css">
	<link rel="stylesheet" href="/css/login.css">
</head>
<body>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

<div class="container-form">
	<form class="form" action="/login" method="post">
		<div class="wrap-input">
			<input class="input-form" required="required" type="text" name="email" placeholder="Login">
			<span class="focus-input"></span>
		</div>
		<div class="wrap-input">
			<input class="input-form" required="required" type="password" name="password" placeholder="Password">
			<span class="focus-input"></span>
		</div>
		<input style="display: none" type="hidden" id="csrf_token" name="csrf_token" value="<?=$helper?>">

		<div class="btn-wrap-form">
			<div class="btn-bg"></div>
			<button class="btn-form" type="submit">Войти</button>
		</div>
	</form>
</div>

<script src="/js/login_order.js"></script>
</body>
</html>