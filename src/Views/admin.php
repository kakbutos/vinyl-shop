<!DOCTYPE html>
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
	<div class="admin-navigation">
		<ul class="nav nav-tabs admin-nav">
			<li class="active"><a class="nav-button" href="#" data-table="product" data-toggle="tab">Товары</a></li>
			<li><a class="nav-button" href="#" data-table="order" data-toggle="tab">Заказы</a></li>
			<li><a class="nav-button" href="#" data-table="tag" data-toggle="tab">Теги</a></li>
			<li class="logout-btn btn"><a href="/logout">Выйти</a></li>
	</ul>
	</div>
	<div class="admin-table-container">

		<table class="admin-table">

			<tr class="table-tr table-header-td">

			</tr>



		</table>
		<div class="add-button-container">
			<button class="btn add-button">Добавить</button>
		</div>

	</div>
	<script src="/js/admin_script.js"></script>
</body>
</html>