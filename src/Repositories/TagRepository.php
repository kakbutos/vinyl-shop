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
			$tags[] = new Tag(
				$row['ID'],
				$row['NAME']
			);
		}

		return $tags;
	}

	public function getOneById(int $id): array
	{
		$connection = Connection::getInstance()->getConnection();
		$queryResult = mysqli_query($connection, "
			SELECT t.ID, t.NAME FROM tag t
			JOIN product_tag pt on t.ID = pt.TAG_ID
			WHERE pt.PRODUCT_ID = {$id}
			LIMIT 10;
");
		if (!$queryResult)
		{
			throw new Exception(mysqli_error($connection));
		}
		$tags = [];

		while ($row = mysqli_fetch_assoc($queryResult))
		{
			$tags[] = new Tag(
				$row['ID'],
				$row['NAME']
			);
		}
		return $tags;
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