<?php

namespace Eshop\src\Repositories;

use Eshop\Core\DB\Connection;
use Eshop\src\Models\Tag;
use Exception;

class TagRepository extends Repository
{
	/**
	 * @throws Exception
	 */
	public function getList(array $filter = []): array
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
			$tags[] = new Tag($row['NAME'], $row['ID']);
		}

		return $tags;
	}

	public function getOneById(int $id): Tag
	{
		// TODO: Implement getOne() method.
		return new Tag('');
	}

	public function add($entity): void
	{
		// TODO: Implement add() method.
	}

	public function delete($entity): void
	{
		// TODO: Implement delete() method.
	}

	public function update($entity): void
	{
		// TODO: Implement update() method.
	}
}