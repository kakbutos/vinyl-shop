<?php

namespace Eshop\Controllers;

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
	public function getOrder(): string
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
				'content' => $render->render('/public/order',['products' => $products, 'totalSum' => $totalSum], ),
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
		$render = new Template('../src/Views');
		try
		{
			OrderService::addOrder();
			session_unset();
			return $render->render('/public/orderInfo');
		}
		catch (Exception $e)
		{
			return $render->render('/public/orderInfo', ['errors' => $e]);
		}
	}

}