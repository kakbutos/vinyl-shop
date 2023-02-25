<?php

namespace Eshop\src\Repositories;

use Eshop\Core\DB\Connection;
use Eshop\src\Models\Image;
use Eshop\src\Models\Product;
use Eshop\src\Models\TableField;
use Exception;

class OrderItemRepository
{
	public function getOrderItems($id): array
	{
		$List = [];
		$connection = Connection::getInstance()->getConnection();
		$Query = mysqli_query($connection, "
			SELECT PRODUCT_ID, p.NAME as NAME, COUNT, p.PRICE
			FROM product_order
			JOIN product p on product_order.PRODUCT_ID = p.ID
			WHERE ORDER_ID = {$id}
		");

		if (!$Query)
		{
			throw new Exception(mysqli_error($connection));
		}

		while ($row = mysqli_fetch_assoc($Query))
		{
			$List[] = [
				'PRODUCT_ID' => $row['PRODUCT_ID'],
				'NAME' => $row['NAME'],
				'COUNT' => (int)$row['COUNT'],
				'PRICE' => (float)$row['PRICE']
			];
		}
		return $List;
	}

	public function addEmptyOrderItem($id): bool
	{
		$connection = Connection::getInstance()->getConnection();

		$Query = "INSERT INTO product_order 
		(PRODUCT_ID, ORDER_ID, COUNT, PRICE) VALUES (1, $id, 1, 2000)
		";

		return mysqli_query($connection, $Query);
	}

	public function deleteEmptyOrderItem($id): bool
	{
		$connection = Connection::getInstance()->getConnection();

		$queryProduct = "DELETE FROM product_order
						WHERE PRODUCT_ID = {$id}
		";

		return mysqli_query($connection, $queryProduct);
	}

	public function updateOrderItem($id): void
	{
		$connection = Connection::getInstance()->getConnection();


	}
}