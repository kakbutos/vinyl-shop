<?php

namespace Eshop\Core\DB;

use Exception;

class Connection
{
	/**
	 * @var false | \mysqli
	 */
	private $connection;

	private function __construct()
	{
		$this->createConnection($dbHost, $dbUser, $dbPassword, $dbName);
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