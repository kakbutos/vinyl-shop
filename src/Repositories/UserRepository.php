<?php

namespace Eshop\src\Repositories;

use Eshop\Core\DB\Connection;
use Eshop\src\Models\User;
use Exception;

class UserRepository
{
	/**
	 * @throws Exception
	 */
	public function getUserByEmail(string $email)
	{
		$connection = Connection::getInstance()->getConnection();

		$emailQuery = mysqli_escape_string($connection, $email);
		$queryResult = mysqli_query($connection, "SELECT ID, EMAIL, PASSWORD FROM user WHERE EMAIL = '{$emailQuery}'");

		if (!$queryResult)
		{
			throw new Exception(mysqli_error($connection));
		}

		$user = [];

		while ($row = mysqli_fetch_assoc($queryResult))
		{
			$user[] = new User(
				$row['ID'],
				$row['EMAIL'],
				$row['PASSWORD']
			);
		}

		return $user;
	}
}