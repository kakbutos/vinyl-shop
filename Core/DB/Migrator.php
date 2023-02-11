<?php

namespace Eshop\Core\DB;

use Eshop\Core\Config\Config;
use Exception;

class Migrator
{
	static private string $tableMigrateName = 'migration';
	static private string $tableMigrateFieldName = 'NAME';

	/**
	 * @throws Exception
	 */
	public static function migrate(): void
	{
		$connection = Connection::getInstance()->getConnection();
		$files = self::getMigrationFiles($connection);

		//Проверяем есть ли неиспользованные скрипты и выполняем их
		if (!empty($files))
		{
			foreach ($files as $file)
			{
				self::applyMigrate($connection, $file);
			}
		}
	}

	// Получаем список файлов для миграций, не включая тех, которые есть в базе данных
	/**
	 * @throws Exception
	 */
	private static function getMigrationFiles($connection): array
	{
		$sqlFolder = ROOT . '/src/Migration/';
		$allFiles = glob($sqlFolder . '*.sql');

		// Проверяем есть ли таблица с миграциями
		// $query = sprintf('show tables from %s like %s', Config::option('DB_NAME'), self::$tableMigrateName);
		$query = mysqli_query($connection, "
			show tables from {Config::option('DB_NAME')} like {self::$tableMigrateName};
			");
		if (!$query)
		{
			return $allFiles;
		}

		// Ищем существующие миграции в таблице
		$versionsFiles = [];

		$query = mysqli_query($connection, "
			select {self::$tableMigrateFieldName} from {self::$tableMigrateName};
			");

		while ($row = mysqli_fetch_assoc($query))
		{
			$versionsFiles[] = $sqlFolder . $row['name'];
		}

		return array_diff($allFiles, $versionsFiles);
	}

	// Производим миграцию указанного файла
	/**
	 * @throws Exception
	 */
	private static function applyMigrate($connection, string $file): void
	{
		//Применяем скрипты через командную строку
		$command = sprintf('mysql -u"%s" -p"%s" -h "%s" -D "%s" < %s',
			Config::option('DB_USER'), Config::option('DB_PASSWORD'),
			Config::option('DB_HOST'), Config::option('DB_NAME'), $file);
		shell_exec($command);

		//Добавляем запись о выполненном скрипте в таблицу с миграциями
		$baseName = basename($file);

		$query = sprintf('insert into %s (%s) values("%s")',
			self::$tableMigrateName, self::$tableMigrateFieldName, $baseName);
		mysqli_query($connection, $query);
	}
}