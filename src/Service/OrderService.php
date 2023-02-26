<?php

namespace Eshop\src\Service;

use Eshop\src\Models\Cart;
use Eshop\src\Models\Order;
use Eshop\src\Repositories\OrderRepository;
use Exception;

class OrderService
{
	/**
	 * @throws Exception
	 */
	public static function addOrder(): void
	{
		$validate = new Validator();

		$customerName = $_POST['full-name'];
		$customerEmail = $_POST['email'];
		$customerPhone = $_POST['phone'];
		$comment = $_POST['comment'] ?? null;

		$validate->set('ФИО', $customerName)->isRequired()->maxLength(100)->isName()
				 ->set('email', $customerEmail)->isRequired()->isEmail()
				 ->set('телефон', $customerPhone)->isRequired()->isPhone();

		if($validate->validate())
		{
			$cart = new Cart();
			$products = $cart->getCart();

			$order = new Order($products, $customerName, $customerEmail, $customerPhone, $comment);
			(new OrderRepository())->add($order);
		}
		else
		{
			$errors = $validate->getErrors();
			$stringErrors = '';
			foreach ($errors as $error)
			{
				$stringErrors .= '<br>' . implode('<br>', $error);
			}
			throw new Exception($stringErrors);
		}
	}
}