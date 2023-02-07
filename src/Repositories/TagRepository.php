<?php

namespace Eshop\src\Repositories;

use Eshop\Core\DB\Connection;
use Eshop\src\Models\Tag;
use Exception;

class TagRepository
{
	/**
	 * @throws Exception
	 */
	public function getList(): array
	{
		$connection = Connection::getInstance()->getConnection();

		$queryResult = mysqli_query($connection, "SELECT * FROM tag");
		if (!$queryResult)
		{
			throw new Exception(mysqli_error($connection));
		}

		$tags = [];

		while ($row = mysqli_fetch_assoc($queryResult))
		{
			$tags[] = new Tag(
				$row['NAME'],
				$row['ID']
			);
		}

		return $tags;
	}
}