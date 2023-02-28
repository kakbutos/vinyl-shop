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
	public static function addOrder($formData): void
	{
		$validate = new Validator();

		$validate->set('ФИО', $formData['customerName'])->isRequired()->maxLength(100)->isName();
		$validate->set('email', $formData['customerEmail'])->isRequired()->isEmail();
		$validate->set('телефон', $formData['customerPhone'])->isRequired()->isPhone();
		$validate->set('комментарий', $formData['comment'])->maxLength(255);

		if($validate->validate())
		{
			$cart = new Cart();
			$products = $cart->getCart();

			$order = new Order($products, $formData['customerName'], $formData['customerEmail'], $formData['customerPhone'], $formData['comment']);
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