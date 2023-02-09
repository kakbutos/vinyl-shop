<?php

namespace Eshop\Controllers;

use Eshop\Core\Template\Template;
use Eshop\src\Service\MainService;
use Eshop\src\Service\ProductService;

class OrderController
{
	public function order(string $id): string
	{
		$product = ProductService::getProductById($id);

		$render = new Template('../src/Views');
		return $render->render('/public/order', [
			'header' => $render->render('/components/header', []),
			'product' => $product
		]);
	}

}