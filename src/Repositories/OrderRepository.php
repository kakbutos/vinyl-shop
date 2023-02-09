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

		$comment = $comment ?: "NULL";

		$query = "INSERT INTO `order` (DATE, CUSTOMER_NAME, CUSTOMER_EMAIL, CUSTOMER_PHONE, COMMENT, STATUS) VALUES (
        '$createdAt',
        '$customerName',
        '$customerEmail',
        '$customerPhone',
        '$comment',
        '$status'
    );";

		$result = mysqli_query($connection, $query);
		if (!$result)
		{
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