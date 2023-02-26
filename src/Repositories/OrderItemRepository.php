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
			SELECT product_order.ID as ID, PRODUCT_ID, ORDER_ID, p.NAME as NAME, COUNT, product_order.PRICE
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
				'ID' => $row['ID'],
				'PRODUCT_ID' => $row['PRODUCT_ID'],
				'ORDER_ID' => $row['ORDER_ID'],
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
						WHERE ID = {$id}
		";

		return mysqli_query($connection, $queryProduct);
	}

	public function updateOrderItem(array $ProductOrder): bool
	{
		$connection = Connection::getInstance()->getConnection();

		$id = $ProductOrder['ID'];
		$orderProductId = $ProductOrder['PRODUCT_ID'];
		$orderId = $ProductOrder['ORDER_ID'];
		$orderCount = $ProductOrder['COUNT'];
		$orderPrice = $ProductOrder['PRICE'];

		$queryOrder = "UPDATE product_order 
		SET
		    COUNT = {$orderCount},
		    PRICE = {$orderPrice}
		WHERE ID = {$id}
		";
		$test = mysqli_query($connection, $queryOrder);

		return $test;
	}
}