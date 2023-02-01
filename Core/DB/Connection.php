<?php

namespace Eshop\Core\DB;

use Exception, mysqli;

class Connection
{
	private static $instance = null;
	/**
	 * @var false | mysqli
	 */
	private $connection;

	/**
	 * @throws Exception
	 */
	private function __construct()
	{
		$config = new \Eshop\Core\Config\Config();
		$this->createConnection(
			$config::option('DB_HOST'),
			$config::option('DB_USER'),
			$config::option('DB_PASSWORD'),
			$config::option('DB_NAME')
		);
	}

	public static function getInstance(): self
	{
		if (self::$instance === null)
		{
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * @throws Exception
	 */
	private function createConnection($dbHost, $dbUser, $dbPassword, $dbName): void
	{
		$this->connection = mysqli_init();

		$connected = mysqli_real_connect($this->connection, $dbHost, $dbUser, $dbPassword, $dbName);

		if (!$connected)
		{
			$error = mysqli_connect_errno() . ': ' . mysqli_connect_error();
			throw new Exception($error);
		}

		$encodingResult = mysqli_set_charset($this->connection, 'utf8');

		if (!$encodingResult)
		{
			throw new Exception(mysqli_error($this->connection));
		}
	}

	public function getConnection()
	{
		return $this->connection;
	}
}