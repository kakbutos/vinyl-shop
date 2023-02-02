<?php
namespace Eshop\Core\DB;

use Eshop\Core\Config\Config;
use Exception;

class Migrator
{
	static private string $tableMigrateName = 'migration';

	/**
	 * @throws Exception
	 */
	public static function migrate(): void
	{
		$connection = Connection::getInstance()->getConnection();
		$files = self::getMigrationFiles($connection);
		if (!empty($files))
		{
			foreach ($files as $file) {
				self::applyMigrate($connection, $file);
			}
		}
	}

	/**
	 * @throws Exception
	 */
	private static function getMigrationFiles($connection): array
	{
		$sqlFolder = ROOT . '/src/Migration/';
		$allFiles = glob($sqlFolder . '*.sql');
		$query = sprintf('show tables from %s like %s', Config::option('DB_NAME'), self::$tableMigrateName);
		$data = $connection->query($query);
		$firstMigration = !$data->num_rows;
		if ($firstMigration) {
			return $allFiles;
		}

		$versionsFiles = [];
		$query = sprintf('select NAME from %s', self::$tableMigrateName);
		$data = $connection->query($query)->fetch_all(MYSQLI_ASSOC);
		foreach ($data as $row) {
			$versionsFiles[] = $sqlFolder . $row['name'];
		}

		return array_diff($allFiles, $versionsFiles);
	}

	/**
	 * @throws Exception
	 */
	private static function applyMigrate($connection,string $file): void
	{
		$command = sprintf('mysql -u%s -p%s -h %s -D %s < %s', Config::option('DB_USER'),
			Config::option('DB_PASSWORD'), Config::option('DB_HOST'), Config::option('DB_NAME'), $file);
		shell_exec($command);

		$baseName = basename($file);
		$query = sprintf('insert into %s (NAME) values("%s")', self::$tableMigrateName, $baseName);
		// Выполняем запрос
		$connection->query($query);
	}
}