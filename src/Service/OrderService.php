<?php

namespace Eshop\src\Service;

use Eshop\src\Models\Order;
use Eshop\src\Repositories\OrderRepository;
use Exception;

class OrderService
{
	/**
	 * @throws Exception
	 */
	public function addOrder(): void
	{
		$productId = $_POST['productId'];
		$customerName = $_POST['fullname'];
		$customerEmail = $_POST['email'];
		$customerPhone = $_POST['phone'];
		$comment = $_POST['comment'] ?? null;
		$count = $_POST['count'];
		$price = $_POST['productPrice'];

		$order = new Order($productId, $customerName, $customerEmail, $customerPhone, $count, $price, $comment);
		try
		{
			(new OrderRepository())->add($order);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
}