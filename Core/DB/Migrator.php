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
		$query = sprintf('show tables from %s like %s', Config::option('DB_NAME'), self::$tableMigrateName);
		$data = $connection->query($query);
		if (!$data)
		{
			return $allFiles;
		}

		// Ищем существующие миграции в таблице
		$versionsFiles = [];
		$query = sprintf('select %s from %s', self::$tableMigrateFieldName, self::$tableMigrateName);
		$data = $connection->query($query)->fetch_all(MYSQLI_ASSOC);
		foreach ($data as $row)
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
		$command = sprintf('mysql -u"%s" -p"%s" -h "%s" -D "%s" < %s', Config::option('DB_USER'),
			Config::option('DB_PASSWORD'), Config::option('DB_HOST'), Config::option('DB_NAME'), $file);
		shell_exec($command);

		$baseName = basename($file);
		$query = sprintf('insert into %s (%s) values("%s")', self::$tableMigrateName, self::$tableMigrateFieldName,
			$baseName);
		// Выполняем запрос
		$connection->query($query);
	}
}