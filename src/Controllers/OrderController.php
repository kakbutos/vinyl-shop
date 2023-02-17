<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Repositories\OrderRepository;
use Eshop\src\Service\MainService;
use Eshop\src\Service\OrderService;
use Eshop\src\Service\ProductService;
use Exception;

class OrderController
{
	/**
	 * @throws Exception
	 */
	public function getOrder(string $id): string
	{
		$render = new Template('../src/Views');
		$product = ProductService::getProductById($id);
		$tags = MainService::getTagsList();
		$orders = (new OrderRepository())->getList();

		return $render->render('layout', [
			'header' => $render->render('/components/header', []),
			'sidebar' => $render->render('/components/sidebar', ['tags' => $tags]),
			'content' => $render->render('/public/order',['product' => $product,'orders' => $orders]),
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
			(new OrderService())->addOrder();
			return $render->render('/public/orderInfo');
		}
		catch (Exception $e)
		{
			return $render->render('/public/orderInfo', ['errors' => $e]);
		}
	}

}