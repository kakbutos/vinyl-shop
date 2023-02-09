<?php

namespace Eshop\src\Service;

use Eshop\src\Models\Order;
use Eshop\src\Repositories\OrderRepository;
use Exception;

class OrderService
{
	/**
	 * @throws \Exception
	 */
	public function addOrder(): void
	{
		$customerName = $_POST['fullname'];
		$customerEmail = $_POST['email'];
		$customerPhone = $_POST['phone'];
		$comment = $_POST['comment'] ?? null;

		$order = new Order($customerName, $customerEmail, $customerPhone, $comment);
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