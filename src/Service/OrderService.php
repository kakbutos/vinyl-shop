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
		$validate = new Validator();

		$productId = $_POST['productId'];
		$customerName = $_POST['fullname'];
		$customerEmail = $_POST['email'];
		$customerPhone = $_POST['phone'];
		$comment = $_POST['comment'] ?? null;
		$count = $_POST['count'];
		$price = $_POST['productPrice'];

		$validate->set('ФИО', $customerName)->isRequired()->maxLength(100)->isName()
				 ->set('email', $customerEmail)->isRequired()->isEmail()
				 ->set('телефон', $customerPhone)->isRequired()->isPhone();

		if($validate->validate())
		{
			$order = new Order($productId, $customerName, $customerEmail, $customerPhone, $count, $price, $comment);
			(new OrderRepository())->add($order);
		}
		else
		{
			$errors = $validate->getErrors();
			$stringErrors = [];
			foreach ($errors as $error)
			{
					$stringErrors = implode('<br>', $error);
			}
			throw new Exception($stringErrors);
		}
	}
}