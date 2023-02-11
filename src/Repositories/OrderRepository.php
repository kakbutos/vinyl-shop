<?php

namespace Eshop\src\Repositories;

use DateTime;
use Eshop\Core\DB\Connection;
use Eshop\src\Models\Order;
use Exception;

class OrderRepository extends Repository
{

	/**
	 * @throws Exception
	 */
	public function getList(array $filter = []): array
	{
		return [];
	}

	public function getOneById(int $id)
	{
		// TODO: Implement getOneById() method.
	}

	/**
	 * @throws Exception
	 */
	public function add($order): void
	{
		$connection = Connection::getInstance()->getConnection();

		$createdAt = $order->getCreatedAt()->format('Y-m-d H:i:s');
		$customerName = mysqli_real_escape_string($connection, $order->getCustomerName());
		$customerEmail = mysqli_real_escape_string($connection, $order->getCustomerEmail());
		$customerPhone = mysqli_real_escape_string($connection, $order->getCustomerPhone());
		$comment = mysqli_real_escape_string($connection, $order->getComment());
		$status = $order->getStatus();
		$productId = $order->getProductId();
		$count = $order->getCount();
		$price = $order->getPrice();

		$comment = $comment ?: "NULL";

		$queryOrder = "INSERT INTO `order` (DATE, CUSTOMER_NAME, CUSTOMER_EMAIL, CUSTOMER_PHONE, COMMENT, STATUS) VALUES (
        '$createdAt',
        '$customerName',
        '$customerEmail',
        '$customerPhone',
        '$comment',
        '$status'
    );";

		mysqli_begin_transaction($connection);

		try
		{
			mysqli_query($connection, $queryOrder);
			$orderId = mysqli_insert_id($connection);
			mysqli_query($connection, "INSERT INTO product_order (PRODUCT_ID, ORDER_ID, COUNT, PRICE) VALUES ('$productId', '$orderId', '$count', '$price');");
			mysqli_commit($connection);
		}

		catch (\mysqli_sql_exception $exception)
		{
			mysqli_rollback($connection);
			throw new Exception(mysqli_error($connection));
		}
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