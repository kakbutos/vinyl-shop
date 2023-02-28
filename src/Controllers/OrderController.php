<?php

namespace Eshop\Controllers;

use Eshop\Core\Session;
use Eshop\Core\Template\Template;
use Eshop\src\Models\Cart;
use Eshop\src\Service\MainService;
use Eshop\src\Service\OrderService;
use Exception;

class OrderController
{
	/**
	 * @throws Exception
	 */
	public function getOrder($errors = null): string
	{
		$render = new Template('../src/Views');
		$tags = MainService::getTagsList();
		$quantityProductsInCart = (new Cart())->getTotalQuantity();

		if ($quantityProductsInCart > 0)
		{
			$cart = new Cart();
			$products = $cart->getCart();
			$totalSum = $cart->getTotalSum();

			return $render->render('layout', [
				'header' => $render->render('/components/header', ['quantity' => $quantityProductsInCart]),
				'sidebar' => $render->render('/components/sidebar', ['tags' => $tags]),
				'content' => $render->render('/public/order',['products' => $products, 'totalSum' => $totalSum, 'errors' => $errors], ),
			]);
		}

		return $render->render('layout', [
			'header' => $render->render('/components/header', ['quantity' => $quantityProductsInCart]),
			'sidebar' => $render->render('/components/sidebar', ['tags' => $tags]),
			'content' => 'Нет товаров для заказа',
		]);
	}

	/**
	 * @throws Exception
	 */
	public function createOrder(): string
	{
		$formData = ['customerName' => $_POST['full-name'],
					'customerEmail' => $_POST['email'],
					'customerPhone' => $_POST['phone'],
					'comment' => $_POST['comment'] ?? null
			];

		$render = new Template('../src/Views');
		try
		{
			OrderService::addOrder($formData);
			$session = new Session();
			$session->delete('cart');
			$session->delete('cartQty');
			$session->delete('cartSum');

			return $render->render('/public/orderInfo');
		}
		catch (Exception $errors)
		{
			$errorMessages = $errors->getMessage();
			return $this->getOrder($errorMessages);
		}
	}

}