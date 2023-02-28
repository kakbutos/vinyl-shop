<img alt="img.png" height="100" src="C:\OSPanel\domains\eshop\public\assets\icon\vinil.png" width="100"/>
<H1>Интернет-магазин виниловых пластинок</H1>

<h2>Требования к ПО</h2>

OpenServer 5.4.3 Basic <br>
Apache 2.4 <br>
PHP 7.4 <br>
MySQL 5.7 <br>
jquery-3.6.3 <br>

<h2>Развёртывание проекта</h2>

1) Склонировать репозиторий.

2) необходимо создать базу данных MySQL.
При использовании OpenServer зайти в консоль OS: <br>
Запустить клиент mysql: "mysql -u root -p" <br>
Создаём БД: <br>
"CREATE DATABASE eshop;" <br>
			"USE eshop;" <br>
Создать пользователя: "CREATE USER 'user'@'localhost' IDENTIFIED BY 'password';" <br>
						"GRANT ALL PRIVILEGES ON eshop.* TO 'user'@'localhost';" <br>

3) Добавить домен в папке public

4) Создать файл config.local.php и скопировать следующую структуру:

```php
<?php
return [
	'DB_HOST' => 'localhost',
	'DB_USER' => 'user',
	'DB_PASSWORD' => 'password',
	'DB_NAME' => 'eshop',
];
```
5) Запускаем проект. Мигратор автоматически подгрузит скрипты со структурой базы данных и тестовыми данными