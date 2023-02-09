<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Repositories\OrderRepository;
use Eshop\src\Service\MainService;
use Eshop\src\Service\OrderService;
use Eshop\src\Service\ProductService;

class OrderController
{
	public function getOrder(string $id): string
	{
		$product = ProductService::getProductById($id);
		$orders = (new OrderRepository())->getList();

		$render = new Template('../src/Views');
		return $render->render('/public/order', [
			'header' => $render->render('/components/header', []),
			'product' => $product,
			'orders' => $orders
		]);
	}

	public function postOrder(): string
	{
		(new OrderService())->addOrder();
		$render = new Template('../src/Views');
		return $render->render('layout', [
			'header' => $render->render('/components/header', []),
			'sidebar' => $render->render('/components/sidebar', []),
			'content' => $render->render('/public/main', [
				'pagination' => $render->render('/components/pagination', [])
			]),
		]);
	}

}