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

	public function addEmptyOrderItem($id): int
	{
		$connection = Connection::getInstance()->getConnection();

		$query = "INSERT INTO product_order 
		(PRODUCT_ID, ORDER_ID, COUNT, PRICE) VALUES (1, $id, 1, 2000)
		";

		mysqli_query($connection, $query);
		return $id;
	}

	public function deleteEmptyOrderItem($id): int
	{
		$connection = Connection::getInstance()->getConnection();
		$orderId = 0;
		$selectQuery = "SELECT ORDER_ID FROM product_order
			WHERE ID = {$id};
		";

		$selectQuery = mysqli_query($connection, $selectQuery);
		while ($row = mysqli_fetch_assoc($selectQuery))
		{
			$orderId = $row['ORDER_ID'];
		}


		$queryProduct = "DELETE FROM product_order
						WHERE ID = {$id}
		";

		mysqli_query($connection, $queryProduct);

		return $orderId;
	}

	public function updateOrderItem(array $ProductOrder): string
	{
		$connection = Connection::getInstance()->getConnection();

		$id = $ProductOrder['ID'];
		$orderProductId = $ProductOrder['PRODUCT_ID'];
		$orderId = $ProductOrder['ORDER_ID'];
		$orderCount = $ProductOrder['COUNT'];
		$orderPrice = $ProductOrder['PRICE'];
		$orderProductName = $ProductOrder['NAME'];

		$queryOrder = "UPDATE product_order 
		SET
		    PRODUCT_ID = (SELECT ID FROM product WHERE NAME = '{$orderProductName}'),
		    COUNT = {$orderCount},
		    PRICE = {$orderPrice}
		WHERE ID = {$id}
		";
		$query = mysqli_query($connection, $queryOrder);
		if (!$query)
		{
			return 'updateOrderError';
		}

		return 'updateOrderOk';
	}
}